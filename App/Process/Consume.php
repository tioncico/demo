<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 20-2-10
 * Time: 下午2:17
 */

namespace App\Process;


use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\Log\Logger;
use EasySwoole\RedisPool\Redis;

class Consume extends AbstractProcess
{
    protected function run($arg)
    {
        $redis = Redis::defer('redis');
        \EasySwoole\EasySwoole\Logger::getInstance()->console("消费进程启动");

        while (1) {
            $data = $redis->lPop('testQueue');
            if (empty($data)) {
                \co::sleep(1);
                continue;
            }
            //这里做队列处理
            var_dump($data);
        }

        // TODO: Implement run() method.
    }
}