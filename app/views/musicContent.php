<div class="main__content">
    <div class="main_header">
        <h1 class="header_title">
            Last posts
        </h1>
        <!-- <form action="" action="">
            <input placeholder="type to search" id="searchField" type="text" style="width: 70%" class="form-control mt-4 m-auto" />
        </form> -->
    </div>  
    <div class="main__container" id="content" style="justify-content: flex-start">
        <?php foreach ($data['musics'] as $music) : ?>
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
</div>
<script src="/public/js/core/fetchGenres.js"></script>