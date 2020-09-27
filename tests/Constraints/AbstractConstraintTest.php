<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\AbstractConstraint;
use Atom\Validation\Test\BaseTestCase;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\UploadedFileInterface;

class AbstractConstraintTest extends BaseTestCase
{
    /**
     * @return AbstractConstraint|MockObject
     */
    private function makeConstraint()
    {
        return $this->getMockForAbstractClass(AbstractConstraint::class);
    }

    public function testCheck()
    {
        $constraint = $this->makeConstraint();
        $constraint->method("validate")->willReturn(true);
        $this->assertNull($constraint->check("bar", []));

        $constraint = $this->makeConstraint();
        $constraint->method("validate")->willReturn(false);
        $constraint->method("getKey")->willReturn("foo");
        $this->assertEquals("foo", $constraint->check("bar", []));
    }

    public function testExists()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->exist("foo", ["foo" => "bar"]));
        $this->assertFalse($constraint->exist("baz", ["foo" => "bar"]));
    }

    public function testValue()
    {
        $constraint = $this->makeConstraint();
        $this->assertEquals("bar", $constraint->value("foo", ["foo" => "bar"]));
        $this->assertNull($constraint->value("baz", ["foo" => "bar"]));
    }

    public function testGetAttributes()
    {
        $constraint = $this->makeConstraint();
        $this->assertEquals($constraint->getAttributes(), []);
    }

    /**
     * @throws Exception
     */
    public function testLengthOf()
    {
        $constraint = $this->makeConstraint();
        $this->assertEquals($constraint->lengthOf("foo", ["foo" => 4]), 4);
        $this->assertEquals($constraint->lengthOf("foo", ["foo" => 3.1]), 3.1);
        $this->assertEquals($constraint->lengthOf("foo", ["foo" => ["a", "b", "c", "d"]]), 4);
        $this->assertEquals($constraint->lengthOf("foo", ["foo" => "abcde"]), 5);
        $this->assertEquals($constraint->lengthOf("foo", ["foo" => "24"]), 24);
        $file = $this->getMockBuilder(UploadedFileInterface::class)->getMock();
        $file->method("getSize")->willReturn("5000");
        $this->assertEquals($constraint->lengthOf("foo", ["foo" => $file]), 5000);

        $this->expectException(\Exception::class);
        $constraint->lengthOf("foo", ["foo" => new \StdClass()]);
    }
}
