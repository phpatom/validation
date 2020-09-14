<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\DifferenceConstraint;
use Atom\Validation\Test\BaseTestCase;

class DifferenceConstraintTest extends BaseTestCase
{

    private function makeConstraint(string $field)
    {
        return new DifferenceConstraint($field);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint("bar");
        $this->assertTrue($constraint->validate("foo", ["foo" => "bar","bar" => "baz"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "bar","bar" => "bar"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("different", $this->makeConstraint("foo")->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "The value of the field bar and foo should be different",
            $this->makeConstraint("foo")->getFallbackErrorMessage("bar")
        );
    }
}
