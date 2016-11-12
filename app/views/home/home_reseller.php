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
        <div class="col-sm-6">
            <form action="">
                <input type="hidden" name="service_id" id="subaction" />
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>Number</label>
                        <input class="form-control" type="text" placeholder="Send to"/>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Amount</label>
                        <input class="form-control" type="number" placeholder="Amount (In BDT)"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>PIN</label>
                        <input class="form-control" type="text" placeholder="Your PIN"/>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>&nbsp;</label>
                        <input class="form-control btn btn-primary" type="submit" value="Send" />
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label>Label1</label>
                    <input class="form-control" type="text"/>
                </div>
                <div class="col-sm-6 form-group">
                    <label>Label2</label>
                    <input class="form-control" type="text"/>
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