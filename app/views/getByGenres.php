<?php

use app\models\Music;

include __DIR__ . "/../../vendor/autoload.php";
$genre = $_GET['genres'];
// var_dump($genre);
$data = (new Music)->getByGenres($genre);
?>

<?php foreach ($data as $music) : ?>
    <div class="music item">
        <div class="hover_div" id="hover_div">
            <div class="play_button text-white" data-id="<?= $music['src'] ?>" data-artist="<?= $music['name'] ?>" data-music="<?= $music['title'] ?>" data-image="<?= $music['music_image'] ?>">
                <i class="far fa-play-circle fa-3x"></i>
            </div>
            <div id="like_btn" class="like_button">
                <i class="far fa-heart text-white"></i>
            </div>
        </div>
        <img src="<?= $music['music_image'] ?? '/images/blank.jfif' ?>" style="border-radius: 0" alt="music">
        <div class="info text-left">
            <div class="text-muted float-right"><?= $music['length'] ?></div>
            <div class="music_name"><?= $music['title'] ?></div>
            <div class="mt-3">
                <small class="text-muted"><?= $music['name'] ?></small>
                <?php if (isset($_SESSION['name'])) : ?>
                    <a href="<?= $music['src'] ?>" class="text-dark float-right download" download>
                        <i class="fas fa-arrow-down"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>