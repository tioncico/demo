<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use App\Process\Consume;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\DbManager;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');
//redis连接池注册(config默认为127.0.0.1,端口6379)
        \EasySwoole\RedisPool\Redis::getInstance()->register('redis', new \EasySwoole\Redis\Config\RedisConfig(
            [
                'host' => '127.0.0.1',
                'port' => 6379,
            ]
        ));

    }

    public static function mainServerCreate(EventRegister $register)
    {
        $processConfig = new \EasySwoole\Component\Process\Config();
        $processConfig->setProcessName('consume');
        $processConfig->setEnableCoroutine(true);
        ServerManager::getInstance()->getSwooleServer()->addProcess((new Consume($processConfig))->getProcess());

    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}