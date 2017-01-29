<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Crypt;
use Closure;
use App\Http\Models\AdminUser;

class adminlayouts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('username') && $request->session()->has('token')){
            $token = base64_decode(session('token'));
            $username = session('username');
            $collect = AdminUser::where('username',$username)->first();
            if ($collect){
                if (Crypt::decrypt($collect->password) === Crypt::decrypt($token)){

                }else{
                    return redirect()->to('/admin/login');
                }
            }else{
                return redirect()->to('/admin/login');
            }
        }else{
            return redirect()->to('/admin/login');
        }
        return $next($request);
    }
}
