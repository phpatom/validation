<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\PresenceConstraint;
use Atom\Validation\Test\BaseTestCase;

class PresenceConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new PresenceConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "bar"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => null]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 0]));

        $this->assertFalse($constraint->validate("foo", ["bar" => "baz"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("present", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo is required",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
