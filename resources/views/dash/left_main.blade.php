@foreach ($left_menus as $menu)
    <h3 class="f14">
        <span class="switchs cu on" title="{{ trans('dashboard.expand_or_contract') }}"></span>{{ $menu['name'] }}
    </h3>
    <ul>
        @foreach ($menu['child'] as $m)
            <li id="_MP{{ $m['id'] }}" class="sub_menu">
                <a href="javascript:_MP({{ $m['id'] }}, '{{ route($m['route']) }}');" hidefocus="true" style="outline:none;">{{ $m['name'] }}</a>
            </li>
        @endforeach
    </ul>
@endforeach

<script type="text/javascript">
 $(".switchs").each(function(i){
     var ul = $(this).parent().next();
     $(this).click(
         function(){
             if(ul.is(':visible')){
                 ul.hide();
                 $(this).removeClass('on');
             }else{
                 ul.show();
                 $(this).addClass('on');
             }
         })
 });
</script>
