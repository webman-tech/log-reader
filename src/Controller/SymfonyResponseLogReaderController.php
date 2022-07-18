<?php

namespace Kriss\WebmanLogReader\Controller;

use Kriss\LogReader\LogReader as PhpLogReader;
use Kriss\LogReader\Traits\LogReaderControllerTrait;
use Kriss\WebmanLogReader\LogReader;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * 响应为 SymfonyResponse
 */
class SymfonyResponseLogReaderController
{
    use LogReaderControllerTrait;

    protected function getLogReader(): PhpLogReader
    {
        return LogReader::instance();
    }

    protected function getRequest(): SymfonyRequest
    {
        $request = request();
        $symfonyRequest = new SymfonyRequest(
            $request->get(),
            $request->post(),
            [],
            $request->cookie(),
            [],
            [],
            $request->rawBody()
        );
        $symfonyRequest->headers = new HeaderBag($request->header());
        return $symfonyRequest;
    }

    protected function getBaseUrl(): string
    {
        return config('plugin.kriss.webman-log-reader.log-reader.route.group', '');
    }
}