<?php include_once "templates/header.php"; ?>
<?php include_once "adminSidebar.php"; ?>

<div class="main__content">
  <?php include __DIR__ . "/templates/statisticsButtons.php" ?>

  <table class="table">
    <thead>
      <tr class="bg-dark text-white">
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <?php foreach ($data as $datium) : ?>
      <tbody>
        <tr>
          <th scope="row"><?= $datium['id'] ?></th>
          <td><?= $datium['title'] ?></td>
          <td>
            <?php if ($datium['is_active']) : ?>
              <a href="/admin/delete<?= '/' . $datium['id'] .'/music' ?>" class="btn btn-secondary">InActive</a>
              <?php else : ?>
                <a href="/admin/delete<?= '/' . $datium['id'] .'/music' ?>" class="btn btn-primary">Active</a>
            <?php endif; ?>
            <a href="/admin/update<?= '/' . $datium['id'] . '/music'  ?>" class="btn btn-success">Edit</a>
          </td>
        </tr>
      </tbody>
    <?php endforeach; ?>
  </table>
</div>
<?php include_once "templates/footer.php"; ?>