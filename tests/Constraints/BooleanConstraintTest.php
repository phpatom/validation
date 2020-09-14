<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\BooleanConstraint;
use Atom\Validation\Test\BaseTestCase;

class BooleanConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new BooleanConstraint();
    }

    /**
     * @throws \Exception
     */
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => true]));
        $this->assertTrue($constraint->validate("foo", ["foo" => false]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 1]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 0]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "true"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "42"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => 42]));
    }

    public function testGetKey()
    {
        $this->assertEquals("boolean", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo should be a boolean",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
