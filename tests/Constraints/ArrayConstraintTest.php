<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\ArrayConstraint;
use Atom\Validation\Test\BaseTestCase;

class ArrayConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new ArrayConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => ["bar"]]));
        $this->assertTrue($constraint->validate("foo", ["foo" => []]));
        $this->assertTrue($constraint->validate("foo", ["foo" => ["bar" =>"baz"]]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "foo*"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => null]));
    }

    public function testGetKey()
    {
        $this->assertEquals("array", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo needs to be an array",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
