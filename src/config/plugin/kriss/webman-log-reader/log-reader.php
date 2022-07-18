<?php

return [
    // route
    'route' => [
        // 路由前缀
        'group' => '/log-reader',
        // 路由中间件，可以用于控制访问权限
        'middleware' => [],
    ],
    /**
     * 以下参数为 LogReader 的属性参数
     * @see Kriss\LogReader\LogReader
     */
    // 是否允许删除
    'deleteEnable' => true,
    // 日志根路径
    'logPath' => runtime_path() . '/logs',
    // tail 查看时默认读取的行大小
    'tailDefaultLine' => 200,
];