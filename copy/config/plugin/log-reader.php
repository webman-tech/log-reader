<?php

return [
    // route
    'route' => [
        // 路由前缀
        'group' => '/log-reader',
        // 路由中间件，可以用于控制访问权限
        'middleware' => [],
        // 路由创建，fn(string $url) => string，用于二级目录访问场景
        'url_maker' => null,
    ],
    /**
     * 以下参数为 LogReader 的属性参数
     * @see Kriss\LogReader\LogReader
     */
    // 是否允许删除
    'deleteEnable' => config('app.debug', false),
    // 日志根路径
    'logPath' => runtime_path() . '/logs',
    // tail 查看时默认读取的行大小
    'tailDefaultLine' => 200,
];
