<?php

namespace WebmanTech\LogReader;

use Kriss\LogReader\LogReader as PhpLogReader;
use Webman\Route;
use WebmanTech\LogReader\Controller\LogReaderController;
use WebmanTech\LogReader\Helper\ConfigHelper;

class LogReader
{
    /**
     * @var null|PhpLogReader
     */
    protected static $_instance = null;

    public static function instance(): PhpLogReader
    {
        if (!static::$_instance) {
            $config = (array)ConfigHelper::get('log-reader', []);
            static::$_instance = static::createLogReader($config);
        }
        return static::$_instance;
    }

    protected static function createLogReader(array $config): PhpLogReader
    {
        $logPath = $config['logPath'] ?? runtime_path() . '/logs';
        unset($config['logPath']);
        $config['enable'] ??= true;

        return new PhpLogReader($logPath, $config);
    }

    public static function registerRoute(): void
    {
        $config = (array)ConfigHelper::get('log-reader.route', []);

        Route::group((string)($config['group'] ?? ''), function (): void {
            Route::get('', [LogReaderController::class, 'index']);
            Route::get('/index', [LogReaderController::class, 'index']);
            Route::get('/view', [LogReaderController::class, 'view']);
            Route::get('/tail', [LogReaderController::class, 'tail']);
            Route::get('/download', [LogReaderController::class, 'download']);
            Route::get('/delete', [LogReaderController::class, 'delete']);
        })->middleware($config['middleware'] ?? []);
    }

    /**
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return static::instance()->{$name}(... $arguments);
    }
}
