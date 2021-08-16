<?php include_once "templates/header.php"; ?>
<?php include_once __DIR__ . "/adminSidebar.php" ?>
<?php
/**
 * @var array $data
 */
?>
<div class="main__content">
    <div class="container w-75 mt-3">
        <h1 class="mb-4">Добавить Музыку</h1>
        <?php if ($data['errors']) : ?>
            <div class="alert alert-danger">
                <div><?= $data['errors']['image']; ?></div>
                <div><?= $data['errors']['music']; ?></div>
            </div>
        <?php endif; ?>
        <form action="" class="form" method="POST" enctype="multipart/form-data">
            <fieldset>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="title">Имя</label>
                        <input type="text" name="title" class="form-control" value="<?= $data['data'] ? $data['data']['title'] : $_POST['title'] ?? '' ?>">
                        <div class="error"><?= $data['errors']['title'] ?></div>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Длина</label>
                        <input class="form-control" type="text" name="length">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label>Альбом</label>
                        <select class="form-control" name="album">
                            <?php foreach ($data['albums'] as $key => $albums) : ?>
                                <option value="<?= $albums['id'] ?>"><?= $albums['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Жанры</label>
                        <select class="form-control" name="genre">
                            <?php foreach ($data['genres'] as $key => $genres) : ?>
                                <option value="<?= $genres['id'] ?>"><?= $genres['genre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-4">
                        <label>Испольнитель</label>
                        <select class="form-control" name="author">
                            <?php foreach ($data['authors'] as $key => $artists) : ?>
                                <option value="<?= $artists['id'] ?>"><?= $artists['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Картинка</label>
                    <input class="form-control" type="file" id="formFileMultiple" name="image">
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="file" class="btn btn-dark desc">
                                Выберите Музыку
                                <i class="bi bi-file-earmark-music"></i>
                            </label>
                            <input type="file" name="music" id="file" style="display: none;">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success" name="submit">
                                Добавить
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script src="/public/js/core/validateFile.js"></script>
<?php include_once "templates/footer.php"; ?>