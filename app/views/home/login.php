<?php require_once '../app/views/templates/headerPublic.php' ?>

<div class="row">
    <div class="col">
        <h2>Login Form</h2>
        <form class="form-horizontal" 
              action="<?= Util::userLogin(); ?>" 
              method="post">
            <fieldset>
                <div class="row">
                    <label for="username" 
                           class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" 
                               class="form-control" 
                               name="username" 
                               placeholder="Username"/></div></div>

                <div class="row">
                    <label for="password" 
                           class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" 
                               class="form-control"
                               name="password"
                               placeholder="Password"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php' ?>