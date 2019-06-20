<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/plugin/swiper/css/swiper.min.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/plugin/previewImage/css/previewImage.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
    <script type="text/javascript" src="/web/plugin/swiper/js/swiper.min.js"></script>
    <script type="text/javascript" src="/web/plugin/previewImage/js/previewImage.js"></script>
    <script type="text/javascript" src="/web/js/complain.js"></script>
    <
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
                <li>
                    <a href="complaint.html">投诉管理</a> <span class="separator">&gt;</span>
                </li>
                <li>投诉详情</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>投诉详情</h2>
            <div class="refund-state">
                处理状态：<span class="state-text" style="color: #fb6e06;">处理完成</span>
            </div>
            <!--处理结果-->
            <div class="worker-hander">
                <h2>处理结果</h2>
                <div class="describe">
                    <p>
                        <span>处理结果：</span>
                        <span style="color: #42bc65;">投诉/举报成立 </span>
                    </p>
                    <p>
                        <span>违规等级：</span>
                        <span>师傅C级违规</span>
                    </p>
                    <p>
                        <span>投诉类别：</span>
                        <span>师傅接单后拒绝服务/放弃订单/爽约不上门</span>
                    </p>
                    <p class="clearfix">
                        <span class="title">处理说明：</span>
                        <span class="des-content">您好，很抱歉给您带来了不好的服务体验，此订单核实师傅不能上门服务并未及时联系商家说明，导致耽误了客户的安装时间。已经提交相关部门进行处罚，此订单建议您申请退款，为了避免耽误安装时效建议您可以重新下单，为了表示歉意补偿您10元现金券，如您还有其他疑问可以随时反馈，感谢您的支持与谅解，谢谢~</span>
                    </p>
                    <p class="clearfix">
                        <span class="title">客户证词：</span>
                        <span class="des-content">商家反馈师傅预约好客户，客户请假在家等，后来又联系我们说去不了，还向客户透露服务费，说现场多出一个柜子，要加钱我们说核实一下会加钱的，如果不愿意安装多出的柜子，就按原单子做就可以了。</span>
                    </p>
                    <p class="clearfix">
                        <span class="title">师傅证词：</span>
                        <span class="des-content">联系师傅，师傅反馈订单与实际不符，要求增加费用，商家让师傅先去安装，师傅不愿意</span>
                    </p>
                    <p>
                        <span>审核时间：</span>
                        <span>2019-01-22 10:27</span>
                    </p>
                    <p>
                        <span>图片证据：</span>
                        <span>0张图片</span>
                    </p>
                </div>
            </div>
            <!--处理结果end-->

            <!--举报-->
            <div class="worker-hander">
                <h2>投诉/举报信息</h2>
                <div class="describe">
                    <p>
                        <span>投诉对象：</span>
                        <span>卢晨(18951805859)</span>
                    </p>

                    <p>
                        <span>所属订单：</span>
                        <span style="color:#45a1f6">S2190118215615779</span>
                    </p>
                    <p>
                        <span>投诉类别：</span>
                        <span>师傅接单后拒绝服务/放弃订单/爽约不上门</span>
                    </p>
                    <p class="clearfix">
                        <span class="title">备注信息：</span>
                        <span class="des-content">师傅预约好客户，客户请假在家等，后来又联系我们说去不了，还向客户透露服务费，说现场多出一个柜子，要加钱我们说核实一下会加钱的，如果不愿意安装多出的柜子，就按原单子做就可以了。</span>
                    </p>
                    <p>
                        <span>图片证据：</span>
                        <span>1张图片</span>
                    </p>
                    <div class="img-con">
                        <ul>
                            <li><img data-preview-group="1" src="/web/image/comp.jpg" alt=""></li>
                        </ul>
                    </div>
                    <p>
                        <span>投诉时间：</span>
                        <span>2019-01-22 09:42</span>
                    </p>
                </div>
            </div>
            <!--举报end-->
        </div>

    </div>

</div>

<!--content--end-->
<div class="cover"></div>
</body>


</html>
