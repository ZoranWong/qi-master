
<!--header-->
<header>
    <div id="header">
        <div class="header-a">
            <div class="nav-a" style="padding-right: 0px; border: 0px;">
                <a href="">您好，</a>
            </div>
            <div class="nav-a" style="padding-right: 0px; border: 0px;">
                <a href="" class="" style="padding-right: 0px;">我的订单</a>
            </div>
            <div class="nav-a">
                <a href="javascript:void(0)">退出</a>
            </div>
            <div class="nav-a">
                <a href="/">官网首页</a>
            </div>
            <div class="nav-a">
                <a href="">优惠活动</a>
            </div>
            <div class="nav-a">
                <a href="">商户APP</a>
            </div>
            <div class="nav-a">
                <a href="">师傅入驻</a>
            </div>
            <div class="nav-b">
                <a href="">家庭用户</a>
            </div>
        </div>
    </div>
    <div id="nav">
        <div class="navlist am-container"><a href="/"><img src="/web/image/logo.png" class="logo"></a>
            <ul id="tabs_nav" class="boxlie">
                <li class="{{$selected === '' ? 'selected' : ''}}">
                    <a href="/">我的首页</a>
                </li>
                <li class="{{$selected === 'orders' ? 'selected' : ''}}">
                    <a href="/orders">订单管理</a>
                </li>
                <li class="{{$selected === 'refund' ? 'selected' : ''}}">
                    <a href="/refund">维权中心</a>
                </li>
                <li class="{{$selected === 'wallet' ? 'selected' : ''}}">
                    <a href="/wallet">我的钱包</a>
                </li>
                <li class="{{$selected === 'profile' ? 'selected' : ''}}">
                    <a href="/profile">账号管理</a>
                </li>
                <li class="{{$selected === 'message' ? 'selected' : ''}}">
                    <a href="/message">服务中心</a>
                </li>
            </ul>
            <div class="make-order">
                <a href="/publish">立即找师傅</a>
            </div>
        </div>
    </div>
</header>
<!--header end-->