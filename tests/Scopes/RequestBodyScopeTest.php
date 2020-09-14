<?php


namespace Atom\Validation\Test\Scopes;

use Atom\Validation\Scopes\RequestBodyScope;
use Atom\Validation\Test\BaseTestCase;

class RequestBodyScopeTest extends BaseTestCase
{

    public function testLabel()
    {
        $this->assertEquals(RequestBodyScope::LABEL, (new RequestBodyScope())->getLabel());
    }

    public function testDataOf()
    {
        $scope = new RequestBodyScope();
        $this->assertEmpty($scope->dataOf($this->makeRequest()));
        $request = $this->makeRequest($data= ["foo"=>"baz"]);
        $this->assertEquals($data, $scope->dataOf($request));
    }
}
