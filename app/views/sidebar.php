<div class="sidebar">
    <div class="header">
        <a href="/" class="text-white" title="">
            <i class="fas fa-headphones-alt fa-2x"></i>
            <h5 class="d-inline-block logo">&nbsp;<span>Music</span>Hub</h5>
        </a>
    </div>
    <div>
        <small>Main</small>
        <ul class="sidebar_menu">
            <li>
                <a href="/site/index">
                    <i class="far fa-play-circle"></i>
                    <span>Discover</span>
                </a>
            </li>
            <li>
                <a href="/music/albums">
                    <i class="fas fa-music"></i>
                    <span>Albums</span>
                </a>
            </li>
            <li>
                <a href="/music/artists">
                    <i class="fas fa-user"></i>
                    <span>Artists</span>
                </a>
            </li>
            <!-- <li>
                <a href="/music/search">
                    <i class="fas fa-search"></i>
                    <span>Search</span>
                </a>
            </li> -->
        </ul>
        <small>Your collection</small>
        <ul class="sidebar_menu">
            <li>
                <a href="#">
                    <i class="fas fa-heart"></i>
                    <span>Likes</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar_menu login_block">
            <li>
                <?php if (isset($_SESSION['name'])) : ?>
                    <a href="/user/logout">
                        <i class="fas fa-user"></i>
                        <span>Logout</span>
                    </a>
                 <?php else: ?>   
                    <a href="/user/login">
                    <i class="fas fa-user"></i>
                    <span>Login</span>
                </a>
                <?php endif ?>
            </li>
        </ul>
    </div>
</div>