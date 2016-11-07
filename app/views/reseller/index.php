<html>
<layoutsection name="title">All Resellers</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Resellers</div>
        <div class="panel-body">
            <a href="?p=reseller&a=add" class="btn btn-warning pull-right">Add New Reseller</a> <br /><br />

            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Full Name</th> <th>Username</th> <th>Email</th> <th>Created At</th> <th>Active</th> <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model['resellers'] as $reseller): ?>
                    <tr>
                        <td><?php echo $reseller->full_name; ?></td>
                        <td><?php echo $reseller->username; ?></td>
                        <td><?php echo $reseller->email; ?></td>
                        <td><?php echo $reseller->created_at; ?></td>
                        <td class="text-center">
                            <span class="glyphicon glyphicon-<?php echo $reseller->is_active? 'check' : 'unchecked'; ?>"></span>
                        </td>
                        <td class="text-center">
                            <a href="?p=reseller&a=edit&id=<?php echo $reseller->id; ?>" title="Edit">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>

                            <a class="text-danger" href="?p=reseller&a=delete&id=<?php echo $reseller->id; ?>"
                               title="Delete" onclick="return confirm('Are you sure you want to delete?')">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
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