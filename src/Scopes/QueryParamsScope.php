<?php


namespace Atom\Validation\Scopes;

use Atom\Validation\Contracts\ValidationScopeContract;
use Psr\Http\Message\ServerRequestInterface;

class QueryParamsScope implements ValidationScopeContract
{
    const LABEL = "QUERY_PARAMS_SCOPE";
    public function getLabel()
    {
        return self::LABEL;
    }

    public function dataOf(ServerRequestInterface $request):array
    {
        return $request->getQueryParams();
    }
}
