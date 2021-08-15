<div class="_player_">
    <div class="proccess" id="proc">
        <div class="progress" id="prog"></div>
    </div>
    <div class="player">
        <div class="music_info" id="music" data-src="/music/Eminem - Lose Yourself.mp3">
            <div class="music_image">
                <img src="/images/Eminem.jfif" alt="eminem" id="musicImage">
            </div>
            <div class="main_info">
                <div class="author_name" id="authorName">Eminem</div>
                <div class="music_name" id="musicStatus">Lose Yourself</div>
            </div>
            <div class="action_like">
                <i class="far fa-heart like-icon"></i>
            </div>
        </div>
        <div class="control_bar">
            <i class="fas fa-random do_sm"></i>
            <i class="fas fa-backward do_nm" data-id="backward"></i>
            <i id="play" class="fas fa-play-circle do_lg"></i>
            <i class="fas fa-forward do_nm" data-id="forward"></i>
            <i class="fas fa-redo do_sm" data-id="loop"></i>
        </div>
        <div class="music_status">
            <?php if (isset($_SESSION['name'])) : ?>
                <a href="/music/Eminem - Lose Yourself.mp3" data-id="download" download>
                    <i class="fas fa-arrow-down download"></i>
                </a>
            <?php endif; ?>
            <div class="music_time">
                <span class="current_time">00:00</span>
                <span class="del">/</span>
                <span class="music_duration">00:00</span>
            </div>
            <i id="volicon" class="fas fa-volume-up"></i>
        </div>
        <div class="volumeSeeker">
            <input type="range" value="100" />
        </div>
    </div>