<html>
<layoutsection name="title">SMS Transactions</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Reseller Transactions</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Reseller</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model['transactions'] as $transaction): ?>
                        <tr>
                            <td><?php echo $transaction['to']; ?></td>
                            <td><?php echo $transaction['service']; ?></td>
                            <td align="right"><?php echo number_format($transaction['amount'], 2, '.', ','); ?></td>
                            <td><?php echo $transaction['reseller']; ?></td>
                            <td><?php echo $transaction['created_at']; ?></td>
                            <td class="text-center">
                                <?php if($transaction['status']== 'pending'): ?>
                                    <form action="?p=home&a=mark_sent" method="post" class="form-inline">
                                        <div class="input-group">
                                            <input type="hidden" name="id" value="<?php echo $transaction['id']; ?>" />
                                            <input type="text" id="txnId" name="txnId"  class="form-control input-xs" placeholder="TXN Id" required="required" />
                                            <span class="input-group-btn">
                                                <button type="submit" name="submit" value="submit" class="btn btn-xs btn-success"
                                                    onclick="return confirm('Are you sure you want to mark this transaction as sent?');">
                                                    Mark As Sent
                                                </button>
                                              </span>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($transaction['status']== 'pending'): ?>
                                    <form action="?p=home&a=abort_transaction" method="post">
                                        <input type="hidden" name="id" value="<?php echo $transaction['id']; ?>" />
                                        <button type="submit" name="submit" value="submit" class="btn btn-xs btn-danger"
                                                onclick="return confirm('Are you sure you want to stop this transaction?');">
                                            Abort
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
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