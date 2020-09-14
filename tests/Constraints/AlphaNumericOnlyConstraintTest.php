<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\AlphaNumericOnlyConstraint;
use Atom\Validation\Test\BaseTestCase;

class AlphaNumericOnlyConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new AlphaNumericOnlyConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "bar"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "a1111"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "azeze87"]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "foo*"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "/abc123"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("alpha|num", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo should contains only alphabetic or numeric character",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
