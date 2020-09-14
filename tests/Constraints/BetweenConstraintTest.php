<?php


namespace Atom\Validation\Test\Constraints;

use Atom\Validation\Constraints\BetweenConstraint;
use Atom\Validation\Test\BaseTestCase;
use Psr\Http\Message\UploadedFileInterface;

class BetweenConstraintTest extends BaseTestCase
{
    private function makeConstraint(float $min, float $max)
    {
        return new BetweenConstraint($min, $max);
    }

    /**
     * @throws \Exception
     */
    public function testValidate()
    {
        $constraint = $this->makeConstraint(1, 3);
        $this->assertFalse($constraint->validate("foo", ["foo" => 4]));
        $this->assertFalse($constraint->validate("foo", ["foo" => 3.1]));
        $this->assertFalse($constraint->validate("foo", ["foo" => ["a","b","c","d"]]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "abcde"]));
        $this->assertFalse($constraint->validate("foo", ["foo" => "24"]));
        $file = $this->getMockBuilder(UploadedFileInterface::class)->getMock();
        $file->method("getSize")->willReturn("5000");
        $this->assertFalse($constraint->validate("foo", ["foo" => $file]));

        $constraint = $this->makeConstraint(1, 3);
        $this->assertTrue($constraint->validate("foo", ["foo" => 2]));
        $this->assertTrue($constraint->validate("foo", ["foo" => 1.1]));
        $this->assertTrue($constraint->validate("foo", ["foo" => ["a","b","c"]]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "abc"]));
        $this->assertTrue($constraint->validate("foo", ["foo" => "3"]));
        $file = $this->getMockBuilder(UploadedFileInterface::class)->getMock();
        $file->method("getSize")->willReturn("1");
        $this->assertTrue($constraint->validate("foo", ["foo" => $file]));
    }

    public function testGetKey()
    {
        $this->assertEquals("between", $this->makeConstraint(1, 3)->getKey());
    }

    public function testMessage()
    {
        $this->assertEquals(
            "The length/size of foo must be between 1, and 4",
            $this->makeConstraint(1, 4)->getFallbackErrorMessage("foo")
        );
    }

    public function testGetAttribute()
    {
        $this->assertEquals(["min"=>1,"max"=>4], $this->makeConstraint(1, 4)->getAttributes());
    }
}
