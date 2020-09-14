<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\ImageConstraint;
use Atom\Validation\Test\BaseTestCase;
use Psr\Http\Message\UploadedFileInterface;

class ImageConstraintTest extends BaseTestCase
{
    private function makeFile(string $extension)
    {
        $file = $this->getMockBuilder(UploadedFileInterface::class)->getMock();
        $file->method("getClientFilename")->willReturn("foo/bar.$extension");
        return $file;
    }
    private function makeConstraint()
    {
        return new ImageConstraint();
    }
    public function testValidate()
    {
        $constraint = $this->makeConstraint();
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("png")]));
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("jpg")]));
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("jpeg")]));
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("bmp")]));
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("gif")]));
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("svg")]));
        $this->assertTrue($constraint->validate("foo", ["foo" => $this->makeFile("webp")]));

        $this->assertFalse($constraint->validate("foo", ["foo" => "not file"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => $this->makeFile("pdf")]));
        $this->assertFalse($constraint->validate("foo", ["foo" => $this->makeFile("docx")]));
        $this->assertFalse($constraint->validate("foo", ["foo" => $this->makeFile("exe")]));
    }

    public function testGetKey()
    {
        $this->assertEquals("image", $this->makeConstraint()->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "foo should be an image",
            $this->makeConstraint()->getFallbackErrorMessage("foo")
        );
    }
}
