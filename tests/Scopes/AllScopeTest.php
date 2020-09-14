<?php


namespace Atom\Validation\Test\Scopes;

use Atom\Validation\Scopes\AllScope;
use Atom\Validation\Test\BaseTestCase;

class AllScopeTest extends BaseTestCase
{
    public function testLabel()
    {
        $this->assertEquals(AllScope::LABEL, (new AllScope())->getLabel());
    }

    public function testDataOf()
    {
        $scope = new AllScope();
        $this->assertEmpty($scope->dataOf($this->makeRequest()));
        $request = $this->makeRequest($data1 = ["foo"=>"bar"], $data2= ["bar"=>"baz"]);
        $this->assertEquals(array_merge($data1, $data2), $scope->dataOf($request));
    }
}
