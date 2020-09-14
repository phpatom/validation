<?php


namespace Atom\Validation\Scopes;

use Atom\Validation\Contracts\ValidationScopeContract;
use Psr\Http\Message\ServerRequestInterface;

class AllScope implements ValidationScopeContract
{
    const LABEL = "ALL_SCOPE";
    public function getLabel()
    {
        return self::LABEL;
    }

    public function dataOf(ServerRequestInterface $request):array
    {
        return array_merge($request->getQueryParams(), $request->getParsedBody(), $request->getUploadedFiles());
    }
}
