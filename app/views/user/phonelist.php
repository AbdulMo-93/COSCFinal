<?php require_once '../app/views/templates/header.php' ?>

<div class="row">
    <div class="col">
        <h2>Phone List</h2>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <td>Name</td>
                    <td>Phone</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->getPhones() as $client) {
                    ?>
                    <tr>
                        <td><?= $client['name'] ?></td>
                        <td><?= $client['phone'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php' ?>