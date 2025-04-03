{{--
* @[KwokCMS] Ver 1.0 (C) 2025 By:Mr.Kwok
 * @FilePath: /resources/views/base.blade.php
* @Created Time: 2025-03-06 11:32:36
 * @Last Edit Time: 2025-03-21 14:54:12
* @Description: 前台基础模板(被继承)
--}}
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>{{ $web_title }}</title>
    @isset($web_keywords)
    <meta name="keywords" content="{{ $web_keywords }}">
    @endisset
    @isset($web_description)
    <meta name="description" content="{{ $web_description }}">
    @endisset
    <link rel="canonical" href="{{ $current_url }}">
    <meta http-equiv="Cache-Control" content="no-siteapp,no-transform">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head_code')
</head>

<body>
    @hasSection('header')
    @yield('header')
    @else
    {{-- header 默认顶部 --}}
    <header class="bg-gray-800 text-white p-3">
        <div class="container mx-auto flex flex-wrap items-center justify-between">
            <div class="flex items-center">
                <div class="logo transition-opacity duration-500 ease-in-out opacity-75 hover:opacity-100">
                    <a href="/" class="no-underline flex items-center">
                        <span class="ml-2 text-4xl text-cyan-400">{{ $web_name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 130" width="90" height="48">
                            <g opacity="0.8" transform="skewX(-10) translate(-10, 10) scale(.9)">
                                <path d="m89,61.5l8,-7l-45.5,-46l-45.5,46l8,7l32,-34l0,86l11,0l0,-86l32,34z" fill="#FFA940" />
                                <path d="m186,68.5l8,7l-45.5,46l-45.5,-46l8,-7l32,34l0,-86l11,0l0,86l32,-34z" fill="#28a745" />
                            </g>
                        </svg>
                    </a>
                </div>
                <nav>
                    <ul class="flex ml-3">
                        <li><a href="#" class="px-2 py-1 text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="#" class="px-2 py-1 text-white">Features</a></li>
                        <li><a href="#" class="px-2 py-1 text-white">Pricing</a></li>
                        <li><a href="#" class="px-2 py-1 text-white">FAQs</a></li>
                        <li><a href="#" class="px-2 py-1 text-white">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="flex">
                <form class="mr-3" role="search">
                    <input type="search" class="px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="输入搜索的关键字..." aria-label="Search">
                </form>
                <div>
                    <a href="{{ route('auth.login') }}" class="inline-block px-4 py-2 mr-2 border border-white text-white hover:bg-white hover:text-gray-800 rounded">登录</a>
                    <a href="{{ route('auth.register') }}" class="inline-block px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">注册</a>
                </div>
            </div>
        </div>
    </header>
    @endif
    {{-- content 主体内容 --}}
    <main>
        @yield('content')
    </main>

    @hasSection('footer')
    @yield('footer')
    @else
    {{-- footer 默认脚部 --}}
    <footer class="py-3 mt-4 border-t border-gray-200">
        <div class="container mx-auto flex flex-wrap justify-between items-center">
            <div class="md:w-1/3 flex items-center">
                <a href="/" class="mr-2 text-gray-500 no-underline">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <span class="text-gray-500">&copy; {{ date('Y') }} {{ $web_name }}</span>
            </div>
            <ul class="md:w-1/3 flex justify-end list-none">
                <li class="ml-3">
                    <a class="text-gray-500 hover:text-gray-700" href="#" aria-label="Twitter">
                        Twitter
                    </a>
                </li>
                <li class="ml-3">
                    <a class="text-gray-500 hover:text-gray-700" href="#" aria-label="Instagram">
                        Instagram
                    </a>
                </li>
                <li class="ml-3">
                    <a class="text-gray-500 hover:text-gray-700" href="#" aria-label="Facebook">
                        Facebook
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    @endif
    @stack('foot_code')
</body>

</html>