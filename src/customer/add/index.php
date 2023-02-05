<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <title>Kunden hinzufügen</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/icon.ico">
</head>
<body class="flex flex-col h-full bg-gray-900 bg-slate-900">
<section class="bg-white bg-gray-900">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
        <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
            <img alt="Pattern" src="../../img/background-customer.webp" class="absolute inset-0 h-full w-full object-cover"/>
        </aside>
        <main aria-label="Main" class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6">
            <div class="max-w-xl lg:max-w-3xl"><a class="block text-blue-600" href="/"><span class="sr-only">Home</span></a>
                <a class="block text-blue-600" href="../">
                    <span class="">← Zurück</span>
                </a>
                <h1 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">Neuen Kunden hinzufügen</h1>
                <?php
                /*
                if (!isset($_SESSION['login'])){
                    header("Location: ../login/");
                    die;
                }
                */

                if (isset($_POST["button"])) {
                    function error(string $error): void
                    {
                        switch ($error) {
                            case "customerExists":
                                echo "<script>alert('Error: Fehlerhafter Input');</script>";
                                break;
                            case "register":
                                echo "<script>alert('User wurde erstellt');window.location.replace('../');</script>";
                                break;
                        }

                    }

                    require '../../php/include/db.php';

                    $stmt = $conn->prepare("SELECT * FROM kunde WHERE name = :name");
                    $stmt->bindParam(':name', $_POST['name']);
                    $stmt->execute();
                    $result = $stmt->fetch();

                    if ($result) {
                        error("customerExists");
                    } else {
                        $stmt = $conn->prepare("INSERT INTO kunde (anrede, name, tel, phone, adresse, plz, ort) VALUES (:anrede, :name, :tel, :phone, :adresse, :plz, :ort)");
                        $stmt->execute([
                            ':anrede' => strip_tags(htmlspecialchars($_POST['anrede'])),
                            ':name' => strip_tags(htmlspecialchars($_POST['name'])),
                            ':tel' => strip_tags(htmlspecialchars($_POST['tel'])),
                            ':phone' => strip_tags(htmlspecialchars($_POST['phone'])),
                            ':adresse' => strip_tags(htmlspecialchars($_POST['adresse'])),
                            ':plz' => strip_tags(htmlspecialchars($_POST['plz'])),
                            ':ort' => strip_tags(htmlspecialchars($_POST['ort']))
                        ]);

                        error("register");

                    }


                }
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="mt-8 grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">
                    <label for="anrede" class="block mb-2 text-sm font-medium text-gray-300">Anrede</label>
                    <select required="" name="anrede" id="anrede" class="border-gray-200 bg-white text-gray-400 text-sm shadow-sm border-gray-700 bg-gray-800  outline-none appearance-none border border-transparent rounded w-full p-2 leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500">
                        <option selected>Herr</option>
                        <option>Frau</option>
                    </select>
                </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label class="block text-gray-300 text-gray-300  text-sm font-bold mb-2" for="name">Name</label>
                        <input class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-800 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" id="name" name="name" placeholder="Max Mustermann" type="text" required>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="tel" class="block text-gray-300 text-gray-300  text-sm font-bold mb-2">Telefonnummer</label>
                        <input class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-800 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" id="tel" name="tel" placeholder="076 123 45 67" type="tel" required>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="phone" class="block text-gray-300 text-gray-300  text-sm font-bold mb-2">Natel</label>
                        <input class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-800 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" id="phone" name="phone" placeholder="056 123 45 67" type="tel" required>
                    </div>
                    <div class="col-span-6">
                        <label class="block text-gray-300 text-gray-300  text-sm font-bold mb-2" for="adresse">Strasse</label>
                        <input class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-800 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" id="adresse" name="adresse" placeholder="Musterstrasse" type="text" required>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="ort" class="block text-gray-300 text-gray-300  text-sm font-bold mb-2">Ort</label>
                        <input class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-800 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" id="ort" name="ort" placeholder="Musterort" type="text" required>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="plz" class="block text-gray-300 text-gray-300  text-sm font-bold mb-2">PLZ</label>
                        <input class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-800 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" id="plz" name="plz" placeholder="1234" type="number" required>
                    </div>
                    <div class="col-span-6 flex justify-between">
                        <input type="submit" name="button" class="inline-block shrink-0 h-12 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent focus:outline-none focus:ring active:text-blue-500 hover:bg-blue-700 hover:text-white w-1/2" value="Create Account">
                    </div>
                </form>
            </div>
        </main>
    </div>
</section>

</body>
</html>
