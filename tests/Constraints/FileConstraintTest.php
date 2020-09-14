<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\FileConstraint;
use Atom\Validation\Test\BaseTestCase;
use Psr\Http\Message\UploadedFileInterface;

class FileConstraintTest extends BaseTestCase
{
    private function makeConstraint()
    {
        return new FileConstraint();
    }
    public function testValidate()
    {
        $file = $this->getMockBuilder(UploadedFileInterface::class)->getMock();
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => $file]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "not file"]));
    }

    public function testGetKey()
    {
        $this->assertEquals("file", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo should be a file",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
