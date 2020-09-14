<?php


namespace Atom\Validation;

use Atom\Validation\Scopes\AllScope;
use Atom\Validation\Scopes\FilesScope;
use Atom\Validation\Scopes\QueryParamsScope;
use Atom\Validation\Scopes\RequestBodyScope;

class Scope
{
    public static function all()
    {
        return new AllScope();
    }
    public static function body()
    {
        return new RequestBodyScope();
    }
    public static function queryParams()
    {
        return new QueryParamsScope();
    }
    public static function files()
    {
        return new FilesScope();
    }
}
