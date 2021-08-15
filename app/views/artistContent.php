<div class="main__content">
    <h1 class="header_title">Artists</h1>
    <div class="main__container">
        <?php foreach ($data as $artist): ?>
            <div class="item">
            <img src="<?= $artist['avatar'] ?>" alt="sdf">
                <div class="info">
                    <div class="author_name"><?= $artist['name'] ?></div>
                    <small class="songs_count text-muted"><?= $artist['songs'] ?> songs</small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
