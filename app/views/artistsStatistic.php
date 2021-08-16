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
                <th scope="col">№</th>
                <th scope="col">Album</th>
                <th scope="col">actions</th>
                <th scope="col">id</th>
            </tr>
        </thead>
        <?php foreach ($data as $key => $datium) : ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $datium['name'] ?></td>
                    <td>
                        <?php if ($datium['is_active']) : ?>
                            <a href="/admin/delete<?= '/' . $datium['id'] . '/artists' ?>" class="btn btn-secondary">InActive</a>
                        <?php else : ?>
                            <a href="/admin/delete<?= '/' . $datium['id'] . '/artists' ?>" class="btn btn-primary">Active</a>
                        <?php endif; ?>
                        <a href="/admin/update<?= '/' . $datium['id'] . '/artists'  ?>" class="btn btn-success">Edit</a>
                    </td>
                    <th scope="row"><?= $datium['id'] ?></th>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>
<?php include_once "templates/footer.php"; ?>