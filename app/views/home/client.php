<?php require_once '../app/views/templates/header.php' ?>

<div class="row">
    <div class="col-sm-4">
        <h2>Creating a new client</h2>
        <form id="manageclient"
              action="<?= Util::addClient() ?>" 
              method="post">
            <fieldset>
                <div class="row">
                    <label for="name"
                           class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                        <input id="name"
                               type="text" 
                               name="name"
                               placeholder="Enter Cilent Name"
                               class="form-control"
                               required="true"/>
                    </div>
                </div>

                <script>
                    $('#name').blur(function () {
                        $('#clientlist tr').each(function () {
                            var clientName = '' + $(this).find("td").eq(1).html();
                            var value = '' + $('#name').val();
                            if (value.toLowerCase() == clientName.toLowerCase()) {
                                alert("Client name exists!")
                                $('#name').val('');
                            }
                        });
                    });
                </script>

                <div class="row">
                    <label for="dob"
                           class="col-sm-3 control-label">DOB</label>
                    <div class="col-sm-9">
                        <input type="date"
                               name="dob"
                               placeholder="Select client birthday"
                               class="form-control"
                               required="true"
                               max="<?= date('m-d-Y'); ?>"/>
                    </div>
                </div>

                <div class="row">
                    <label for="email"
                           class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email"
                               name="email"
                               placeholder="Enter email address"
                               class="form-control"
                               pattern="^[a-zA-Z0-9]+.@algomau.ca$"
                               oninvalid="this.setCustomValidity('Please enter email with @algomau.ca format')"
                               oninput="setCustomValidity('')"/>
                    </div>
                </div>

                <div class="row">
                    <label for="phone"
                           class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="text"
                               name="phone"
                               placeholder="Phone number"
                               class="form-control"
                               pattern="^(\d{10})$"
                               oninvalid="this.setCustomValidity('10 digits only')"
                               oninput="setCustomValidity('')"/>
                    </div>
                </div>

                <div class="row">
                    <label for="province"
                           class="col-sm-3 control-label">Province</label>
                    <div class="col-sm-9">
                        <select id="province"
                                class="form-control">
                                    <?php
                                    foreach ($data->getProvinces() as $province) {
                                        $provinceName = $province['province_name'];
                                        ?>
                                <option value="<?= $provinceName ?>"><?= $provinceName ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <label for="city"
                           class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <select id="city" 
                                name="city"
                                class="form-control"></select>
                    </div>
                </div>

                <div class="row">
                    <label for="note"
                           class="col-sm-3 control-label">Note</label>
                    <div class="col-sm-9">
                        <textarea id="note"
                                  name="note"
                                  class="form-control"
                                  rows="4"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col">
                        <input type="submit" class="btn btn-primary btn-block" value="Add Client"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-sm-8">
        <h2>Client information</h2>
        <table id="clientlist"
               class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Located</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->getClients() as $client) {
                    ?>
                    <tr>
                        <td><?= $client['client_id'] ?></td>
                        <td><?= $client['client_name'] ?></td>
                        <td><?= $client['dob'] ?></td>
                        <td><?= $client['email'] ?></td>
                        <td><?= $client['phone'] ?></td>
                        <td><?= $client['city_name'] . ', ' . $client['province_name'] ?></td>
                        <td><?= $client['createdBy'] ?></td>
                        <td><?= $client['updatedBy'] ?></td>
                        <td><?= $client['createdDate'] ?></td>
                        <td><?= $client['updatedDate'] ?></td>
                        <?php if ($client['createdBy'] == $_SESSION['username'] || $_SESSION['role'] == 'manager') { ?>
                            <td><a href="<?= Util::editClient() . DS . $client['client_id']; ?>">Edit</a></td>
                        <?php } ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php' ?>