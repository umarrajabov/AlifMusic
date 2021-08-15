<?php include_once "templates/header.php"; ?>
<?php include_once __DIR__ . "/adminSidebar.php" ?>
<?php
/**
 * @var array $data
 */
?>

<div class="main__content">
    <?php include __DIR__ . "/templates/statisticsButtons.php" ?>

    <table class="table">
        <thead>
            <tr class="bg-dark text-white">
                <th scope="col">id</th>
                <th scope="col">genre</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <?php foreach ($data as $datium) : ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $datium['id'] ?></th>
                    <td><?= $datium['genre'] ?></td>
                    <td>
                        <a href="/admin/update<?= '/' . $datium['id'] . '/genres'  ?>" class="btn btn-success">Edit</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>
<?php include_once "templates/footer.php"; ?>