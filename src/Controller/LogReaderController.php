<?php

namespace Kriss\WebmanLogReader\Controller;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Webman\Http\Response;

class LogReaderController extends SymfonyResponseLogReaderController
{
    public function view()
    {
        return $this->transSymfonyResponse(parent::view());
    }

    public function tail()
    {
        return $this->transSymfonyResponse(parent::tail());
    }

    public function download()
    {
        return $this->transSymfonyResponse(parent::download());
    }

    public function delete()
    {
        return $this->transSymfonyResponse(parent::delete());
    }

    protected function transSymfonyResponse(SymfonyResponse $symfonyResponse): Response
    {
        // SymfonyResponse 的 header 关键字为全小写的，webman 目前识别不了，因此转化以下
        $headers = [];
        if ($originHeaders = $symfonyResponse->headers->all()) {
            foreach ($originHeaders as $key => $value) {
                $key = implode('-', array_map('ucfirst', explode('-', $key)));
                $headers[$key] = is_array($value) ? $value[0] : $value;
            }
        }

        $response = response($symfonyResponse->getContent())
            ->withStatus($symfonyResponse->getStatusCode(), SymfonyResponse::$statusTexts[$symfonyResponse->getStatusCode()] ?? '')
            ->withHeaders($headers);
        if ($symfonyResponse instanceof BinaryFileResponse) {
            $response->withFile($symfonyResponse->getFile());
        }
        return $response;
    }
}