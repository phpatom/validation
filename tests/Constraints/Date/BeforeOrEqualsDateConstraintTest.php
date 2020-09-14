<?php


namespace Atom\Validation\Test\Constraints\Date;

use Atom\Validation\Constraints\Date\BeforeOrEqualsDateConstraint;
use Atom\Validation\Test\BaseTestCase;

class BeforeOrEqualsDateConstraintTest extends BaseTestCase
{
    private function makeConstraint(string $date)
    {
        return new BeforeOrEqualsDateConstraint($date);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint("tomorrow");
        $this->assertFalse($constraint->validate("foo", ["foo" => "now"]));
        $constraint = $this->makeConstraint("yesterday");
        $this->assertTrue($constraint->validate("foo", ["foo" => "now"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "yesterday"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("before|equals", $this->makeConstraint("date")->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "date needs to be before or equals yesterday",
            $this->makeConstraint("yesterday")->getFallbackErrorMessage("date")
        );
    }

    public function testGetAttribute()
    {
        $this->assertEquals(["date"=>"date"], $this->makeConstraint("date")->getAttributes());
    }
}
