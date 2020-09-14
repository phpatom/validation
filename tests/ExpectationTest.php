<?php


namespace Atom\Validation\Test;

use Atom\Validation\ConstraintFactory;
use Atom\Validation\Expectation;
use Atom\Validation\Scope;
use Atom\Validation\Test\Misc\AlwaysFailsConstraint;
use Atom\Validation\Test\Misc\AlwaysPassesConstraint;
use Atom\Validation\Translation\TranslationBag;
use stdClass;
use TypeError;

class ExpectationTest extends BaseTestCase
{
    public function testInstantiation()
    {
        $expectation = new Expectation("foo", "bar");
        $this->assertEquals($expectation->getField(), "foo");
        $this->assertEquals($expectation->getFieldName(), "bar");
        $expectation = new Expectation("foo", "bar", $constraints = [
            new AlwaysPassesConstraint(),
            new AlwaysFailsConstraint()
        ]);
        $this->assertEquals($constraints, $expectation->getConstraints());
        $expectation = new Expectation("foo", "bar", [], $scope =  Scope::queryParams());
        $this->assertEquals($expectation->getScope(), $scope);
        $this->expectException(TypeError::class);
         new Expectation("foo", "bar", [new AlwaysFailsConstraint(), new StdClass()]);
    }

    public function testAddConstraint()
    {
        $expectation = new Expectation("foo");
        $this->assertEmpty($expectation->getConstraints());
        $expectation->addConstraint($constraint = new AlwaysFailsConstraint());
        $this->assertEquals($expectation->getConstraints(), [$constraint]);
    }

    public function testIsSatisfiedBy()
    {
        $expectation = new Expectation("foo", "Foo", [new AlwaysPassesConstraint()]);
        $this->assertTrue($expectation->isSatisfiedBy($this->makeRequest(), new TranslationBag()));
        $this->assertEmpty($expectation->getErrors());
        $expectation = new Expectation("foo", "Foo", [new AlwaysFailsConstraint("value", "key")]);
        $translationBag = new TranslationBag();
        $this->assertFalse($expectation->isSatisfiedBy($this->makeRequest(), $translationBag));
        $this->assertEquals(["key" => "value"], $expectation->getErrors());
        $translationBag->add("key", "i am :label");
        $this->assertFalse($expectation->isSatisfiedBy($this->makeRequest(), $translationBag));
        $this->assertEquals(["key" => "i am key"], $expectation->getErrors());
        $translationBag->add("foo.key", "i am not :label");
        $this->assertFalse($expectation->isSatisfiedBy($this->makeRequest(), $translationBag));
        $this->assertEquals(["key" => "i am not key"], $expectation->getErrors());
    }

    public function testGetErrors()
    {
        $expectation = new Expectation("foo");
        $expectation->isSatisfiedBy($this->makeRequest(), new TranslationBag());
        $this->assertEmpty($expectation->getErrors());

        $expectation = new Expectation("foo", "Foo", [new AlwaysPassesConstraint()]);
        $expectation->isSatisfiedBy($this->makeRequest(), new TranslationBag());
        $this->assertEmpty($expectation->getErrors());

        $expectation = new Expectation("foo", "Foo", [
            $constraint1 = new AlwaysFailsConstraint("value1", "key1"),
            $constraint2 = new AlwaysFailsConstraint("value2", "key2"),
            new AlwaysPassesConstraint()
        ]);
        $expectation->isSatisfiedBy($this->makeRequest(), new TranslationBag());
        $this->assertEquals($expectation->getErrors(), ["key1" => "value1","key2" => "value2"]);
    }

    public function testIs()
    {
        $this->assertInstanceOf(ConstraintFactory::class, (new Expectation("foo"))->is());
    }
}
