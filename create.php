<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $stmt = $pdo->prepare('INSERT INTO users VALUES ($name, $email, $password)');
  $msg = 'Created Successfully!';
}
?>

<?= template_header('Create') ?>

<section class="container mx-auto py-10 px-5">
  <h1 class="text-5xl font-medium text-lime-400 mb-5">Create User</h1>
  <form class="grid grid-cols-2 gap-5 rounded-lg border-2 border-lime-400 p-5" action="create.php" method="post">
    <label class="flex flex-col gap-2" for="name">
      Name
      <input class="border-b-2 border-lime-400 focus:outline-0" type="text" name="name" placeholder="John Doe" id="name">
    </label>
    <label class="flex flex-col gap-2" for="email">
      Email
      <input class="border-b-2 border-lime-400 focus:outline-0" type="email" name="email" placeholder="johndoe@example.com" id="email" required>
    </label>
    <label class="flex flex-col gap-2" for="password">
      Password
      <input class="border-b-2 border-lime-400 focus:outline-0" type="password" name="password" placeholder="password" id="password" minlength="8" required>
    </label>
    <input class="rounded-lg border-2 border-lime-400 cursor-pointer" type="submit" value="Create">
  </form>
  <?php if ($msg) : ?>
    <p class="text-xl font-medium text-lime-400 mt-5"><?= $msg ?></p>
  <?php endif; ?>
</section>

<?= template_footer() ?>