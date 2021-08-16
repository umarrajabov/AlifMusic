<?php include_once __DIR__ . "/templates/header.php" ?>
<?php include_once __DIR__ . "/adminSidebar.php" ?>

<div class="main__content">
    <div class="container w-75 mt-3">
        <h1 class="mb-4">Добавить Артист</h1>
        <?php if ($data['errors']['image']): ?>
        <div class="alert alert-danger">
            <?= $data['errors']['image'];?>
        </div>
        <?php endif; ?>
        <form action="" method="post" class="form" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Имя</label>
                <input type="text" name="name" class="form-control" value="<?= $data['data']['name'] ? $data['data']['name'] : $_POST['name'] ?? '' ?>">
                <div class="error"><?= $data['errors']['name'] ?></div>
            </div>
            <div class="mb-3">
                <label>Био</label>
                <textarea name="bio" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                    <label for="file" class="btn btn-dark desc">
                        Аватар
                        <i class="fa fa-portrait"></i>
                    </label>
                    <input type="file" name="image" id="file" style="display: none;">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" name="submit">
                            Добавить
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/public/js/core/validateFile.js"></script>
<?php include_once __DIR__ . "/templates/footer.php" ?>