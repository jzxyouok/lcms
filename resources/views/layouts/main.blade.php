<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <title>Title</title>
        <link href="{{ asset('statics/css/reset.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('statics/css/zh-cn-system.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('statics/css/table_form.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('statics/css/dialog.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{ asset('statics/css/style/zh-cn-styles1.css') }}" title="styles1" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="{{ asset('statics/css/style/zh-cn-styles2.css') }}" title="styles2" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="{{ asset('statics/css/style/zh-cn-styles3.css') }}" title="styles3" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="{{ asset('statics/css/style/zh-cn-styles4.css') }}" title="styles4" media="screen" />
        @section('stylesheets')
        @show

        <script language="javascript" type="text/javascript" src="{{ asset('statics/js/jquery.min.js') }}"></script>
        <script language="javascript" type="text/javascript" src="{{ asset('statics/js/admin_common.js') }}"></script>
        <script language="javascript" type="text/javascript" src="{{ asset('statics/js/styleswitch.js') }}"></script>

        <script language="javascript" type="text/javascript" src="{{ asset('statics/js/formvalidator.js') }}" charset="UTF-8"></script>
        <script language="javascript" type="text/javascript" src="{{ asset('statics/js/formvalidatorregex.js') }}" charset="UTF-8"></script>
        @section('scripts')
        @show

        <script type="text/javascript">
         window.focus();
         var pc_hash = 'pc_hash';
        </script>

        <style type="text/css">
         html{_overflow-y:scroll}
        </style>
    </head>
    <body>

        <div class="subnav">
            <div class="content-menu ib-a blue line-x">
                @foreach ($submenus as $submenu)
                    @if ($submenu['route'] == $route_name)
                        <a href="javascript:;" class="on"><em>{{ $submenu['name'] }}</em></a><span>|</span>
                    @else
                        <a href="{{ route($submenu['route']) }}?menuid={{ $menuid }}"><em>{{ $submenu['name'] }}</em></a><span>|</span>
                    @endif
                @endforeach
            </div>
        </div>

        @yield('content')

    </body>
</html>
