<?php include_once __DIR__ . "/templates/header.php" ?>
<?php include_once __DIR__ . "/adminSidebar.php" ?>

<div class="main__content">
    <div class="container w-75 mt-3">
        <h1 class="mb-4">Добавить Жанрь</h1>
        <form action="" method="post" class="form" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Имя</label>
                <input type="text" name="genre" class="form-control" value="<?= $data['data']['genre'] ? $data['data']['genre'] : $_POST['genre'] ?? ''?>">
                <div class="error"><?= $data['errors']['genre'] ?></div>
            </div>

            <div class="mb-3">
                <label>description</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <div>
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