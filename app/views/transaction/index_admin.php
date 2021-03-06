<html>
<layoutsection name="title">All Transactions</layoutsection>
<layoutsection name="body">
    <div class="col-sm-4">
        <form action="?p=transaction&a=add" method="post">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="reseller">Reseller</label>
                    <select name="to" id="reseller" class="form-control" required="required">
                        <option value="">-Select One-</option>
                        <?php foreach ($model['resellers'] as $reseller): ?>
                        <option
                            value="<?php echo $reseller['id']; ?>"
                            <?php echo (isset($model['to']) && ($model['to'] == $reseller['id']))? 'selected="selected"':'' ; ?>>
                            <?php echo $reseller['full_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="amount">Amount</label>
                    <input name="amount" id="amount" class="form-control" type="number" required="required"
                           placeholder="Amount (In BDT)" value="<?php echo isset($model['amount'])? $model['amount'] : ''; ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="pin">PIN</label>
                    <input name="pin" id="pin" class="form-control" type="password" required="required" placeholder="Your PIN"/>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="description">Description</label>
                    <input name="description" id="description" class="form-control" type="text" placeholder="Put some text"
                        value="<?php echo isset($model['description'])? $model['description'] : ''; ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">

                </div>
                <div class="col-sm-6 form-group">
                    <label>&nbsp;</label>
                    <input name="submit" class="btn btn-lg btn-primary pull-right" type="submit" value="Send" style="margin-top: 15px;" />
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-8 table-responsive">
        <div class="panel panel-info">
            <div class="panel-heading">Transactions</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Transaction No.</th>
                            <th>Date</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model['transactions'] as $transaction): ?>
                            <tr>
                                <td><?php echo $transaction->id; ?></td>
                                <td><?php echo $transaction->created_at; ?></td>
                                <td><?php echo $transaction->from_name; ?></td>
                                <td><?php echo $transaction->to_name; ?></td>
                                <td align="right"><?php echo number_format($transaction->amount, 2, '.', ','); ?></td>
                                <td><?php echo $transaction->description; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <small>Showing last 20 records.</small>
            </div>
        </div>
    </div>
</layoutsection>
</html>