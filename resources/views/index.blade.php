@extends('base')
{{--
* @[KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * @FilePath: /resources/views/index.blade.php
* @Created Time: 2025-03-04 23:48:56
 * @Last Edit Time: 2025-03-21 18:43:38
* @Description: 前台首页模板
--}}
@push('head_code')

@endpush

@section('content')
主体内容

<!-- Vue 组件挂载点 -->
<div class="row">
    <div id="counter-app" data-api-url="{{ route('api.count') }}"></div>
</div>
@endsection

@push('foot_code')

@endpush