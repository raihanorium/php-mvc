<html>
<layoutsection name="title">All Resellers</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Resellers</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th> <th>Full Name</th> <th>Username</th> <th>Email</th> <th>Active</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model as $reseller): ?>
                    <tr>
                        <td><?php echo $reseller['id']; ?></td>
                        <td><?php echo $reseller['full_name']; ?></td>
                        <td><?php echo $reseller['username']; ?></td>
                        <td><?php echo $reseller['email']; ?></td>
                        <td><?php echo $reseller['is_active']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</layoutsection>
</html>