<?php


namespace Atom\Validation\Test\Constraints\Date;

use Atom\Validation\Constraints\Date\DateEqualsConstraint;
use Atom\Validation\Test\BaseTestCase;

class DateEqualsConstraintTest extends BaseTestCase
{
    private function makeConstraint(string $date)
    {
        return new DateEqualsConstraint($date);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint("tomorrow");
        $this->assertFalse($constraint->validate("foo", ["foo" => "now"]));
        $constraint = $this->makeConstraint("yesterday");
        $this->assertFalse($constraint->validate("foo", ["foo" => "now"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "yesterday"]));

        $constraint = $this->makeConstraint("now");
        $this->assertTrue($constraint->validate("foo", ["foo" => "now"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("date|equals", $this->makeConstraint("date")->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "date needs to be equals to yesterday",
            $this->makeConstraint("yesterday")->getFallbackErrorMessage("date")
        );
    }

    public function testGetAttribute()
    {
        $this->assertEquals(["date"=>"date"], $this->makeConstraint("date")->getAttributes());
    }
}
