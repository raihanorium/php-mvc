<html>
<layoutsection name="title">Rate Plan</layoutsection>
<layoutsection name="body">
    <form action="?p=rateplan&a=save_as" method="post">
        <div class="col-sm-4">
            <?php foreach ($model['plan'] as $plan): ?>
                <div class="form-group">
                    <label for="service_<?php echo $plan['service_id']; ?>"><?php echo $plan['service_name']; ?></label>
                    <input type="text" class="form-control" id="service_<?php echo $plan['service_id']; ?>"
                           name="service[<?php echo $plan['service_id']; ?>]"
                           value="<?php echo $plan['rate']; ?>" required="required"/>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6 form-group">
                    <input name="plan_name" id="plan_name" class="form-control" type="text" required="required" placeholder="Enter new plan name" value=""/>
                </div>
                <div class="col-sm-6 form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Save As" />
                </div>
            </div>


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
    </form>
</layoutsection>
</html>