<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Models\AdminUser;

class LoginController extends Controller
{
    protected $result = array(
        "result" => '',
        "reason" => ''
    );
    /**
     * 登录模块
     * func  : login
     * method: post
     * param : username
     * param : password
     * return: <object> --success:{'result':'1','reason':''}
     *               |-false:{'result':'0','reason':'false reason'}
     */
    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $collect = AdminUser::where('username',$username)->first();
        if ($collect){
            //判断密码正误
            if (Crypt::decrypt($collect->password) === $password){
                $pwd = base64_encode($collect->password);
                session(['username'=>$username,'token'=>$pwd]);
                $this->result['result'] = 'true';
                $this->result['reason'] = '';
            }else{
                $this->result['result'] = 'false';
                $this->result['reason'] = '密码错误';
            }
        }else{
            $this->result['result'] = 'false';
            $this->result['reason'] = '用户不存在';
        }
        return $this->result;
    }
}
