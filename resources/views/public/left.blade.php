<div class="left-nav">
        <div id="side-nav" style="max-width:200px;">
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
                @foreach($menu_tree as $menu)
                    <li class="layui-nav-item
                            @if(key_exists('children',$menu) && in_array($currRouteName,array_column($menu['children'],'route')))
                            layui-nav-itemed
                        @endif
                            ">
                        <a class="" href="javascript:;">{{ $menu['name'] }}</a>
                        <dl class="layui-nav-child">
                            @if(key_exists('children',$menu))
                                @foreach($menu['children'] as $child)
                                    <dd
                                            @if($currRouteName == $child['route'])
                                            class="layui-this"
                                            @endif
                                    ><a href="{{ route($child['route']) }}">{{ $child['name'] }}</a></dd>
                                @endforeach
                            @endif
                        </dl>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>