<?php


namespace Atom\Validation\Test\Constraints;


use Atom\Validation\Constraints\EmailConstraint;
use Atom\Validation\Test\BaseTestCase;

class EmailConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new EmailConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => "foo@bar.com"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "john.doe@bar.com"]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "baz"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "@bae.com"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("email", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "The field foo should be a valid email",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}