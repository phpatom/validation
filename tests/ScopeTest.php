<?php


namespace Atom\Validation\Test;

use Atom\Validation\Scope;
use Atom\Validation\Scopes\AllScope;
use Atom\Validation\Scopes\FilesScope;
use Atom\Validation\Scopes\QueryParamsScope;
use Atom\Validation\Scopes\RequestBodyScope;
use PHPUnit\Framework\TestCase;

class ScopeTest extends TestCase
{

    public function testFactories()
    {
        $this->assertInstanceOf(RequestBodyScope::class, Scope::body());
        $this->assertInstanceOf(QueryParamsScope::class, Scope::queryParams());
        $this->assertInstanceOf(AllScope::class, Scope::all());
        $this->assertInstanceOf(FilesScope::class, Scope::files());
    }
}
