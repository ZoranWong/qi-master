<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>会员中心-我的账户</title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
    <script type="text/javascript" src="/web/js/layuicom.js"></script>
</head>

<body>
<!--header-->
@include('web.header')

<!--header end-->
<!--content-->
<div class="distance">
    <div class="max-width clearfix">
        <div class="crumbs">
            <ul class="clearfix">
                <li>您的位置：</li>
                <li>
                    <a href="index.html">首页</a>
                </li>
                <li>
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>
                <li>我的消息</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>我的消息</h2>
            <div class="clearfix msg-select-all">
                <div class="fl">
                    <label class="checkbox-inline">
                        <input class="checked-all" type="checkbox">
                    </label>
                </div>
                <div class="fl msg-hasread">标记为已读</div>
                <div class="fl msg-del">删除所选</div>
            </div>
            <div class="message-list">
                <div class="list">
                    <div class="clearfix">
								<span>
									<label class="checkbox-inline">
										<input class="input-list" type="checkbox">
									</label>
								</span>
                        <span class="messages-tit">退款申请通过提醒</span>
                        <span class="fr msg-time">2019年03月22日 10:20:31</span>
                    </div>
                    <div class="msg-content">
                        <span>亲爱的绿色森林，您好！</span>
                        <span>您于2019年03月22日 10:20:31提交的退款申请（订单：<a href="">P10650896154</a>）,已被服务商审核通过同意退款。请耐心等待网站处理。
									<p>退款形式：全额退款</p>
									<p>退款金额：100</p>
								</span>
                        <span>有任何问题请联系网站客服人员。</span>
                    </div>
                </div>
                <div class="list">
                    <div class="clearfix">
								<span>
									<label class="checkbox-inline">
										<input class="input-list" type="checkbox">
									</label>
								</span>
                        <span class="messages-tit">退款申请通过提醒</span>
                        <span class="fr msg-time">2019年03月22日 10:20:31</span>
                    </div>
                    <div class="msg-content">
                        <span>亲爱的绿色森林，您好！</span>
                        <span>您于2019年03月22日 10:20:31提交的退款申请（订单：<a href="">P10650896154</a>）,已被服务商审核通过同意退款。请耐心等待网站处理。
									<p>退款形式：全额退款</p>
									<p>退款金额：100</p>
								</span>
                        <span>有任何问题请联系网站客服人员。</span>
                    </div>
                </div>
            </div>
            <div id="pagination"></div>

        </div>

    </div>

</div>

<!--content--end-->

</body>
<script>
    $(".messages-tit").click(function () {
        $(this).parent().addClass('read')
        $(this).parent().next().toggle()
    })
    $(".checked-all").click(function () {
        if (this.checked) {
            $(".input-list").prop("checked", true);
        } else {
            $(".input-list").prop("checked", false);
        }
    })
</script>

</html>
