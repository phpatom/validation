<?php


namespace Atom\Validation\Test\Constraints\Date;

use Atom\Validation\Constraints\Date\DateConstraint;
use Atom\Validation\Test\BaseTestCase;

class DateConstraintTest extends BaseTestCase
{
    public function testValidate()
    {
        $constraint = new DateConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "28-09-2000"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 10000000]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "09/28/2000"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "now"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "tomorrow"]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "date"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "foo"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("date", (new DateConstraint())->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals("foo is not a valid date", (new DateConstraint())->getFallbackErrorMessage("foo"));
    }
}
