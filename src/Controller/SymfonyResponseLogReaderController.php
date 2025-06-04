<?php

namespace WebmanTech\LogReader\Controller;

use Kriss\LogReader\LogReader as PhpLogReader;
use Kriss\LogReader\Traits\LogReaderControllerTrait;
use WebmanTech\LogReader\LogReader;
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
        $urlMaker = config('plugin.webman-tech.log-reader.log-reader.route.url_maker');
        $url = config('plugin.webman-tech.log-reader.log-reader.route.group', '');
        if (is_callable($urlMaker)) {
            $url = $urlMaker($url);
        }
        return $url;
    }
}