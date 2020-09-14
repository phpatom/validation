<?php


namespace Atom\Validation\Test\Translation;

use Atom\Validation\Contracts\TranslationBagContract;
use Atom\Validation\Translation\TranslationBag;
use PHPUnit\Framework\TestCase;

class TranslationBagTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(TranslationBagContract::class, new TranslationBag());
    }

    public function testAdd()
    {
        $bag = new TranslationBag();
        $this->assertEmpty($bag->getTranslations());
        $this->assertFalse($bag->hasTranslation("foo"));
        $bag->add("foo", "bar");
        $this->assertTrue($bag->hasTranslation("foo"));
        $bag->add("bar", "baz");
        $this->assertCount(2, $bag->getTranslations());
    }

    public function testHasTranslation()
    {
        $bag = new TranslationBag();
        $this->assertFalse($bag->hasTranslation("foo"));
        $bag->add("foo", "bar");
        $this->assertTrue($bag->hasTranslation("foo"));
    }

    public function testTranslate()
    {
        $bag = new TranslationBag();
        $this->assertEquals("foo", $bag->translate("foo"));
        $bag->add("foo", "bar");
        $this->assertEquals("bar", $bag->translate("foo"));
        $this->assertEquals("bar", $bag->translate("baz", [], "bar"));
        $bag->add('placeholder', "i am a :foo and you are a :bar");
        $this->assertEquals("i am a foo and you are a bar", $bag->translate("placeholder", [
            "foo" =>"foo",
            "bar" => "bar"
        ]));
    }

    public function testTranslations()
    {
        $bag = new TranslationBag();
        $this->assertEmpty($bag->getTranslations());
        $bag->add("foo", "bar");
        $bag->add("bar", "baz");
        $this->assertEquals($bag->getTranslations(), ["foo"=>"bar","bar"=>"baz"]);
    }
}
