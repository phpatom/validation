<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\AlphabeticOnlyConstraint;
use Atom\Validation\Test\BaseTestCase;

class AlphabeticOnlyConstraintTest extends BaseTestCase
{

    private function makeConstraint()
    {
        return new AlphabeticOnlyConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "bar"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "a"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "azeze"]));

        $this->assertFalse($constraint->validate("foo", ["foo" => 1]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "aze1"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("alpha", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo should contains only alphabetic character",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
