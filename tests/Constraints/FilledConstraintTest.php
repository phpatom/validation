<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\FilledConstraint;
use Atom\Validation\Test\BaseTestCase;

class FilledConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new FilledConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertFalse($constraint->validate("foo", ["foo" => ""]));
        $this->assertFalse($constraint->validate("foo", ["foo" => null]));
        $this->assertFalse($constraint->validate("foo", ["foo" => []]));

        $this->assertTrue($constraint->validate("foo", ["foo" => [1,2,3]]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "i am not null"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "bar"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 42]));
    }

    public function testGetKey()
    {
        $this->assertEquals("filled", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "The field foo should be filled",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
