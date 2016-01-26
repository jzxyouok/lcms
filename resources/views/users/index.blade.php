@extends('layouts.main')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('statics/js/calendar/jscal2.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('statics/js/calendar/border-radius.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('statics/js/calendar/win2k.css') }}"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('statics/js/calendar/calendar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('statics/js/calendar/lang/en.js') }}"></script>    
@endsection

@section('content')
    <div class="pad-lr-10">
        <form name="searchform" action="" method="get" >
            <input type="hidden" value="member" name="m">
            <input type="hidden" value="member" name="c">
            <input type="hidden" value="search" name="a">
            <input type="hidden" value="879" name="menuid">
            <table width="100%" cellspacing="0" class="search-form">
                <tbody>
                    <tr>
                        <td>
                            <div class="explain-col">
                                注册时间
                                <input type="text" name="start_time" id="start_time" value="" size="10" class="date" readonly>&nbsp;-
                                <input type="text" name="end_time" id="end_time" value="" size="10" class="date" readonly>&nbsp;
                                <select name="status">
                                    <option value='0'>状态</option>
                                    <option value='1'>锁定</option>
                                    <option value='2'>正常</option>
                                </select>

                                <select name="type">
                                    <option value='1'>用户名</option>
                                    <option value='2'>ID</option>
                                    <option value='3'>email</option>
                                </select>

                                <input name="keyword" type="text" value="" class="input-text" />
                                <input type="submit" name="search" class="button" value="搜索" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <form name="myform" action="?m=member&c=member&a=delete" method="post" onsubmit="checkuid();return false;">
            <div class="table-list">
                <table width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall('userid[]');"></th>
                            <th align="left"></th>
                            <th align="left">ID</th>
                            <th align="left">用户名</th>
                            <th align="left">昵称</th>
                            <th align="left">Email</th>
                            <th align="left">最后登录</th>
                            <th align="left">操作</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="btn">
                    <label for="check_box">全选/取消</label> <input type="submit" class="button" name="dosubmit" value="删除" onclick="return confirm('删除')"/>
                    <input type="submit" class="button" name="dosubmit" onclick="document.myform.action='?m=member&c=member&a=lock'" value="锁定"/>
                    <input type="submit" class="button" name="dosubmit" onclick="document.myform.action='?m=member&c=member&a=unlock'" value="解锁"/>
                    <input type="button" class="button" name="dosubmit" onclick="move();return false;" value="移动"/>
                </div>

                <div id="pages">分页</div>
            </div>
        </form>
    </div>
    <script type="text/javascript">

     Calendar.setup({
         weekNumbers: 'true',
         inputField : "start_time",
         trigger    : "start_time",
         dateFormat: "%Y-%m-%d",
         showTime: 'false',
         minuteStep: 1,
         onSelect   : function() {this.hide();}
     });

     Calendar.setup({
         weekNumbers: 'true',
         inputField : "end_time",
         trigger    : "end_time",
         dateFormat: "%Y-%m-%d",
         showTime: 'false',
         minuteStep: 1,
         onSelect   : function() {this.hide();}
     });



     function edit(id, name) {
         window.top.art.dialog({id:'edit'}).close();
         window.top.art.dialog({title:'修改用户《'+name+'》',id:'edit',iframe:'?m=member&c=member&a=edit&userid='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
     }
     function move() {
         var ids='';
         $("input[name='userid[]']:checked").each(function(i, n){
             ids += $(n).val() + ',';
         });
         if(ids=='') {
             window.top.art.dialog({content:'请选择用户',lock:true,width:'200',height:'50',time:1.5},function(){});
             return false;
         }
         window.top.art.dialog({id:'move'}).close();
         window.top.art.dialog({title:'移动用户',id:'move',iframe:'?m=member&c=member&a=move&ids='+ids,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'move'}).data.iframe;d.$('#dosubmit').click();return false;}, function(){window.top.art.dialog({id:'move'}).close()});
     }

     function checkuid() {
         var ids='';
         $("input[name='userid[]']:checked").each(function(i, n){
             ids += $(n).val() + ',';
         });
         if(ids=='') {
             window.top.art.dialog({content:'请选择用户',lock:true,width:'200',height:'50',time:1.5},function(){});
             return false;
         } else {
             myform.submit();
         }
     }

     function member_infomation(userid, modelid, name) {
         window.top.art.dialog({id:'modelinfo'}).close();
         window.top.art.dialog({title:'个人信息',id:'modelinfo',iframe:'?m=member&c=member&a=memberinfo&userid='+userid+'&modelid='+modelid,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'modelinfo'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'modelinfo'}).close()});
     }

    </script>
@endsection
