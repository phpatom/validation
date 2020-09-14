<?php


namespace Atom\Validation\Test\Constraints\Date;

use Atom\Validation\Constraints\Date\DateFormatConstraint;
use Atom\Validation\Test\BaseTestCase;

class DateFormatConstraintTest extends BaseTestCase
{
    private function makeConstraint(string $format)
    {
        return new DateFormatConstraint($format);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint("Y-m-d");
        $this->assertFalse($constraint->validate("foo", ["foo" => "2018-14-01"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "20122-14-01"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "2018-10-32"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "2017-5-25"]));

        $this->assertTrue($constraint->validate("foo", ["foo" => "2018-12-01"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "1970-11-28"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("date|format", $this->makeConstraint("date")->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "date should be a date that match the format Y-m-d",
            $this->makeConstraint("Y-m-d")->getFallbackErrorMessage("date")
        );
    }

    public function testGetAttribute()
    {
        $this->assertEquals(["format"=>"Y-m-d"], $this->makeConstraint("Y-m-d")->getAttributes());
    }

}
