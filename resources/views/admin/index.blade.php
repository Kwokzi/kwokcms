@extends('base')
{{--
* @[KwokCMS] Ver 1.0 (C) 2022: Mr.Kwok
* @FilePath: /resources/views/admin/index.blade.php
* @Created Time: 2025-01-16 11:32:36
* @Last Edit Time: 2025-03-19 17:24:08
* @Description: 后台首页模板
--}}
@push('head_mor')
<link href="{{ asset('fontawesome/css/brands.min.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('blocks.content-header',['title' => '我的工作台','note'=>'通过数据统计，了解当前工作进度与安排！','fa'=>'<i class="fas fa-tachometer-alt"></i>'])
<section class=" content px-3">
    <div class="container-fluid">
        <p class="alert alert-info">{{$user->name}}，欢迎您第{{$user->login_count}}次登陆系统，登陆时间：{{$user->login_at}}，现在请开始您的工作！</p>
        <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <h3><i class="fas fa-users"></i></h3>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h5 class="mb-0">客户数</h5>
                                <p class="mb-0 opacity-75">当前您正在维护跟进的客户数量。</p>
                            </div>
                            <button class="btn btn-info rounded-pill px-3" type="button">{{$user->customers_count}}</button>
                        </div>
                    </a>
                    <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <h3><i class="fas fa-stream"></i></h3>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h5 class="mb-0">联系人</h5>
                                <p class="mb-0 opacity-75">与客户关联的联系人总数。</p>
                            </div>
                            <button class="btn btn-success rounded-pill px-3" type="button">{{$user->contacts_count}}</button>
                        </div>
                    </a>
                    <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <h3><i class="fas fa-spinner"></i></h3>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h5 class="mb-0">跟进数</h5>
                                <p class="mb-0 opacity-75">处于更新状态的客户数据。</p>
                            </div>
                            <button class="btn btn-dark rounded-pill px-3" type="button">{{$user->follows_count}}</button>
                        </div>
                    </a>
                    <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <h3><i class="fas fa-tty"></i></h3>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h5 class="mb-0">预约数</h5>
                                <p class="mb-0 opacity-75">需要立即处理的预约信息数。</p>
                            </div>
                            <button class="btn btn-warning rounded-pill px-3" type="button">{{$user->appointments_count}}</button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4" style="min-height: 330px">
                <canvas id="Chart-{{$user->id}}"></canvas>
            </div>
            <div class="col-4">
                <!-- Bootstrap 选项卡 -->
                <ul class="nav nav-tabs" id="todoTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="todo-tab" data-bs-toggle="tab" data-bs-target="#todo-list" type="button" role="tab">待办事项</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-list" type="button" role="tab">已办事项</button>
                    </li>
                </ul>

                <!-- 选项卡内容 -->
                <div class="tab-content border border-top-0 rounded-bottom-3 shadow">
                    <!-- 待办事项 -->
                    <div class="tab-pane fade show active" id="todo-list" role="tabpanel">
                        <ul class="list-group p-1 overflow-y-auto" style="height: 170px">
                            @if($todolists->isNotEmpty())
                            @foreach($todolists as $todolist)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>
                                    {{$todolist->subject}}
                                    <small class="badge bg-secondary">{{$todolist->time}}</small>
                                </span>
                                <input type="checkbox" class="form-check-input mark-complete" name="id" title="点击完成此项" value="{{$todolist->id}}">
                            </li>
                            @endforeach
                            @else
                            <p class="text-center text-body-secondary pt-3">暂无待办事项</p>
                            @endif
                        </ul>
                    </div>
                    <!-- 已办事项 -->
                    <div class="tab-pane fade" id="completed-list" role="tabpanel">
                        <ul class="list-group p-1 overflow-y-auto" style="height: 170px">
                            @if($todolists_completed->isNotEmpty())
                            @foreach($todolists_completed as $todolist)
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <span>
                                    <del class="text-decoration-line-through text-body-secondary">{{$todolist->subject}}</del>
                                    <small class="badge bg-success ms-2">{{$todolist->time}}</small>
                                    <button type="submit" onclick="deleteTodo({{$todolist->id}},event)" class="btn btn-sm"><i class="fa-solid fa-trash-can text-danger"></i></button>
                                </span>
                                <span class="text-success">✔ 已完成</span>
                            </li>
                            @endforeach
                            @else
                            <p class="text-center text-body-secondary pt-3">暂无已办事项</p>
                            @endif
                        </ul>
                    </div>
                    <!-- 添加新事项 -->
                    <form action="{{route('todolist.store')}}" class="p-3" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="subject" class="form-control" placeholder="请输入待办事项">
                            <button type="submit" class="btn btn-primary">新增</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($user->isAdmin())
    <div class="my-3 p-3 bg-light rounded shadow-sm">
        <h5 class="border-bottom pb-2">系统运行信息<sup>(仅管理员可见)</sup>
            @if($showRenewal)<span class="text-danger font-weight-bolder float-end h6">为保证数据安全，应于{{$formattedRenewalDate}}前续费。</span>@endif
        </h5>
        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-brands fa-ubuntu"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">操作系统</strong>
                    <span>当前程序运行的环境版本信息</span>
                </div>
                <span class="d-block">{{PHP_OS}} / PHP v{{ PHP_VERSION }} / X-Fitted OA v{{ Illuminate\Foundation\Application::VERSION }}</span>
            </div>
        </div>

        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-brands fa-app-store-ios"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">程序信息</strong>
                    <span>程序运行信息。</span>
                </div>
                <span class="d-block">
                    本系统已<strong class="text-success" data-bs-toggle="tooltip" title="系统创建于: {{$app_make_date}}，下次续费时间：{{$formattedRenewalDate}}">运行了{{$runTime}}。</strong>
                </span>
            </div>
        </div>

        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-solid fa-cloud-arrow-up"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">上传许可</strong>
                    <span>当前程序允许上传的最大文件尺寸。</span>
                </div>
                <span class="d-block"><strong>{{$fileupload}}</strong>（系统设置：{{$limit_upload_size}}）</span>
            </div>
        </div>

        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-solid fa-bezier-curve"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">程序路径</strong>
                    <span>程序核心文件所在位置。</span>
                </div>
                <span class="d-block">{{base_path()}}</span>
            </div>
        </div>

        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-solid fa-hard-drive"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">剩余空间</strong>
                    <span>当前服务器剩余可用空间量。</span>
                </div>
                <span class="d-block"><strong data-toggle="tooltip" title="显示的是网站所在的目录的可用空间(可能会被系统限制)！">{{$df}}</strong></span>
            </div>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-solid fa-database"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">数据库版本</strong>
                    <span>当前数据存储软件信息。</span>
                </div>
                <span class="d-block">{{$sql_version}}</span>
            </div>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-solid fa-table-cells-column-lock"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">数据信息</strong>
                    <span>系统数据统计信息。</span>
                </div>
                <span class="d-block"><strong>{{$dbnum}} </strong>张表，{{$dbsize}}</span>
            </div>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <h3 class="bd-placeholder-img flex-shrink-0 me-2 rounded"><i class="fa-solid fa-paperclip"></i></h3>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">附件大小</strong>
                    <span>统计上传文件所占的磁盘空间。</span>
                </div>
                <span class="d-block">{!!$attachsize!!}</span>
            </div>
        </div>
    </div>
    @if($online->isNotEmpty())
    <h5>当前在线的用户</h5>
    <table class="table table-success align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">用户</th>
                <th scope="col">停留位置</th>
                <th scope="col"><i class="fa-solid fa-clock"></i> 登陆时间</th>
                <th scope="col"><i class="fa-solid fa-clock-rotate-left"></i> 活动时间</th>
                <th scope="col" class="text-end">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($online as $staff)
            <tr>
                <th scope="row">{{$staff->user_id}}</th>
                <td>{{$staff->username}} <a href="https://ip138.com/iplookup.php?ip={{$staff->ip}}" data-bs-toggle="tooltip" title="点击显示IP归属地" class="small text-decoration-none" target="_blank">({{$staff->ip}})</a> </td>
                <td> {{$staff->route}}</td>
                <td title="登陆时间"> {{$staff->created_at}} </td>
                <td title="最近活动时间">{{$staff->updated_at}} </td>
                <td class="text-end">
                    <a href="/?kill={{$staff->token}}" class="btn btn-danger">强制下线 <i class="fas fa-sign-out-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @endif
    </div>
