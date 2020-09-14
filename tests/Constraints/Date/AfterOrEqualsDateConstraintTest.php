<?php


namespace Atom\Validation\Test\Constraints\Date;

use Atom\Validation\Constraints\Date\AfterOrEqualsDateConstraint;
use Atom\Validation\Test\BaseTestCase;

class AfterOrEqualsDateConstraintTest extends BaseTestCase
{
    private function makeConstraint(string $date)
    {
        return new AfterOrEqualsDateConstraint($date);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint("tomorrow");
        $this->assertTrue($constraint->validate("foo", ["foo" => "now"]));
        $constraint = $this->makeConstraint("now");
        $this->assertTrue($constraint->validate("foo", ["foo" => "now"]));
        $constraint = $this->makeConstraint("yesterday");
        $this->assertFalse($constraint->validate("foo", ["foo" => "now"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("after|equals", $this->makeConstraint("date")->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "tomorrow needs to be after or equals to now",
            $this->makeConstraint("tomorrow")->getFallbackErrorMessage("now")
        );
    }
    public function testGetAttribute()
    {
        $this->assertEquals(["date"=>"date"], $this->makeConstraint("date")->getAttributes());
    }
}
