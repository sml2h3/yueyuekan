@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css?v=1n23ncnn') }}">
    <section class="content-header">
        <h1>
            微信通用设置平台
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3>自定义菜单设置</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6 col-xs-12">
                            <div class="bg">
                                <ul class="menuList">
                                    <li id="addmenu" class="menuli" islast="yes">
                                        <span>+添加菜单</span>
                                    </li>
                                </ul>
                                <div hidden>
                                    <li id="menuModel" class="menuli add" islast="no">
                                        <span class="tt">菜单名称</span>
                                        <div class="hdiv">
                                            <ul class="hli">
                                                <li class="addhli" islast="yes">+</li>
                                            </ul>
                                            <i class="arrow arrow-out"></i>
                                        </div>
                                    </li>
                                    <li id="sonli" class="sonmenu">子菜单名称</li>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 menu-set">
                            <h4>自定义菜单设置
                                <a href="javascript:;" id="f_menu"  target="0" style="display:none" class="pull-right del_menu">删除此主菜单</a>
                                <a href="javascript:;" id="s_menu" target-p="0" target="0" style="display:none" class="pull-right del_menu">删除此子菜单</a>
                            </h4>
                            <form>
                                <input type="hidden" id="target">
                                <div class="form-group">
                                    <label for="menutitle">菜单标题 <small>主菜单最多4个字,子菜单最多7个字</small></label>
                                    <input type="text" class="form-control" placeholder="菜单标题" id="menutitle">
                                </div>
                                <div class="form-group all">
                                    <label for="typeselect">选择功能</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" id="clickradio" value="click" disabled>
                                            点击事件(暂未开通)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" id="viewradio" value="view" checked="">
                                            跳转网页
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group all">
                                    <div class="viewbox">
                                        <label for="viewurl">跳转的地址</label>
                                        <input type="text" id="viewurl" placeholder="跳转的url" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="savemenu">保存菜单</button>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="upmenu">上传菜单设置</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var sonwidth = 264;
        var allWidth = $('.menuList').width();
        $('.menuList').on('click','#addmenu',function(){
            //添加主菜单
            var sid = getSid();
            $('.hdiv').hide();
            console.log($('.menuList .menuli').length)
            $('.menuli').css('border','1px solid #eee');
            $('.menuli').css('color','#999');
            if ($('.menuList .menuli').length == 3){
                //添加的最后一个
                $(this).hide().removeClass('menuli').addClass('menuliwait');
            }
            model = $('#menuModel').clone().removeAttr('id');
            $(this).before(model);
            var count = $('.menuList .menuli').length;
            sonwidth = allWidth/count;
            $('.menuList .menuli').css('width',allWidth/count);
            $('.hli li').css('width',sonwidth);
            $('#sonli').css('width',sonwidth);
            model.css('border','1px solid #44b549');
            model.css('color','#44b549');
            model.find('.hdiv').show();
            target = model;
            //设置随机编码,方便管理
            target.attr('target',sid);
            $('.del_menu').hide();
            $('#f_menu').attr('target',sid).show();
            $('#target').val(sid);
            $('#menutitle').val(target.children('span').text()).focus()
            $('.all').show()

        });
        $('.menuList').on('click','.tt',function(){
            //单机主菜单,弹出子菜单
            $('.hdiv').hide();
            $('.menuli').css('border','1px solid #eee');
            $('.menuli').css('color','#999');
            $('.sonmenu').css('border','1px solid #eee');
            $('.sonmenu').css('color','#999');
            $(this).parent().css('border','1px solid #44b549');
            $(this).parent().css('color','#44b549');
            $(this).next().show();
            $('.menu-set h4 a').hide();
            sid = $(this).parent().attr('target');
            $('#f_menu').attr('target',sid).show();
            $('#target').val(sid);
            if($(this).next().children('ul').children('li').length == 1){
                $('#menutitle').val($(this).text());
                $('#viewurl').val($(this).parent().attr('url'));
                $('.all').show();
            }else{
                $('#menutitle').val($(this).text())
                $('.all').hide()
            }

        });
        $('.menuList').on('click','.addhli',function(){
            //单击子菜单添加按钮
            len = $(this).parent().children().length;
            if(len == 1){
                var m = $(this).parent().parent().parent();
                url = m.attr('url');
                type = m.attr('type');
                if(url != undefined && type != undefined){
                    if(confirm("添加子菜单将会删除此所属主菜单除标题的信息,是否继续添加?")){
                        m.attr('url','');
                        m.attr('type','');
                    }else{
                        return;
                    }
                }
            }
            if(len == 5) {
                $(this).removeClass('addhli').addClass('addhliwait').hide();
            }
            var sid = getSid();
            $('.menuli').css('border','1px solid #eee');
            $('.menuli').css('color','#999');
            $('.sonmenu').css('border','1px solid #eee');
            $('.sonmenu').css('color','#999');
            son = $('#sonli').clone().removeAttr('id').attr('target',sid);
            son.css('border','1px solid #44b549');
            son.css('color','#44b549');
            $(this).before(son);
            $('.menu-set h4 a').hide();
            $('#s_menu').show().attr('target',sid);
            $('.all').show();
            $('#target').val(sid);
            $('#menutitle').val(son.text())

        });
        $('.menuList').on('click','.sonmenu',function(){
            //单击子菜单
            $('.menuli').css('border','1px solid #eee');
            $('.menuli').css('color','#999');
            $('.sonmenu').css('border','1px solid #eee');
            $('.sonmenu').css('color','#999');
            $(this).css('border','1px solid #44b549');
            $(this).css('color','#44b549');
            msid = $(this).attr('target');
            $('.menu-set h4 a').hide();
            $('#s_menu').show().attr('target',msid);
            $('#target').val(msid);
            $('#menutitle').val($(this).text());
            url = $(this).attr('url');
            $('#viewurl').val(url)
            $('.all').show()
        });
        $('#f_menu').click(function () {
            msid = $(this).attr('target').toString();
            target = $('li[target='+msid+']');
            $('li[target='+msid+']').remove();
            $('.menuliwait').removeClass('menuliwait').addClass('menuli').show()
            var count = $('.menuList .menuli').length;
            sonwidth = allWidth/count;
            $('.menuList .menuli').css('width',allWidth/count);
            $('.hli li').css('width',sonwidth);
            $('#sonli').css('width',sonwidth);
            $(this).hide();
            $(this).attr('target','')
        });
        $('#s_menu').click(function () {
            tar = $(this).attr('target');
            tar = $('li[target='+tar+']');
            tar.parent().children('.addhliwait').removeClass('addhliwait').addClass('addhli').show();
            tar.remove();
            $(this).hide();
            $(this).attr('target','')
        });
        function getSid() {
            sid = "";
            for (var i = 0;i < 6;i++){
                sid += Math.floor(Math.random() * 10);
            }
            return sid;
        }
        $('#savemenu').click(function(){
            if(confirm("确定要保存菜单吗?")){
                tar = $('#target').val();
                if(tar == '' || $('li[target='+tar+']').length == 0){
                    alert('error,无此菜单');
                    return;
                }else{
                    obj = $('li[target='+tar+']');
                    if(obj.children('.hdiv').children('.hli').children('li').length == 1){
                        obj.attr('type','view').attr('url',$('#viewurl').val());
                    }
                    if(obj.children('span').length == 1){
                        $('li[target='+tar+']').children('span').text($('#menutitle').val())
                    }else{
                        obj.attr('type','view').attr('url',$('#viewurl').val());
                        $('li[target='+tar+']').text($('#menutitle').val())
                    }
                    $('#menutitle').val("");
                    $('#viewurl').val("")
                    $('#target').val("")
                    $('.del_menu').hide().attr('target','');
                    $('.all').hide()
                }
            }
        })
        $('#upmenu').click(function () {
            if(confirm("确认是否已经完成菜单的全部设置?")){
                parlen = $('.menuList .add').length
                if(parlen == 0){
                    alert('请先设置菜单');
                    return;
                }else{
                    var menu = [];
                    for(var i = 0;i < parlen;i++){
                        tar = $('.menuList .add:eq('+i.toString()+')');
                        sonlen = tar.find('.sonmenu').length;
                        if(sonlen == 0){
                            //无子菜单
                            menu.push({'type':'view','name':tar.find('span').text(),'url':tar.attr('url')});
                        }else{
                            tttt = [];
                            for(var t = 0; t < sonlen;t++){
                                sontar = tar.find('.sonmenu:eq('+t.toString()+')');
                                tem = {'type':'view','name':sontar.text(),'url':sontar.attr('url')};
                                tttt.push(tem);
                            }
                            tem = {'name':tar.find('span').text(),'sub_button':tttt};
                            menu.push(tem)
                        }
                    }
                    $.ajax({
                        url:"wx_setMenu",
                        type:'post',
                        data:{
                            'menu':menu
                        }
                    })
                }
            }
        })
    </script>
    @endsection