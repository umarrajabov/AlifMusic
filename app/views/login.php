<?php include_once "templates/header.php" ?>

<style>
  .main__content {
    margin: 0;
    width: 100%;
  }
</style>
<div class="main__content">
  <form action="" id="send" method="post">
    <fieldset>
      <div class="container p-5">
        <?php if ($data) : ?>
          <div class="alert alert-danger">
            <div><?= $data['email'] ?></div>
            <div><?= $data['password'] ?></div>
            <div><?= $data['user'] ?></div>
          </div>
        <?php endif; ?>
        <div class="row p-4">
          <h1>Login</h1>
          <div class="input-group mt-2">
            <input type="email" class="form-control" id="email" placeholder="Email address" name="email" value="<?= $_POST['email'] ?? '' ?>">
          </div>
          <div class="input-group mt-2 pass">
            <input type="password" class="form-control" placeholder="Password" aria-label="Pass ..." id="pass" name="password" value="<?= $_POST['password'] ?? '' ?>">
            <button class="btn btn-dark eye" type="button">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <div class="input-group mt-2 btn-group">
            <input type="submit" class="btn btn-success btn-send" value="Войти" name="login">
          </div>
          <div class="mt-2">
            <a href="#" class="link-info">Забыли пароль?</a><br />
            <a href="/user/register" class="link-info">Хотите зарегистрироватся?</a>
          </div>
        </div>
      </div>
    </fieldset>
  </form>
</div>
<script src="/public/js/core/signin.js"></script>
<?php include_once "templates/footer.php" ?>