<html>
<layoutsection name="title">Add Reseller</layoutsection>
<layoutsection name="body">
    <div class="panel panel-info">
        <div class="panel-heading">Add Reseller</div>
        <div class="panel-body">
            <form action="?p=reseller&a=save" method="post">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" />
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="isActive" name="is_active" /> Active
                    </label>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Add</button>
            </form>
        </div>
    </div>
</layoutsection>
</html>