<?php require_once '../app/views/templates/header.php' ?>

<div class="row">
    <div class="col-sm-4">
        <h2>Reminder Management</h2>
        <form id="reminderform" 
              method="post" 
              action="<?= REMINDER_SAVE ?>"
              class="form-horizontal">
             <div class="row">
                <input type="hidden"
                       name="reminderId"
                       id="reminderId"
                       value="<?= $data->id; ?>"/>
            </div>
            
            <div class="row">
                <label for="subject"
                       class="col-sm-3 control-label">Subject</label>
                <div class="col-sm-9">
                    <input type="text"
                           id="subject"
                           name="subject"
                           placeholder="Enter Subject"
                           class="form-control"
                           value="<?= $data->subject; ?>"/>
                </div>
            </div>

            <div class="row">
                <label for="description"
                       class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                    <textarea id="description"
                              name="description"
                              class="form-control col"
                              rows="4"><?= $data->description; ?></textarea>
                </div>
            </div>

            <?php if (!empty($data->id)) {
                ?> 
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col">
                        <input type="submit" 
                               class="btn btn-primary btn-block" 
                               value="Update Reminder"/>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col">
                        <input type="submit" 
                               class="btn btn-primary btn-block" 
                               value="Create Reminder"/>
                    </div>
                </div>

                <?php
            }
            ?>
        </form>
    </div>

    <div class="col-sm-8">
        <h2>Reminder List</h2>
        <table id="reminderlist"
               class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Created By</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->get_reminders() as $reminder) {
                    ?>
                    <tr>
                        <td><?= $reminder['id'] ?></td>
                        <td><?= $reminder['subject'] ?></td>
                        <td><?= $reminder['description'] ?></td>
                        <td><?= $reminder['createdDate'] ?></td>
                        <td><?= $reminder['username'] ?></td>
                        <td><a href="<?= REMINDER . DS . $reminder['id']; ?>">Edit</a></td>
                        <td><a href="<?= REMINDER_DELETE . DS . $reminder['id']; ?>">Delete</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php' ?>