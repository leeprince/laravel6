<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>hello, {{ json_encode($users) }}</h1>
    <h3>这是所有视图共享的数据 - {{ $shareData }}</h3>
    <h4>这是所有视图共享的数据 - {{ $shareDataMyView }}</h4>
    <h4>这是所有视图共享的数据 - {{ $flashName }}</h4>

    {{--if--}}
    @if ($type == 1)
        type = 1
    @elseif ($type == 2)
        type =2
    @else
        type is else
    @endif

    <br>

    {{--isset--}}
    @isset ($set)
        $set is set
    @endisset
    <br>

    {{--empty--}}
    @empty ($empty)
        $empty is empty
    @endempty
    <br>

    {{--auth--}}
    @auth
        当前用户已被校验
    @endauth
    {{--@auth ('leeprince')--}}
        {{--auth is leeprince--}}
    {{--@endauth--}}
    <br>

    {{--guest--}}
    @guest
        当前用户已被校验 - guest
    @endguest
    <br>

    {{--switch--}}
    @switch ($type)
        @case (1)
            switch_case_1
            @break
        @case (2)
            switch_case_2
            @break
        @case (3)
            switch_case_3
            @break
        @default
            switch default
    @endswitch
    <br>

    {{--for--}}
    @for ($i = 0; $i < 10; $i ++)
        the current value is {{ $i }}
        <br>
    @endfor

    {{--foreach--}}
    @foreach ($users as $user)
        - user name: {{ $user['name'] }}
        {{--@dump($loop)--}}
        @if ($loop->first)
            <br>
            -- is first loop
            <br>
        @endif
        @if ($loop->last)
            <br>
            -- is last loop
            <br>

        @endif
    @endforeach

    {{--forelse--}}
    @forelse ($userelse as $user)
        - user name: {{ $user['name'] }}

    @empty
        <p>No users</p>
    @endforelse

</body>
</html>


<script type="text/javascript">

{{--    var jsonData = @json($users);--}}
{{--    var jsonData = @json(['name' => 'leeprince']);--}}
    console.log(jsonData);
</script>