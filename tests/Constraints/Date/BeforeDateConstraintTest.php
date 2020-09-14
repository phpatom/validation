<?php


namespace Atom\Validation\Test\Constraints\Date;

use Atom\Validation\Constraints\Date\BeforeDateConstraint;
use Atom\Validation\Test\BaseTestCase;

class BeforeDateConstraintTest extends BaseTestCase
{
    private function makeConstraint(string $date)
    {
        return new BeforeDateConstraint($date);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint("tomorrow");
        $this->assertFalse($constraint->validate("foo", ["foo" => "now"]));
        $constraint = $this->makeConstraint("yesterday");
        $this->assertFalse($constraint->validate("foo", ["foo" => "yesterday"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "now"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("before", $this->makeConstraint("date")->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "date needs to be before yesterday",
            $this->makeConstraint("yesterday")->getFallbackErrorMessage("date")
        );
    }
    public function testGetAttribute()
    {
        $this->assertEquals(["date"=>"date"], $this->makeConstraint("date")->getAttributes());
    }
}
