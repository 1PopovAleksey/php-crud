<?php
function pdo_connect_mysql()
{
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = 'phpcrud';
  try {
    return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
  } catch (PDOException $exception) {
    exit('Failed to connect to database!');
  }
}

function template_header($title)
{
  echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body class="font-sans">
    <header class="bg-zinc-900">
      <div class="flex justify-between items-center container mx-auto p-5">
        <a class="flex gap-x-2 text-3xl font-medium text-slate-50" href="index.php">
          PHP
          <span class="flex">
            <span class="text-lime-400">C</span>
            <span class="text-white-400">R</span>
            <span class="text-cyan-400">U</span>
            <span class="text-red-400">D</span>
          </span>
        </a>
        <nav class="">
          <a class="text-xl font-normal text-lime-400" href="create.php">Create</a>
        </nav>
      </div>
    </header>
    <main>
EOT;
}

function template_footer()
{
  echo <<<EOT
    </main>
    </body>
</html>
EOT;
}
