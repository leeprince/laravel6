{{--@component('layouts.alert')--}}
    {{--<sttong>我是组件实现插槽的内容</sttong>--}}
{{--@endcomponent--}}


{{--@componentFirst(['custom.alert', 'alert])--}}
    {{--<sttong>我是组件实现插槽的内容</sttong>--}}
{{--@endcomponent--}}


@component('layouts.alert')
    @slot('title')
        我是插槽的标题
    @endslot

    <sttong>我是组件实现插槽的内容</sttong>
@endcomponent