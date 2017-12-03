<?php require_once '../app/views/templates/header_admin.php' ?>

<div class="row">
    <div class="col-sm-4">
        <h2>Creating a User</h2>
        <form id="adduser" 
              class="form-horizontal" 
              action="<?= Util::addUser() ?>" 
              method="post">
            <fieldset>
                <div class="row">
                    <label class="col-sm-4 control-label">User Type</label>

                    <div class="col">
                        <label class="radio-inline">
                            Staff
                            <input id="staff"
                                   type="radio" 
                                   name="role" 
                                   value="staff" 
                                   checked="true"/>
                        </label>
                        <label class="radio-inline">
                            Manager
                            <input id="manager"
                                   type="radio" 
                                   name="role" 
                                   value="manager"/>
                        </label>
                    </div>
                </div>

                <div id="managedByDiv">
                    <div class="row">
                        <label for="managedBy"
                               class="col-sm-4 control-label">Managed By</label>
                        <div class="col-sm-8">
                            <select name="managedBy"
                                    class="form-control">
                                        <?php
                                        foreach ($data as $row) {
                                            if ($row['role'] == 'manager') {
                                                ?>
                                        <option value="<?= $row['username'] ?>"><?= $row['username'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label for="username" 
                           class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text"
                               class="form-control"
                               name="username"
                               placeholder="Username"
                               pattern="[a-zA-Z0-9]+"
                               required/></div></div>

                <div class="row">
                    <label for="password"
                           class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Password"
                               required/></div></div>

                <!-- FIRST NAME -->
                <div class="row">
                    <label for="firstName"
                           class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-8">
                        <input type="text"
                               class="form-control"
                               name="firstName"
                               placeholder="First Name"
                               required/>
                    </div>
                </div>
                
                <!-- Last Name-->
                <div class="row">
                    <label for="lastName"
                           class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text"
                               class="form-control"
                               name="lastName"
                               placeholder="LastName"
                               required/>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="row">
                    <label for="email"
                           class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="Email"
                               required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col">
                        <button type="submit"
                                class="btn btn-primary btn-block">Create User</button></div></div>
            </fieldset>
        </form>
    </div>

    <div class="col-sm-8">
        <h2>User List</h2>
        <form id="manageuser" 
              class="form-horizontal"
              action="<?= Util::deleteUser() ?>" 
              method="post">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                        <th>Manager</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) {
                        if ($row['role'] != 'admin') {
                            ?>
                            <tr>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['managedBy'] ?></td>
                                <td>
                                    <a href="<?= Util::deleteUser() . DS . $row['username']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php' ?>



