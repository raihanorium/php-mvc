<html>
<layoutsection name="title">Add Reseller</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Add Reseller</div>
        <div class="panel-body">
            <form action="?p=reseller&a=save" method="post">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name"
                            value="<?php echo isset($model['full_name']) ? $model['full_name'] : '' ?>" required="required" />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                               value="<?php echo isset($model['username']) ? $model['username'] : '' ?>" required="required" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                               value="<?php echo isset($model['email']) ? $model['email'] : '' ?>" required="required" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required" />
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required="required">
                            <option value="">-- Select Role --</option>
                            <option value="1" <?php echo isset($model['role']) ? ($model['role'] == 1)? 'selected="selected"' : '' : '' ?>>Admin</option>
                            <option value="2" <?php echo isset($model['role']) ? ($model['role'] == 2)? 'selected="selected"' : '' : '' ?>>Reseller</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ratePlan">Rate Plan</label>
                        <select name="rate_plan_id" id="ratePlan" class="form-control" required="required">
                            <?php foreach ($model['rate_plans'] as $plan) : ?>
                                <option value="<?php echo $plan->id; ?>" <?php echo isset($model['rate_plan_id']) ? ($model['rate_plan_id'] == $plan->id)? 'selected="selected"' : '' : '' ?>><?php echo $plan->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="isActive" name="is_active" <?php echo isset($model['is_active']) ? 'checked="checked"' : '' ?> /> Active
                        </label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <fieldset>
                        <legend>Services</legend>

                        <?php foreach ($model['services'] as $service) : ?>
                        <div class="checkbox">
                            <label><input type="checkbox" name="services[]" required="required" value="<?php echo $service['id']; ?>" /><?php echo $service['name']; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </fieldset>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-12 text-right">
                    <a href="?p=reseller" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</layoutsection>
</html>