<div class="content">
  <form id="send">
    <fieldset>
    <div class="container">
      <div class="state"></div>
      <div class="row">
        <div class="input-group mt-4">
          <div class="col">
            <input type="text" class="form-control" placeholder="First name" aria-label="First name" id="name" name="name" required>
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" id="lastname" name="lastname" required>
          </div>
        </div>
        <div class="input-group mt-2">
          <div class="col">
            <input type="email" class="form-control" placeholder="Email ..." aria-label="Email ..." id="email" name="email" required>
          </div>
          <div class="col">
            <input type="password" class="form-control" placeholder="Pass ..." aria-label="Pass ..." id="pass" name="pass" required>
          </div>
          <button type="button" class="btn btn-dark eye">
            <i class="bi bi-eye"></i>
          </button>
        </div>
        <div class="input-group mt-2">
          <button class="btn btn-success btn-send">
            Зарегистрироваться
          </button>
        </div>
      </div>
    </div>
    </fieldset>
  </form>
</div>

<script src="/public/js/core/signup.js"></script>

<? require_once './footer.php'; ?>