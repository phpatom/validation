<?php

namespace Atom\Validation\Test;

use Atom\Validation\Contracts\TranslationBagContract;
use Atom\Validation\Contracts\ValidatorContract;
use Atom\Validation\Exceptions\ValidationException;
use Atom\Validation\Expectation;
use Atom\Validation\Test\Misc\AlwaysFailsConstraint;
use Atom\Validation\Test\Misc\AlwaysPassesConstraint;
use Atom\Validation\Translation\TranslationBag;
use Atom\Validation\Validator;

class ValidatorTest extends BaseTestCase
{

    public function testInstantiation()
    {
        $this->assertInstanceOf(Validator::class, new Validator());
        $this->assertInstanceOf(ValidatorContract::class, new Validator());
        $translation = new TranslationBag();
        $this->assertEquals($translation, (new Validator($translation))->translations());
        $this->assertInstanceOf(TranslationBag::class, (new Validator)->translations());
    }

    /**
     * @throws ValidationException
     */
    public function testValidate()
    {
        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("jhon", "doe"),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint("bar", "baz")
        ]));
        $request = $this->makeRequest();
        $this->expectException(ValidationException::class);
        $validator->validate($request);
    }

    public function testCheck()
    {
        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("jhon", "doe"),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint("bar", "baz")
        ]));
        $request = $this->makeRequest();
        $validator->check($request);
        $this->assertTrue($validator->failed());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint(),
        ]));
        $this->assertTrue($validator->succeed());
    }

    public function testErrorsAreValid()
    {
        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("doe", "jhon"),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint("baz", "bar")
        ]));
        $validator->add(new Expectation("baz", "Baz", [
            new AlwaysFailsConstraint("frog", "kermit")
        ]));
        $request = $this->makeRequest();
        $validator->check($request);
        $this->assertArrayHasKey("foo", $validator->errors());
        $this->assertCount(2, $validator->errors("foo"));
        $this->assertEquals([
            "foo" => [
                "jhon" => "doe",
                "bar" => "baz"
            ],
            "baz" =>[
                "kermit" =>"frog"
            ]
        ], $validator->errors());
    }

    public function testErrorMessagesAreTranslated()
    {
        $translationBag = new TranslationBag();
        $translationBag->add("bar", "iambaz");
        $validator = new Validator($translationBag);
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("fallbackMessage", "bar")
        ]));
        $validator->check($this->makeRequest());
        $this->assertEquals(["foo" => ["bar" => "iambaz"]], $validator->errors());
    }

    public function testPasses()
    {
        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("message", "key")
        ]));
        $validator->check($this->makeRequest());
        $this->assertFalse($validator->succeed());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint()
        ]));
        $validator->check($this->makeRequest());
        $this->assertTrue($validator->succeed());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint(),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint(),
        ]));
        $validator->check($this->makeRequest());
        $this->assertFalse($validator->succeed());
    }

    public function testFails()
    {
        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("message", "key")
        ]));
        $validator->check($this->makeRequest());
        $this->assertTrue($validator->failed());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint()
        ]));
        $validator->check($this->makeRequest());
        $this->assertFalse($validator->failed());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint(),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint(),
        ]));
        $validator->check($this->makeRequest());
        $this->assertTrue($validator->failed());
    }

    public function testHasError()
    {
        $validator = new Validator();
        $this->assertFalse($validator->hasErrors());
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysFailsConstraint("message", "key")
        ]));
        $validator->check($this->makeRequest());
        $this->assertTrue($validator->hasErrors());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint()
        ]));
        $validator->check($this->makeRequest());
        $this->assertFalse($validator->hasErrors());

        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint(),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint(),
        ]));
        $validator->check($this->makeRequest());
        $this->assertTrue($validator->hasErrors());
    }

    public function testAssert()
    {
        $validator = new Validator();
        $expectation = $validator->assert("foo");
        $this->assertInstanceOf(Expectation::class, $expectation);
        $this->assertEquals("foo", $expectation->getField());
        $expectation = $validator->assert("foo", "baz");
        $this->assertEquals("foo", $expectation->getField());
        $this->assertEquals("baz", $expectation->getFieldName());
        $this->assertCount(2, $validator->getExpectations());
    }

    public function testAddExpectation()
    {
        $validator = new Validator();
        $this->assertEmpty($validator->getExpectations());
        $validator->add(new Expectation("foo"));
        $validator->add(new Expectation("baz"));
        $this->assertCount(2, $validator->getExpectations());
    }

    public function testTranslations()
    {
        $translationBag = new TranslationBag(["foo" => "bar"]);
        $validator = new Validator();
        $this->assertNotEquals($translationBag, $validator->translations());
        $this->assertInstanceOf(TranslationBagContract::class, $validator->translations());
        $validator = new Validator($translationBag);
        $this->assertEquals($translationBag, $validator->translations());
    }

    public function testSetTranslations()
    {
        $translationBag = new TranslationBag(["foo" => "bar"]);
        $validator = new Validator();
        $this->assertNotEquals($translationBag, $validator->translations());
        $validator->setTranslations($translationBag);
        $this->assertEquals($translationBag, $validator->translations());
    }

    public function testErrors()
    {
        $validator = new Validator();
        $this->assertEmpty($validator->errors());
        $validator = new Validator();
        $validator->add(new Expectation("foo", "Foo", [new AlwaysPassesConstraint()]));
        $validator->check($this->makeRequest());
        $this->assertEmpty($validator->errors());
        $validator->add(new Expectation("foo", "Foo", [
            new AlwaysPassesConstraint(),
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint("value1", "key1"),
            new AlwaysFailsConstraint("value2", "key2"),
         ]));
        $validator->add(new Expectation("bar", "Baz", [
            new AlwaysFailsConstraint("value3", "key3"),
         ]));
        $validator->check($this->makeRequest());
        $this->assertEquals($validator->errors(), ['foo' => [
            "key1" => "value1",
            "key2" => "value2"
        ],"bar"=>["key3" => "value3"]]);

        $this->assertEquals($validator->errors("bar"), ["key3" => "value3"]);
        $this->assertEquals($validator->errors("foo"), [
            "key1" => "value1",
            "key2" => "value2"
        ]);
        $this->assertEmpty($validator->errors("baz"));
    }

    public function testGetExpectations()
    {
        $validator = new Validator();
        $this->assertEmpty($validator->getExpectations());
        $validator->add($expectation1 = new Expectation("foo", "Foo"));
        $validator->add($expectation2 = new Expectation("baz", "Baz"));
        $this->assertEquals([$expectation1,$expectation2], $validator->getExpectations());
    }

}
