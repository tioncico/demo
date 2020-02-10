<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 19-12-14
 * Time: 下午12:21
 */

namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\RedisPool\Redis;

class Index extends Controller
{
    function index()
    {
        $param = $this->request()->getRequestParam();
        $redis = Redis::defer('redis');

        $redis->rPush('testQueue',json_encode([
            'data'=>$param['data']??'xsk',
            'name'=>$param['name']??'仙士可'
        ]));

        $this->writeJson(200,[],'success');
        // TODO: Implement index() method.
    }


}