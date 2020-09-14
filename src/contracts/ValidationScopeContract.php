<?php


namespace Atom\Validation\Contracts;

use Psr\Http\Message\ServerRequestInterface;

interface ValidationScopeContract
{
    public function getLabel();
    public function dataOf(ServerRequestInterface $request):array;
}
