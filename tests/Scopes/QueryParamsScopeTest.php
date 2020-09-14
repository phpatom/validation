<?php


namespace Atom\Validation\Test\Scopes;

use Atom\Validation\Scopes\QueryParamsScope;
use Atom\Validation\Test\BaseTestCase;
use Atom\Validation\Translation\TranslationBag;

class QueryParamsScopeTest extends BaseTestCase
{
    public function testLabel()
    {
        $this->assertEquals(QueryParamsScope::LABEL, (new QueryParamsScope())->getLabel());
    }

    public function testDataOf()
    {
        $scope = new QueryParamsScope();
        $this->assertEmpty($scope->dataOf($this->makeRequest()));
        $request = $this->makeRequest([], $data= ["foo"=>"baz"]);
        $this->assertEquals($data, $scope->dataOf($request));
    }

    public function testTranslate()
    {
        $bag = new TranslationBag();
        $bag->add("foo", 'bar');
        $bag->add("bar", 'baz');
        $this->assertEquals("bar", $bag->translate("foo"));
        $this->assertEquals("barbaz", $bag->translate("baz", [], "barbaz"));

        $this->assertEquals("baz", $bag->translate("baz"));
        $this->assertEquals("baz", $bag->translate("bar"));
        $this->assertEquals("baz", $bag->translate("bar"));
    }

    public function testGetTranslations()
    {
        $bag = new TranslationBag();
        $this->assertEmpty($bag->getTranslations());
        $bag->add("foo", 'bar');
        $bag->add("bar", 'baz');
        $this->assertEquals(["foo" => "bar", "bar"=>"baz"], $bag->getTranslations());
    }
}
