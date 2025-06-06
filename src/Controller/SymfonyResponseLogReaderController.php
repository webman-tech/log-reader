<?php

namespace WebmanTech\LogReader\Controller;

use Kriss\LogReader\LogReader as PhpLogReader;
use Kriss\LogReader\Traits\LogReaderControllerTrait;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use WebmanTech\LogReader\Helper\ConfigHelper;
use WebmanTech\LogReader\LogReader;

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
        if (!$request) {
            return new SymfonyRequest();
        }

        $symfonyRequest = new SymfonyRequest(
            (array)$request->get(),
            (array)$request->post(),
            [],
            (array)$request->cookie(),
            [],
            [],
            $request->rawBody()
        );
        $symfonyRequest->headers = new HeaderBag((array)$request->header());
        return $symfonyRequest;
    }

    protected function getBaseUrl(): string
    {
        $urlMaker = ConfigHelper::get('log-reader.route.url_maker');
        $url = (string)ConfigHelper::get('log-reader.route.group', '');
        if (is_callable($urlMaker)) {
            $url = (string)$urlMaker($url);
        }
        return $url;
    }
}
