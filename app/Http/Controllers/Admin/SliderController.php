<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\AdminSlider;

class SliderController extends Controller
{
    protected $slider;
    public function __construct()
    {
        $array = array();
        $count = array();
        $collect = AdminSlider::all();
        foreach ($collect as $c){
            $Id = $c->Id;
            $linkId = $c->linkId;
            if ($linkId == '0'){
                $array['first'][$Id] = $c;
            }else{
                if (isset($count[$linkId])){
                    $count[$linkId] = $count[$linkId] + 1;
                }else{
                    $count[$linkId] = 1;
                }
                $array['link'][$linkId][] = $c;
            }
        }
        foreach ($count as $key => $value){
            $array['first'][$key]['count'] = $value;
        }
        $this->slider = $array;
    }
    public function test(){
        return $this->slider;
    }
    public function compose(View $view){
        $view->with('slider',$this->slider);
    }
}
