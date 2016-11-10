<html>
<layoutsection name="title">Edit Reseller</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Edit Reseller</div>
        <div class="panel-body">
            <form action="?p=reseller&a=update" method="post">
                <input type="hidden" name="id" value="<?php echo $model['reseller']['id'];?>" />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name"
                            value="<?php echo isset($model['reseller']['full_name']) ? $model['reseller']['full_name'] : '' ?>" />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                               value="<?php echo isset($model['reseller']['username']) ? $model['reseller']['username'] : '' ?>" disabled="disabled" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                               value="<?php echo isset($model['reseller']['email']) ? $model['reseller']['email'] : '' ?>" disabled="disabled" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" disabled="disabled">
                            <option value="">-- Select Role --</option>
                            <option value="1" <?php echo isset($model['reseller']['role']) ? ($model['reseller']['role'] == 1)? 'selected="selected"' : '' : '' ?>>Admin</option>
                            <option value="2" <?php echo isset($model['reseller']['role']) ? ($model['reseller']['role'] == 2)? 'selected="selected"' : '' : '' ?>>Reseller</option>
                        </select>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="isActive" name="is_active"
                                <?php echo ($model['reseller']['is_active'])? 'checked="checked"' : ''; ?>/> Active
                        </label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <fieldset>
                        <legend>Services</legend>

                        <?php foreach ($model['services'] as $service) : ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="<?php echo $service['id']; ?>"
                                        <?php echo in_array($service['id'], $model['reseller']['services'])? 'checked="checked"' : '' ?> />
                                    <?php echo $service['name']; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-12 text-right">
                    <a href="?p=reseller" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</layoutsection>
</html>