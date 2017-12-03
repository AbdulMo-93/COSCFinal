<?php require_once '../app/views/templates/header.php' ?>

<div class="col">
    <form id="updateclient" 
          action="<?= Util::updateClient() ?>" 
          method="post"
          class="form-horizontal">
        <div class="row">
            <input type="hidden"
                   name="id"
                   value="<?= $data->id ?>"
                   class="form-control"/>
        </div>

        <div class="row">
            <label for="name"
                   class="col-sm-3 control-label">Client Name</label>
            <div class="col-sm-9">
                <input type="text" 
                       name="name"
                       value="<?= $data->name ?>"
                       placeholder="Enter Cilent Name"
                       class="form-control"/>
            </div>
        </div>

        <div class="row">
            <label for="dob"
                   class="col-sm-3 control-label">DOB</label>
            <div class="col-sm-9">
                <input type="date"
                       name="dob"
                       value="<?= $data->dob ?>"
                       placeholder="Select client birthday"
                       class="form-control"/>
            </div>
        </div>

        <div class="row">
            <label for="email"
                   class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email"
                       name="email"
                       value="<?= $data->email ?>"
                       placeholder="Enter email address"
                       class="form-control"/>
            </div>
        </div>

        <div class="row">
            <label for="phone"
                   class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-9">
                <input type="text"
                       name="phone"
                       value="<?= $data->phone ?>"
                       placeholder="Phone number"
                       class="form-control"/>
            </div>
        </div>

        <div class="row">
            <label for="province"
                   class="col-sm-3 control-label">Province</label>
            <div class="col-sm-9">
                <select id="province"
                        name="province"
                        class="form-control">
                    <option value="<?= $data->city->province ?>"><?= $data->city->province ?></option>
                    <?php
                    foreach ($data->getProvinces() as $province) {
                        $provinceName = $province['province_name'];

                        if ($provinceName != $data->city->province) {
                            ?>
                            <option value="<?= $provinceName ?>"><?= $provinceName ?></option>
                            <?php
                        }
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
                        class="form-control">
                    <option value="<?= $data->city->id ?>"><?= $data->city->name ?></option>
                </select>
            </div>
        </div>

        <div class="row">
            <label for="note"
                   class="col-sm-3 control-label">Note</label>
            <div class="col-sm-9">
                <textarea id="note"
                          name="note"
                          class="form-control"
                          rows="4"><?=$data->note?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col">
                <input type="submit" 
                       value="Save"
                       class="btn btn-primary btn-block"/>
            </div>
            <div class="col">
                <a href="http://localhost/cosc/public">Back</a>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/templates/footer.php' ?>