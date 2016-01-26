@extends('layouts.main')

@section('content')
    <script type="text/javascript">
     $(function(){
         $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
         $("#name").formValidator({
             onshow:"请输入菜单名称",
             onfocus:"请输入菜单名称",
             oncorrect:"输入正确"}).inputValidator({min:1,onerror:"请输入菜单名称"});

         $("#route").formValidator({
             tipid:'a_tip',onshow:"请输入路由名称",
             onfocus:"请输入路由名称",
             oncorrect:"输入正取"}).inputValidator({min:1,onerror:"请输入路由名称"});
     })
    </script>

    <form name="myform" id="myform" action="{{ route('menus.store') }}" method="post">
        <div class="common-form">

            <table width="100%" class="table_form contentWrap">
                <tr>
                    <th width="200">{{ trans('menu.menu_parentid') }}：</th>
                    <td>
                        <select name="info[parentid]" >
                            <option value="0">{{ trans('menu.no_parent_menu') }}</option>
                            {!! $select !!}
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('menu.menu_name') }}：</th>
                    <td><input type="text" name="info[name]" id="name" class="input-text" ></td>
                </tr>
                <tr>
                    <th>{{ trans('menu.route') }}：</th>
                    <td><input type="text" name="info[route]" id="route" class="input-text" ></td>
                </tr>
                <tr>
                    <th>{{ trans('menu.menu_display') }}：</th>
                    <td>
                        <input type="radio" name="info[display]" value="1" checked> {{ trans('menu.yes') }}
                        <input type="radio" name="info[display]" value="0"> {{ trans('menu.no') }}
                    </td>
                </tr>
            </table>
            <!--table_form_off-->
        </div>
        <div class="bk15"></div>
        <div class="btn">
            <input type="submit" id="dosubmit" class="button" name="dosubmit" value="提交"/></div>
        </div>
    </form>

@endsection
