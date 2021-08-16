<?php include_once "templates/header.php" ?>
<style>
  .main__content {
    margin: 0;
    width: 100%;
  }
</style>
<div class="main__content">
  <form id="send" method="post">
    <fieldset>
      <div class="container p-5">
        <?php if ($data['user']) : ?>
          <div class="alert alert-danger">
            <div><?= $data['user'] ?></div>
          </div>
        <?php endif; ?>
        <div class="row p-4">
          <h1>Регистрация</h1>
          <div class="input-group mt-2">
            <input type="text" class="form-control" placeholder="Username ..." name="username" id="username" value="<?= $_POST['username'] ?? '' ?>">
          </div>
          <div class="error">
            <?= $data['username'] ?>
          </div>
          <div class="input-group mt-2">
            <input type="text" class="form-control" placeholder="phone ..." name="phone" id="phone" value="<?= $_POST['phone'] ?? '' ?>">
          </div>
          <div class="error">
            <?= $data['phone'] ?>
          </div>
          <div class="input-group mt-2">
            <input type="email" class="form-control" placeholder="Email ..." aria-label="Email ..." id="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
          </div>
          <div class="error">
            <?= $data['email'] ?>
          </div>
          <div class="input-group mt-2 pass">
            <input type="password" class="form-control" placeholder="Pass ..." aria-label="Pass ..." id="pass" name="password" value="<?= $_POST['password'] ?? '' ?>">
            <button class="btn btn-dark eye" type="button">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <div class="error">
            <?= $data['password'] ?>
          </div>
          <div class="input-group mt-2">
            <input type="submit" class="btn btn-success btn-send" value="Регистрация" name="register">
          </div>
        </div>
      </div>
    </fieldset>
  </form>
</div>
<?php include_once "templates/footer.php" ?>