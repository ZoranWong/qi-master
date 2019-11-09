<div class="left-nav">
    <div class="my-center">
        <a href="/">
            <i></i>
            <span>个人中心</span>
        </a>
    </div>
    <div>
        <ul class="second-menu">
            <li class="active">
                <div><i class="icon-menu-1"></i>订单中心</div>
                <ul>
                    <li class="{{$currentMenu === 'orders' ? 'router-link-active' : ''}}">
                        <a href="/orders">全部订单</a>
                    </li>
                    <li class="{{$currentMenu === 'comments' ? 'router-link-active' : ''}}">
                        <a href="/comments">我的评价</a>
                    </li>
                    <li class="{{$currentMenu === 'gallery' ? 'router-link-active' : ''}}">
                        <a href="/gallery">商品管理</a>
                    </li>
                    <li class="{{$currentMenu === 'favorite' ? 'router-link-active' : ''}}">
                        <a href="/favorite">收藏的服务商</a>
                    </li>
                </ul>
            </li>
            <li>
                <div><i class="icon-menu-2"></i>维权中心</div>
                <ul>
                    <li class="{{$currentMenu === 'refund' ? 'router-link-active' : ''}}">
                        <a href="/refund">退款管理</a>
                    </li>
                    <li class="{{$currentMenu === 'complaint' ? 'router-link-active' : ''}}">
                        <a href="/complaint">投诉管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <div><i class="icon-menu-3"></i>我的钱包</div>
                <ul>
                    <li class="{{$currentMenu === 'wallet' ? 'router-link-active' : ''}}">
                        <a href="/wallet">钱包余额</a>
                    </li>
                </ul>
            </li>
            <li>
                <div><i class="icon-menu-4"></i>个人中心</div>
                <ul>
                    <li class="{{$currentMenu === 'profile' ? 'router-link-active' : ''}}">
                        <a href="/profile">基本资料</a>
                    </li>
                    {{--<li class="{{$currentMenu === 'security' ? 'router-link-active' : ''}}">--}}
                        {{--<a href="/security">安全设置</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
            <li>
                <div><i class="icon-menu-5"></i>服务中心</div>
                <ul>
                    <li class="{{$currentMenu === 'message' ? 'router-link-active' : ''}}">
                        <a href="/message">我的消息</a>
                    </li>

                    {{--<li class="{{$currentMenu === 'resource' ? 'router-link-active' : ''}}">--}}
                        {{--<a href="/">资质管理</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
        </ul>
    </div>
</div>
