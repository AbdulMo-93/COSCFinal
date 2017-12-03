<?php
require_once '../app/views/templates/header.php';
$client = $data[0];
$reports = $data[1];
?>

<div class="row">
    <form class="form-inline" 
          action="<?= Util::report() ?>"
          id="reportform"
          method="post">
        <label for="province">Location</label>
        <select id="province"
                class="form-control">
                    <?php
                    foreach ($client->getProvinces() as $province) {
                        $provinceName = $province['province_name'];
                        ?>
                <option value="<?= $provinceName ?>"><?= $provinceName ?></option>
                <?php
            }
            ?>
        </select>
        <label for="city">City</label>
        <select id="city" 
                name="city"
                class="form-control"></select>
        <label for="age">People younger than</label>
        <select id="age"
                name="age"
                class="form-control">
            <option value="10">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
        <input id="search"
               type="submit" 
               class="btn btn-primary" 
               value="Search"/>
    </form>
</div>

<?php if($reports){ ?>
<div class="row" style="padding-top: 20px;">
    <h2>Client information</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Day of birth</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created Date</th>
                <th>Updated Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($reports as $report) {
                ?>
                <tr>
                    <td><?= $report['id'] ?></td>
                    <td><?= $report['name'] ?></td>
                    <td><?= $report['dob'] ?></td>
                    <td><?= $report['email'] ?></td>
                    <td><?= $report['phone'] ?></td>
                    <td><?= $report['createdBy'] ?></td>
                    <td><?= $report['updatedBy'] ?></td>
                    <td><?= $report['createdDate'] ?></td>
                    <td><?= $report['updatedDate'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php }else{ ?>
<br/><br/>
<h2>Oops! There is no any result for this report.</h2>
<?php } ?>

<?php require_once '../app/views/templates/footer.php' ?>