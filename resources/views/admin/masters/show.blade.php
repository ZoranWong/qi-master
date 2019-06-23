<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">齐师傅-档案室</h3>
        <div class="box-tools">
            <div class="btn-group float-right" style="margin-right: 10px">
                <a href="{{ route('admin.masters.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4" style="font-size: medium; font-weight: bold;">师傅个人信息</td>
                </tr>
                <tr>
                    <td>账号名称：</td>
                    <td>{{$master->name}}</td>
                    <td>手机：</td>
                    <td>{{$master->mobile}}</td>
                </tr>
                <tr>
                    <td>姓名：</td>
                    <td>{{$master->realName}}</td>
                    <td>邮箱：</td>
                    <td>{{$master->email}}</td>
                </tr>
                <tr>
                    <td>接单数量：</td>
                    <td>{{$master->name}}</td>
                    <td>手机：</td>
                    <td>{{$master->mobile}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="4" style="font-size: medium; font-weight: bold;">师傅服务历史</td>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="4" style="font-size: medium; font-weight: bold;">师傅评价</td>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<style>
    .table-bordered{
        margin-bottom: 32px !important;
    }
</style>
