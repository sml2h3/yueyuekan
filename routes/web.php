<?php
/**
 * 后台页面以及Api
 */
Route::get('test','Admin\SliderController@test');
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    /**
     * 后台的api接口,使用adminpai中间件
     */
    Route::group(['middleware'=>'admin.api'],function(){
        Route::post('wx_setMenu',"WechatController@setMenu");
    });
    /**
     * 后台的api接口,不使用中间件
     */
    Route::group([],function(){
        //微信消息街口
        Route::any('wechat','WechatController@wechat');
        Route::post('login','LoginController@login');
    });
    /**
     * 后台的界面设计,使用adminlayouts中间件
     */
    Route::group(['middleware'=>'admin.layouts'],function(){
        //后台首页
        Route::get('index','LayoutController@index');
        //系统设置页
        Route::get('setting','LayoutController@setting');
        //微信运营平台
        Route::get('wxset','LayoutController@wxset');
    });
    /**
     * 后台的界面设计,不使用中间件
     */
    Route::group([],function(){
        Route::get('login',function(){
           return view('admin.login');
        });
    });
});
