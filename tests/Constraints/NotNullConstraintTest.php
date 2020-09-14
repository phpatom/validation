<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\NotNullConstraint;
use Atom\Validation\Test\BaseTestCase;

class NotNullConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new NotNullConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "bar"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "1"]));

        $this->assertFalse($constraint->validate("foo", ["bar" => "baz"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => null]));
    }

    public function testGetKey()
    {
        $this->assertEquals("!null", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "The field foo should not be null",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
