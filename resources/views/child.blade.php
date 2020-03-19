{{--继承master模版--}}
@extends('layouts.master')

@section('ttile', 'myTitle')
@section('version', '0.0.1')

@section('sidebar')
    {{--@parent--}}

    <p>- This is sidebar append - 00</p>
{{--@stop 和 @endsection 结束关键字--}}
{{--这两个代表的都一样,@endsection属于老版本,新版本都用@stop,所以建议以后都是用@stop--}}
{{--@endsection--}}
@endsection
@section('sidebar')
    <p>- This is sidebar append - 01</p>
@append
@section('sidebar')
    <p>- This is sidebar append - 02</p>
@append
{{--@endsection--}}
{{--@stop--}}
@section('sidebar')
    {{--这是注意下：在第一个@section('sidebar')定义了@parent. 之后再调用@stop显示的结果会打乱--}}
    <p>- This is sidebar append - 03</p>
{{--@stop 则只是进行内容解析，并且不再处理当前模板中后续对该section的处理。并不输出内容到页面; 但是如果前面定义了@parent则会覆盖@parent的内容--}}
{{--@append--}}
@stop
{{--@endsection--}}

@section('content', '<p>This is my body content</p>')
@section('content')
    @parent
    <p>我是模版继承 - 01</p>
@append
@section('content')
    <p>我是模版继承 - 02</p>
@append
{{--@section('content')--}}
    {{--<p>This is my body content - 03</p>--}}
{{--@overwrite：覆盖之前的所有定义，以这次的为准--}}
{{--@overwrite--}}
{{--@stop--}}
{{--@endsection--}}

@section('stop')
    child - stop - 继承01
@endsection

@section('footer')
    child - footer - 继承 - 01
    <br>
@endsection


