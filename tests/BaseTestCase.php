<?php


namespace Atom\Validation\Test;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseTestCase extends TestCase
{
    /**
     * @param array $body
     * @param array $query
     * @param array $headers
     * @param array $files
     * @return MockObject|ServerRequestInterface
     */
    protected function makeRequest(array $body = [], array $query = [], array $headers = [], array $files = [])
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->method("getParsedBody")->willReturn($body);
        $request->method("getQueryParams")->willReturn($query);
        $request->method("getHeaders")->willReturn($headers);
        $request->method("getUploadedFiles")->willReturn($files);
        return $request;
    }
}
