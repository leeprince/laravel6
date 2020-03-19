<html>
<head>
    <title>App name - @yield('title') - @yield('version', '0.0.0')</title>
</head>
<body>
    {{--显示视图的一部分--}}
    @section('sidebar')
        master - sidebar - 默认原内容
    @show

    <div class="container">
        {{--显示指定的值--}}
        @yield('content', 'master - content - 默认原内容')
        {{--@section('content')--}}
            {{--默认原内容--}}
        {{--@show--}}
    </div>


    <div>

        @section('stop')
            master - stop - 默认原内容
        @stop
    </div>

    <div class="footer">
        @section('footer')
            master - footer - 默认原内容
        @show
    </div>
</body>
</html>
