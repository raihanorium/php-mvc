<html>
<layoutsection name="title">Rate Plan</layoutsection>
<layoutsection name="body">
    <div class="col-sm-4">

    </div>

    <div class="col-sm-8 table-responsive">
        <div class="panel panel-info">
            <div class="panel-heading">Plans</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model['rate_plans'] as $plan): ?>
                            <tr>
                                <td>
                                    <a href="?p=rateplan&a=show&id=<?php echo $plan->id; ?>"><?php echo $plan->name; ?></a>
                                </td>
                                <td><?php echo $plan->description; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</layoutsection>
</html>