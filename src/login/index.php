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

    if (isset($_POST['username']) && isset($_POST['password'])) {
        function error(string $error): void
        {
            switch ($error) {
                case "loginError":
                    $message= "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . "<span class='text-red-800'>Error: </span>". 'Login nicht erfolgreich!' . "</p>";
                    break;

                case "badPW":
                    $message= "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . "<span class='text-red-800'>Error: </span>". 'Passwort falsch!' . "</p>";
                    break;

                case "userLocked":
                    $message= "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . "<span class='text-red-800'>Error: </span>". 'Benutzer ist gesperrt. Das Ändern des Passworts ist nicht mehr möglich, bitte kontaktieren Sie ihren Administrator!' . "</p>";
                    break;

                case "login":
                    $message= "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . 'Sie wurden eingelogt...' . "</p>";
                    break;
            }

            echo "<div class='w-full max-w-md mx-auto bg-gray-800 shadow-md rounded px-8 py-6 mt-8'>";
            echo $message;
            echo "</div>";
        }

        $attempts = 0;
        $maxAttempts = 3;

        require '../php/include/db.php';

        $username = strip_tags(htmlspecialchars($_POST['username']));
        $pw = strip_tags(htmlspecialchars($_POST['password']));

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row == true) {
            if ($row['disabled'] == 0) {
                if (hash('sha512', $pw) == $row['pw']) {
                    error("login");

                    $stmt = $conn->prepare("UPDATE users SET disabled = 0, attempts = 0 WHERE username= :username");
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                } else {
                    error("badPW");

                    if ($row["attempts"] < $maxAttempts) {
                       $stmt = $conn->prepare("UPDATE users SET attempts = attempts + 1 WHERE username= :username");
                       $stmt->bindParam(':username', $username);
                       $stmt->execute();
                    } else {
                        $stmt = $conn->prepare("UPDATE users SET disabled = 1 WHERE username= :username");
                        $stmt->bindParam(':username', $username);
                        $stmt->execute();
                    }
                }
            } else {
                error("userLocked");
            }
        } else {
            error("loginError");
        }

    }

    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" class="w-full max-w-md mx-auto bg-gray-800 shadow-md rounded px-8 py-6 mt-8" method="post">
        <h1 class="text-xl font-black text-gray-100">Enter your username and password</h1>
        <div class="my-4 mt-8">
            <label class="block text-gray-300 dark:text-gray-300  text-sm font-bold mb-2" for="username">Username</label>
            <input class="bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 text-gray-700 dark:text-gray-300 leading-normal appearance-none focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-300 dark:focus:border-gray-500" id="username" name="username" <?php if(empty($_SESSION['username'])) { echo "placeholder='Username...'";} else { echo "value='{$_SESSION['username']}'";;} ?>  type="text" required>
        </div>
        <div class="my-4">
            <label class="block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2" for="password">Password</label>
            <input class="transition bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 text-gray-700 dark:text-gray-300 leading-normal appearance-none focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-300 dark:focus:border-gray-500" id="password" name="password" placeholder="Password..." type="password" required>
        </div>
        <button class="button mt-4 w-full bg-indigo-500 py-2.5 rounded" type="submit">Login →</button>
        <p class="text-gray-300 dark:text-gray-300 text-xs my-2">No account yet? <a href="../register" class="underline text-gray-500 dark:text-gray-50">Click here</a> to make one.</p>
    </form>

</body>
</html>
