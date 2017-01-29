<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * 使用easywechat接收消息
     */
    public function wechat(){
        //实例化easywechat
        $wechat = app('wechat');
        $server = $wechat->server;
        //接收消息的回调函数
        $server->setMessageHandler(function ($message) {
            return "您好！欢迎关注我!";
        });
        $response = $server->serve();
        return $response;
    }

    /**
     * @param Request $request
     * 上传自定义菜单设置
     */
    public function setMenu(Request $request){
        $wechat = app('wechat');
        $menu = $wechat->menu;
        $result = $menu->add(($request->get('menu')));
        return $result;
    }
}
