<html>
<layoutsection name="title">All Services</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Services</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th> <th>Description</th> <th>Operator Code</th> <th>Active</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model['services'] as $service): ?>
                    <tr>
                        <td><?php echo $service->name; ?></td>
                        <td><?php echo $service->description; ?></td>
                        <td><?php echo $service->operator_code; ?></td>
                        <td class="text-center">
                            <span class="glyphicon glyphicon-<?php echo $service->is_active? 'check' : 'unchecked'; ?>"></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</layoutsection>
</html>