@extends('layouts.main')

@section('content')
<form name="myform" action="?m=admin&c=menu&a=listorder" method="post">
    <div class="pad-lr-10">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="80">排序</th>
                        <th width="100">ID</th>
                        <th>菜单名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    {!! $content !!}
                </tbody>
            </table>

            <div class="btn"><input type="submit" class="button" name="dosubmit" value="排序" /></div>  </div>
    </div>
    </div>
</form>
@endsection
