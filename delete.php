<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
  $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
  $stmt->execute([$_GET['id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$user) {
    exit('User doesn\'t exist with that ID!');
  }
  if (isset($_GET['confirm'])) {
    if ($_GET['confirm'] == 'yes') {
      $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
      $stmt->execute([$_GET['id']]);
      $msg = 'You have deleted the user!';
    } else {
      header('Location: index.php');
      exit;
    }
  }
} else {
  exit('No ID specified!');
}
?>

<?= template_header('Delete') ?>

<section class="container mx-auto py-10 px-5">
  <h1 class="text-5xl font-medium text-red-400 mb-5">Delete User #<?= $user['id'] ?></h1>
  <?php if ($msg) : ?>
    <p class="text-xl text-lime-400"></p><?= $msg ?></p>
  <?php else : ?>
    <p class="text-xl mb-3">Are you sure you want to delete user #<?= $user['id'] ?>?</p>
    <div class="flex gap-x-2">
      <a class="text-xl font-medium text-lime-400" href="delete.php?id=<?= $user['id'] ?>&confirm=yes">Yes</a>
      <a class="text-xl font-medium text-red-400" href="delete.php?id=<?= $user['id'] ?>&confirm=no">No</a>
    </div>
  <?php endif; ?>
</section>

<?= template_footer() ?>