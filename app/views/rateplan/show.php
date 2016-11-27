<html>
<layoutsection name="title">Rate Plan Details</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Rate Plan Details</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Service</th>
                        <th>Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model['plan'] as $service): ?>
                        <tr>
                            <td><?php echo $service['service_name']; ?></td>
                            <td><?php echo number_format($service['rate'], 2, '.', ','); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</layoutsection>
</html>