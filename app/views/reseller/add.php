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

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="isActive" name="is_active" <?php echo isset($model['is_active']) ? 'checked="checked"' : '' ?> /> Active
                        </label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <fieldset>
                        <legend>Services</legend>
                        <div class="checkbox">
                            <label><input type="checkbox" name="services[]" value="flexiload" />FlexiLoad</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="services[]" value="bkash" />bKash</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="services[]" value="rocket" />Rocket</label>
                        </div>
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