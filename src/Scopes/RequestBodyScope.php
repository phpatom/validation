<?php


namespace Atom\Validation\Scopes;

use Atom\Validation\Contracts\ValidationScopeContract;
use Psr\Http\Message\ServerRequestInterface;

class RequestBodyScope implements ValidationScopeContract
{
    const LABEL = "BODY_SCOPE";
    public function getLabel()
    {
        return self::LABEL;
    }

    public function dataOf(ServerRequestInterface $request):array
    {
        return $request->getParsedBody();
    }
}
