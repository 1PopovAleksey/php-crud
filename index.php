<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;

$stmt = $pdo->prepare('SELECT * FROM users ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_users = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
?>

<?= template_header('Read') ?>

<section class="container mx-auto py-10 px-5">
  <h1 class="text-5xl font-medium text-black-50 mb-5">Read users</h1>
  <a class="text-xl font-normal text-lime-400 underline" href="create.php">Create user</a>
  <table class="w-full mt-5">
    <thead class="bg-zinc-900 text-lg font-medium text-slate-50 p-2">
      <tr>
        <td class="p-2">id</td>
        <td class="p-2">Created_at</td>
        <td class="p-2">Updated_at</td>
        <td class="p-2">Name</td>
        <td class="p-2">Email</td>
        <td class="p-2">Password</td>
        <td class="p-2"></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td class="p-2"><?= $user['id'] ?></td>
          <td class="p-2"><?= $user['created_at'] ?></td>
          <td class="p-2"><?= $user['updated_at'] ?></td>
          <td class="p-2"><?= $user['name'] ?></td>
          <td class="p-2"><?= $user['email'] ?></td>
          <td class="p-2"><?= $user['password'] ?></td>
          <td class="flex justify-center gap-x-2 p-2" actions">
            <a href="update.php?id=<?= $user['id'] ?>" class="edit"><i class="fas fa-pen fa-xs text-base"></i></a>
            <a href="delete.php?id=<?= $user['id'] ?>" class="trash"><i class="fas fa-trash fa-xs text-base"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="flex justify-center gap-x-2 mt-2">
    <?php if ($page > 1) : ?>
      <a href="index.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm text-xl"></i></a>
    <?php endif; ?>
    <?php if ($page * $records_per_page < $num_users) : ?>
      <a href="index.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm text-xl"></i></a>
    <?php endif; ?>
  </div>
</section>

<?= template_footer() ?>