<html>
<layoutsection name="title">Edit Reseller</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Edit Reseller</div>
        <div class="panel-body">
            <form action="?p=reseller&a=update" method="post">
                <input type="hidden" name="id" value="<?php echo $model['id'];?>" />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name"
                            value="<?php echo isset($model['full_name']) ? $model['full_name'] : '' ?>" />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                               value="<?php echo isset($model['username']) ? $model['username'] : '' ?>" disabled="disabled" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                               value="<?php echo isset($model['email']) ? $model['email'] : '' ?>" disabled="disabled" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="isActive" name="is_active"
                                <?php echo ($model['is_active'])? 'checked="checked"' : ''; ?>/> Active
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
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</layoutsection>
</html>