<?php
namespace  Atom\Validation\Contracts;

use Psr\Http\Message\ServerRequestInterface;

interface ValidatorContract
{
    public function validate(ServerRequestInterface $request);
}
