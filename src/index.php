<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="icon" href="img/icon.ico">
    <title>Service ERP</title>
</head>
<body>
<?php
if (!isset($_SESSION['login_id'])){
    header("Location: login/");
    die;
}
if(isset($_GET['logout'])) {
    destroySession();
}
function destroySession() {
    session_destroy();
}
?>
<section class="bg-white bg-gray-900">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
        <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-3">
            <img alt="Pattern" src="img/background.avif" class="absolute inset-0 h-full w-full object-cover"/>
        </aside>
        <main aria-label="Main" class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-9">
            <div class="max-w-xl lg:max-w-3xl">
                <h1 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">Home - Service ERP</h1>
                <?php
                if (isset($_SESSION['login_n'])) {
                    echo "<p class='mt-4  text-lg text-gray-400'> Hallo " . $_SESSION['login_n'] .", was gibt es heute zu erledigen?</p>";
                }

                ?>
                <br>
                <a class="block rounded-xl border border-gray-800 bg-gray-800 p-8 shadow-xl" href="customer/">
                    <h3 class="mt-3 text-xl font-bold text-white">Kunde</h3>
                    <p class="mt-4 text-sm text-gray-300">
                        Sehen Sie ihre Kunden. Erstellen Sie einen neuen und löschen sie alte.
                    </p>
                </a>
                <br>
                <?php
                if ($_SESSION['login_b'] == "Bereichsleiter" || $_SESSION['login_b'] == "Administator") {
                    echo '<a class="block rounded-xl border border-gray-800 bg-gray-800 p-8 shadow-xl" href="staff/">';
                    echo '<h3 class="mt-3 text-xl font-bold text-white">Mitarbeiter</h3>';
                    echo '<p class="mt-4 text-sm text-gray-300">Bekommen Sie einen überblick über ihre Mitarbeiter und erstellen Sie einen neuen, falls Sie zuwachs bekommen.</p>';
                    echo '</a>';
                }
                ?>
                <br>
                <a class="block rounded-xl border border-gray-800 bg-gray-800 p-8 shadow-xl" href="order/">
                    <h3 class="mt-3 text-xl font-bold text-white">Aufträge</h3>
                    <p class="mt-4 text-sm text-gray-300">
                        Sehen Sie eine übersicht über Ihre laufenden aufträge, erstellen Sie ein PDF mit dem auftrag,
                    </p>
                </a>
                <br>

                <button onclick="location.href='?logout'" type="button" class="w-32 mt-5 text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Logout</button>
            </div>
        </main>
    </div>
</section>
</body>