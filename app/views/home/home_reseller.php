<html>
<layoutsection name="title">Home</layoutsection>
<layoutsection name="body">
    <div class="row">
        <ul class="nav nav-pills">
            <?php foreach ($model['services'] as $service): ?>
            <li class="submenu" role="presentation" data-service-id="<?php echo $service['id']; ?>"><a href="#"><?php echo $service['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <br />

    <div class="row">
        <div class="col-sm-4">
            <div class="row">
                <h3>Your Balance: <span class="label label-success"><?php echo number_format($model['balance'], 2, '.', ','); ?></span> BDT</h3>
                <br />
            </div>

            <form action="?p=home&a=transaction_reseller" method="post">
                <input type="hidden" name="service_id" id="subaction" />
                <input type="hidden" name="balance" id="balance" value="<?php echo number_format($model['balance'], 2, '.', ','); ?>" />

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="to">Number</label>
                        <input name="to" id="to" type="text" class="form-control" required="required" placeholder="Recipient Number"
                               value="<?php echo isset($model['to'])? $model['to'] : ''; ?>" />
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
                        <input name="submit" class="btn btn-lg btn-primary pull-right" type="submit" value="Send" style="margin-top: 15px;" />
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-8">
            <div class="panel panel-info">
                <div class="panel-heading">History</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Number</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($model['transactions'] as $transaction): ?>
                                <tr>
                                    <td><?php echo $transaction->to; ?></td>
                                    <td><?php echo $transaction->service; ?></td>
                                    <td align="right"><?php echo number_format($transaction->amount, 2, '.', ','); ?></td>
                                    <td><?php echo $transaction->created_at; ?></td>
                                    <td><?php echo ucfirst($transaction->status); ?></td>
                                    <td class="text-center">
                                        <?php if($transaction->status == 'pending'): ?>
                                        <form action="?p=home&a=abort_transaction" method="post">
                                            <input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
                                            <button type="submit" name="submit" value="submit" class="btn btn-xs btn-danger"
                                                onclick="return confirm('Are you sure you want to stop this transaction?');">
                                                Abort
                                            </button>
                                        </form>
                                        <?php elseif ($transaction->status == 'sent'): ?>
                                            <span class="glyphicon glyphicon-ok-sign text-success"></span>
                                        <?php elseif ($transaction->status == 'aborted'): ?>
                                            <span class="glyphicon glyphicon-exclamation-sign text-warning"></span>
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
        </div>
    </div>
</layoutsection>

<layoutsection name="script">
    <script type="text/javascript">
        $(document).ready(function () {
            $('.submenu').first().addClass('active');
            $('input[name="service_id"]').val($('.submenu').first().data('service-id'));

            $('.submenu').click(function () {
                $('input[name="service_id"]').val($(this).data('service-id'));
                $.each($('.submenu'), function (i, e) {
                    $(e).removeClass('active');
                });
                $(this).addClass('active');
            });
        });
    </script>
</layoutsection>
</html>