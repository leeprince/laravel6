<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <title>Document</title>
</head>
<body>
<fieldset>
    <legend>表单验证窗口</legend>
    @if ($errors->all())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route("validate.form")}}" method="post">
        @csrf
        <table>
            <tr>
                <td>命名空间(命名空间可以包含类名，然后下面的类名可以省略)</td>
                <td><input type="text" name="namespace"></td>
            </tr>
            <tr>
                <td>类名</td>
                <td><input type="text" name="className"></td>
            </tr>
            <tr>
                <td>测试方法名</td>
                <td><input type="text" name="action"></td>
            </tr>
            <tr>
                <td>传递参数以英文 | 分割</td>
                <td><input type="text" name="param"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="开始测试"></td>
            </tr>
        </table>
    </form>
</fieldset>
</body>
</html>

<style>
    input {
        width: 200px;
    }
    input[type=submit] {
        width: 100%;
        margin-top: 50px;
    }
</style>