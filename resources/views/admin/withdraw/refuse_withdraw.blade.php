<div class="refuse-withdraw-form">
    <form class="refuse-form">
        <div class="box-body fields-group">
            <div class="form-group">
                <label for = "comment" class="comment col-sm-4 control-label">拒绝理由：</label>
                <div class="col-sm-6">
                    <textarea  class="form-control input-sm" id="comment" name="comment" placeholder="拒绝理由"></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="status" value="2">
        <input type="hidden" name="opt_admin_id" value="{{$admin_id}}">
        <input class="order-id" type="hidden" name="id" >
    </form>
</div>
