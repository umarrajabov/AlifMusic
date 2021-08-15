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
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <?php foreach ($data as $datium) : ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $datium['id'] ?></th>
                    <td><?= $datium['name'] ?></td>
                    <td><?= $datium['email'] ?></td>
                    <td><?= $datium['phone'] ?></td>
                    <td>
                        <?php if ($datium['is_active']) : ?>
                            <a href="/admin/delete<?= '/' . $datium['id'] . '/users' ?>" class="btn btn-danger">Block</a>
                        <?php else : ?>
                            <a href="/admin/delete<?= '/' . $datium['id'] . '/users' ?>" class="btn btn-primary">UnBlock</a>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>
<?php include_once "templates/footer.php"; ?>