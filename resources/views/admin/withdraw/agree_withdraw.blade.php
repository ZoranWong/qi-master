<div class="agree-withdraw-form">
    <form class="agree-form">
        <div class="box-body fields-group">
            <div class="form-group">
                <label for = "transferAmount" class="transfer-amount col-sm-4 control-label">实际转帐金额：</label>
                <div class="col-sm-6">
                    <input type="number" min="0" class="form-control input-sm" name = "transfer_amount" id="transferAmount" placeholder="请输入实际转账金额">
                </div>
            </div>
            <div class="form-group">
                <label for = "comment" class="comment col-sm-4 control-label">备注：</label>
                <div class="col-sm-6">
                    <textarea  class="form-control input-sm" id="comment" name="comment" placeholder="备注"></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="status" value="1">
        <input type="hidden" name="opt_admin_id" value="{{$admin_id}}">
    </form>
</div>
