<?php


namespace Atom\Validation\Scopes;

use Atom\Validation\Contracts\ValidationScopeContract;
use Psr\Http\Message\ServerRequestInterface;

class FilesScope implements ValidationScopeContract
{
    const LABEL = "FILE_SCOPE";
    public function getLabel()
    {
        return self::LABEL;
    }

    public function dataOf(ServerRequestInterface $request): array
    {
        return $request->getUploadedFiles();
    }
}
