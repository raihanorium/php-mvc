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
                <h3>Your Balance: <span class="label label-success">2350.00</span> BDT</h3>
                <br />
            </div>

            <form action="">
                <input type="hidden" name="service_id" id="subaction" />
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>Number</label>
                        <input class="form-control" type="text" placeholder="Send to" required="required"/>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Amount</label>
                        <input class="form-control" type="number" required="required" placeholder="Amount (In BDT)"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>PIN</label>
                        <input class="form-control" type="number" required="required" placeholder="Your PIN"/>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>&nbsp;</label>
                        <input class="btn btn-lg btn-primary pull-right" type="submit" value="Send" style="margin-top: 15px;" />
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
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
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