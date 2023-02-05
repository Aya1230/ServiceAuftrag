<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/icon.ico">
</head>
<body class="flex flex-col h-full bg-gray-900 bg-slate-900 text-gray-300">

    <img src="../img/icon.ico" class="pt-16 block mx-auto w-20">

    <?php

    if (isset($_POST['name']) && isset($_POST['password'])) {
        function error(string $error)
        {
            switch ($error) {
                case "loginError":
                    echo "<script>alert('Login nicht erfolgreich');</script>";
                    return false;

                case "badPW":
                    echo "<script>alert('Passwort falsch');</script>";
                    return false;

                case "login":
                    echo "<script>alert('Sie wurden eingelogt...');window.location.replace('../');</script>";
                    return true;
            }
        }

        require '../php/include/db.php';

        $name = strip_tags(htmlspecialchars($_POST['name']));
        $pw = strip_tags(htmlspecialchars($_POST['password']));

        $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row == true) {
                if (hash('sha512', $pw) == $row['pw']) {
                    $_SESSION['login_id'] = 'HelloWorld!';
                    $_SESSION['login_b'] = $row['berechtigungen'];
                    $_SESSION['login_n'] = $row['name'];

                    $result = error("login");

                } else {
                    error("badPW");
                }
            } else {
            error("loginError");
        }

    }

    ?>

    <form action="" class="w-full max-w-md mx-auto bg-gray-800 shadow-md rounded px-8 py-6 mt-8" method="post">
        <h1 class="text-xl font-black text-gray-100">Enter your username and password</h1>
        <div class="my-4 mt-8">
            <label class="block text-gray-300 dark:text-gray-300  text-sm font-bold mb-2" for="username">Username</label>
            <input class="bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 text-gray-700 dark:text-gray-300 leading-normal appearance-none focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-300 dark:focus:border-gray-500" id="name" name="name" type="text" required>
        </div>
        <div class="my-4">
            <label class="block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2" for="password">Password</label>
            <input class="transition bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 text-gray-700 dark:text-gray-300 leading-normal appearance-none focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-300 dark:focus:border-gray-500" id="password" name="password" placeholder="Password..." type="password" required>
        </div>
        <button class="button mt-4 w-full bg-indigo-500 py-2.5 rounded" type="submit">Login →</button>
    </form>

</body>
</html>
