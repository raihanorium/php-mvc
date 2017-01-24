<html>
<layoutsection name="title">All Resellers</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Transactions With Admin</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Transaction No.</th> <th>Date</th> <th>From</th> <th>To</th> <th>Amount</th> <th>Description</th>
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
</layoutsection>
</html>