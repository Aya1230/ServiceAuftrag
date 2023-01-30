<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
  <title>Register</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/tailwind.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/icon.ico">
</head>
<body class="flex flex-col h-full bg-gray-900 bg-slate-900">

    <img src="../img/icon.ico" class="pt-16 block mx-auto w-20" alt="logo">

    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {

        function error(string $error): void {

            switch ($error) {
                case "passwordBad":
                    $message = "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . "<span class='text-red-800'>Error: </span>". 'Das Passwort muss mindestens einen Großbuchstaben, einen Kleinbuchstaben, eine Ziffer und ein Sonderzeichen enthalten. Die Mindestlänge des Passworts beträgt zehn Ziffern.' . "</p>";
                    break;
                case "userExists":
                    $message= "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . "<span class='text-red-800'>Error: </span>". 'Benutzer existiert bereits!' . "</p>";
                    break;
                case "register":
                    $message= "<p class='block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2'>" . 'User wurde erstellt' . "</p>";
                    break;
            }

            echo "<div class='w-full max-w-md mx-auto bg-gray-800 shadow-md rounded px-8 py-6 mt-8'>";
            echo $message;
            echo "</div>";
        }

        function redirect() {
            header('Location: ../login');
            exit;
        }


        $username = trim($_POST['username']);
        $pw = trim($_POST['password']);
        $_SESSION['username'] = $username;

        $conn = new PDO("mysql:host=127.0.0.1;dbname=service", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try {
            if (preg_match('@[A-Z]@', $pw) && preg_match('@[a-z]@', $pw) && preg_match('@[0-9]@', $pw) && preg_match('@\w@', $pw) && strlen($pw) > 10) {
                $stmt = $conn->prepare("INSERT INTO users (username, pw) VALUES (:username, sha(:pw))");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':pw', $pw);
                $stmt->execute();

                error("register");
                redirect();
            } else {
                error("passwordBad");
            }
        } catch (PDOException $exception) {
            error("userExists");
        }

    }
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" class="w-full max-w-md mx-auto bg-gray-800 shadow-md rounded px-8 py-6 mt-8" method="post">
        <h1 class="text-xl font-black text-gray-100">Register your account</h1>
        <div class="my-4 mt-8">
            <label class="block text-gray-300 dark:text-gray-300  text-sm font-bold mb-2" for="username">Username</label>
            <input class="bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 text-gray-700 dark:text-gray-300 leading-normal appearance-none focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-300 dark:focus:border-gray-500" id="username" name="username" placeholder="Username..." type="text" required>
        </div>
        <div class="my-4">
            <label class="block text-gray-300 dark:text-gray-300 text-sm font-bold mb-2" for="password">Password</label>
            <input class="transition bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 text-gray-700 dark:text-gray-300 leading-normal appearance-none focus:outline-none focus:bg-white dark:focus:bg-gray-800 focus:border-gray-300 dark:focus:border-gray-500" id="password" name="password" placeholder="Password..." type="password" required>
        </div>
        <button class="button mt-4 w-full bg-indigo-500 py-2.5 rounded" type="submit">Register →</button>
    </form>

</body>
</html>