</section>
@endsection
@push('foot_mor')
@if(count($user->notifications)>0)
<div class="modal fade" id="autoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">您需要处理以下事件</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($user->notifications as $notification)
                @php
                // 根据通知等级设置颜色和文本
                $gradeInfo = [
                0 => ['color' => 'success', 'text' => '低'], // 绿色
                1 => ['color' => 'warning', 'text' => '中'], // 橙色
                2 => ['color' => 'danger', 'text' => '高'], // 红色
                ];
                $grade = $gradeInfo[$notification->grades] ?? ['color' => '#007bff', 'text' => '?']; // 默认值
                @endphp
                <div class="alert alert-{{$grade['color']}}">
                    <a href="{{ empty($notification->redirect_url) ? $notification->url : $notification->redirect_url }}" class="text-body-secondary text-decoration-none"> {{Str::limit($notification->message,80)}}</a>
                    <sup class="badge badge-pill text-bg-secondary">紧急度：{{$grade['text']}}</sup>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
<script src="{{asset('chart/chart.umd.js')}}"></script>
<script>
    @php
    $colors = array_values($colors);   
    $color = $colors[array_rand($colors)]['color']; // 获取颜色值
    $statistics = json_encode($user->statistics); // 确保数据以 JSON 形式传递到 JavaScript
    @endphp
    var ctx = document.getElementById('Chart-{{$user->id}}');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['24小时跟进', '48小时跟进', '本周跟进', '本月跟进'],
            datasets: [{
                label: '{{$user->name}}跟进信息',
                data: {{$statistics}},
                borderColor: '{{$color}}',
                borderWidth: 2,
                pointBackgroundColor: '{{$color}}',
                backgroundColor: 'transparent'
            }]
        },options:{
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    boxPadding: 3
                }
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 获取所有按钮并绑定事件
        document.querySelectorAll('.mark-complete').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.value;
                let li = this.parentElement;
                let url = "{{ route('todolist.update', ['todolist' => ':id']) }}".replace(':id', id);                
                // 发送请求
                sendRequest(url, 'PUT', { csrf: "{{ csrf_token() }}" }, 
                    function (response) {
                        if (response.status === 'success') {
                            toast('success',response.msg,'mt-5 pt-5 top-0 end-0');                          
                            li.classList.add('opacity-50');  //删除加上动画
                            setTimeout(() => {li.remove()}, 1000);
                        } else {
                            toast('warning',response.msg,'mt-5 pt-5 top-0 end-0');
                        }
                    }, 
                    function (error) {
                        toast('danger',error,'mt-5 pt-5 top-0 end-0');
                        console.error("请求错误:", error);
                    }
                );
            });
        });
    });
</script>
<script>
    function deleteTodo(id, event){
        if (!confirm('确定要删除此事项吗？')) {
            return;
        }
        let url = "{{ route('todolist.destroy', ['todolist' => ':id']) }}".replace(':id', id);
        let button = event.target.closest("button"); // 获取点击的按钮
        let li = button.closest("li"); // 获取包含该按钮的 <li>
        sendRequest(url, 'DELETE', { csrf: "{{ csrf_token() }}" }, 
            function (response) {
                if(response.status === 'success'){
                    toast('success', response.msg, 'mt-5 pt-5 top-0 end-0');                    
                    li.classList.add('opacity-50');  // 添加淡出动画
                    setTimeout(() => { li.remove(); }, 1000);
                } else {
                    toast('danger', response.msg, 'mt-5 pt-5 top-0 end-0');
                }
            },
            function (error) {
                toast('danger', error, 'mt-5 pt-5 top-0 end-0');
                console.error("请求错误:", error);
            }
        );
    }
</script>
@endpush