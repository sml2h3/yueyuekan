<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LayoutController extends Controller
{
    /**
     * 后台首页
     */
    public function index(){
        return view('admin.index');
    }
    /**
     * 系统设置页
     */
    public function setting(){
        return view('admin.setting');
    }
    /**
     * 微信运营平台-平台设置
     */
    public function wxset(){
        return view('admin.wxset');
    }
}
