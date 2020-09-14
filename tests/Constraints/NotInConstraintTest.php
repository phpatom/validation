<?php


namespace Atom\Validation\Test\Constraints;
use Atom\Validation\Constraints\NotInConstraint;
use Atom\Validation\Test\BaseTestCase;

class NotInConstraintTest extends BaseTestCase
{

    private function makeConstraint(array $data = [])
    {
        return new NotInConstraint($data);
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint(["foo","bar",1,2]);
        $this->assertFalse($constraint->validate("foo", ["foo" => "foo"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "bar"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "1"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => 2]));

        $this->assertTrue($constraint->validate("foo", ["foo" => "baz"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 32]));
    }

    public function testGetKey()
    {
        $this->assertEquals("!in", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "The value of foo is not valid",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
