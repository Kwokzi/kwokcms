{{--
* @[KwokCMS] Ver 1.0 (C) 2025 Mr.Kwok
* @FilePath: /resources/views/admin/base.blade.php
* @Created Time: 2025-03-06 11:32:36
* @Last Edit Time: 2025-03-19 17:24:56
* @Description: 后台管理基础模板
--}}
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="IE=Edge,chrome=1" http-equiv="X-UA-Compatible" />
    <title>【{{$web_name}}】后台管理系统</title>
    <link href="{{ asset('fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    @stack('head_mor')
</head>

<body>
    <header>

    </header>

    <footer class="footer mt-auto py-3 bg-body-tertiary" id="footer">
        <div class="text-center">
            <span class="text-body-secondary">Copyright &copy; {{date("Y")}} <strong> {{$app_name}}</strong> All rights reserved.</span>
            <span>
                本次请求耗时:{{round(microtime(true) - LARAVEL_START,3)}}秒,内存使用:{{round(memory_get_peak_usage(true)/1024/1024, 2)}}MB,
                {!!$copyright!!} v{{ Illuminate\Foundation\Application::VERSION }} Licensed
            </span>
        </div>
    </footer>
    <!-- Bootstrap -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('ajax-helper.js') }}"></script>
    <script src="{{ asset('helper.js') }}?v={{today()}}"></script>
    @stack('foot_mor')
    @if(session('success') || session('warning') || session('danger'))
    <script>
        @if(session('success')) toast('success','{{ session('success') }}','mt-5 pt-5 top-0 end-0'); @endif   
        @if(session('warning')) toast('warning','{{ session('warning') }}','mt-5 pt-5 top-0 end-0','警告'); @endif
        @if(session('danger')) toast('danger','{{ session('danger') }}','mt-5 pt-5 top-0 end-0','错误'); @endif
    </script>
    @endif
</body>

</html>