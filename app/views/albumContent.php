<div class="main__content">
    <div class="main_header">
        <h1 class="header_title">
            Last posts
        </h1>
    </div>  
    <div class="main__container" id="content" style="justify-content: flex-start">
        <?php foreach ($data as $albums) : ?>
            <div class="music item">
                <img src="<?= $albums['photo'] ?? '/images/blank.jfif' ?>" style="border-radius: 0" alt="music">
                <div class="info text-left">
                    <div class="text-muted float-right"><?= $albums['year'] ?></div>
                    <div class="music_name"><?= $albums['name'] ?></div>
                    <div class="mt-3">
                        <small class="text-muted"><?= $albums['name'] ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>