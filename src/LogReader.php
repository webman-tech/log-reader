<?php

namespace Kriss\WebmanLogReader;

use Kriss\LogReader\LogReader as PhpLogReader;
use Kriss\WebmanLogReader\Controller\LogReaderController;
use Webman\Route;

class LogReader
{
    protected static ?PhpLogReader $_instance = null;

    public static function instance(): PhpLogReader
    {
        if (!static::$_instance) {
            $config = config('plugin.kriss.webman-log-reader.log-reader', []);
            static::$_instance = static::createLogReader($config);
        }
        return static::$_instance;
    }

    protected static function createLogReader(array $config): PhpLogReader
    {
        $logPath = $config['logPath'] ?? runtime_path() . '/logs';
        unset($config['logPath']);
        $config['enable'] = $config['enable'] ?? true;

        return new PhpLogReader($logPath, $config);
    }

    public static function registerRoute(): void
    {
        $config = config('plugin.kriss.webman-log-reader.log-reader.route', []);

        Route::group($config['group'] ?? '', function () {
            Route::get('', [LogReaderController::class, 'index']);
            Route::get('/index', [LogReaderController::class, 'index']);
            Route::get('/view', [LogReaderController::class, 'view']);
            Route::get('/tail', [LogReaderController::class, 'tail']);
            Route::get('/download', [LogReaderController::class, 'download']);
            Route::get('/delete', [LogReaderController::class, 'delete']);
        });
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::instance()->{$name}(... $arguments);
    }
}