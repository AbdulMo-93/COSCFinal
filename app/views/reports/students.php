<?php
require_once '../app/views/templates/header_admin.php';
$reminder = $data[0];
$reports = $data[1];
?>

<h2> Student Reports! </h2>
<div class="row">
    <!-- Report Form -->
    <div class="col-sm-4">
        <form action="<?= REMINDER_REPORT ?>"
              method="post">
            <div class='row'>
                <label class="col-sm-8">Who has the most reminders</label>
                <div class="col-sm-4">
                    <input type="checkbox" 
                           name="mostreminder"/>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4">From:</label>
                <div class="col-sm-8">
                    <input type="date"
                           name="fromdate"
                           class="form-control"/>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4">To:</label>
                <div class="col-sm-8">
                    <input type="date"
                           name="todate"
                           class="form-control"/>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4">Total Login</label>
                <div class="col-sm-8">
                    <input type="text" 
                           name="totallogin" 
                           class="form-control"/>
                </div>
            </div>
            
            <div class="row">
                <label class="col-sm-4"></label>
                <div class="col-sm-8">
                    <input type="submit"
                           value="Report"
                           class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>

    <!-- Report List -->
    <div class="col-sm-8">
        <h2>Reminder Information</h2>
        <table class="table table-stripped">
            <thead class="thead-dark">
                <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Username</th>
                    <th>Attempt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($reports as $report){
                ?>
                <tr>
                    <td><?= $report['subject'] ?></td>
                    <td><?= $report['description'] ?></td>
                    <td><?= $report['createdDate'] ?></td>
                    <td><?= $report['username'] ?></td>
                    <td><?= $report['attempts'] ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php' ?>