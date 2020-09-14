<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\AcceptedConstraint;
use Atom\Validation\Test\BaseTestCase;

class AcceptedConstraintTest extends BaseTestCase
{
    public function testValidate()
    {
        $constraint = new AcceptedConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "1"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 1]));
        $this->assertTrue($constraint->validate("foo", ["foo" => true]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "yes"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "on"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "true"]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "no"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => 2]));
        $this->assertFalse($constraint->validate("foo", ["foo" => 0]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "false"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "bar"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("accepted", (new AcceptedConstraint())->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals("You need to accept foo", (new AcceptedConstraint())->getFallbackErrorMessage("foo"));
    }
}
