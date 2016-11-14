<html>
<layoutsection name="title">All Transactions</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Transactions</div>
        <div class="panel-body">
            <a href="?p=reseller&a=add" class="btn btn-warning pull-right">Add New Transactions</a> <br /><br />

            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Date</th> <th>From</th> <th>To</th> <th>Amount</th> <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model['transactions'] as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['created_at']; ?></td>
                        <td><?php echo $transaction['from_name']; ?></td>
                        <td><?php echo $transaction['to_name']; ?></td>
                        <td align="right"><?php echo number_format($transaction['amount'], 2, '.', ','); ?></td>
                        <td><?php echo $transaction['description']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</layoutsection>
</html>