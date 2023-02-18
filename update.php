<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
  if (!empty($_POST)) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $stmt = $pdo->prepare('UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?');
    $stmt->execute([$name, $email, $password, $_GET['id']]);
    $msg = 'Updated Successfully!';
  }

  $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
  $stmt->execute([$_GET['id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$user) {
    exit('User doesn\'t exist with that ID!');
  }
} else {
  exit('No ID specified!');
}
?>

<?= template_header('Update') ?>

<section class="container mx-auto py-10 px-5">
  <h1 class="text-5xl font-medium text-cyan-400 mb-5">Update User #<?= $user['id'] ?></h1>
  <form class="grid grid-cols-2 gap-5 rounded-lg border-2 border-cyan-400 p-5" action="update.php?id=<?= $user['id'] ?>" method="post">
    <label class="flex flex-col gap-2" for="name">
      Name
      <input class="border-b-2 border-cyan-400 focus:outline-0" type="text" name="name" value="<?= $user['name'] ?>" id="name">
    </label>
    <label class="flex flex-col gap-2" for="email">
      Email
      <input class="border-b-2 border-cyan-400 focus:outline-0" type="email" name="email" value="<?= $user['email'] ?>" id="email" required>
    </label>
    <label class="flex flex-col gap-2" for="password">
      Password
      <input class="border-b-2 border-cyan-400 focus:outline-0" type="password" name="password" value="<?= $user['password'] ?>" id="password" minlength="8" required>
    </label>
    <input class="rounded-lg border-2 border-cyan-400 cursor-pointer" type="submit" value="Update">
  </form>
  <?php if ($msg) : ?>
    <p class="text-xl font-medium text-cyan-400 mt-5"><?= $msg ?></p>
  <?php endif; ?>
</section>

<?= template_footer() ?>