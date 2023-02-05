<!DOCTYPE html>
<html lang="de">

<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="icon" href="../img/icon.ico">
    <script src="../js/phone.js"></script>
    <title>Mitarbeiterübersicht</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="w-full">
        <div class="flex flex-1 w-2/3 mx-auto items-center">
            <h1 class="w-full mx-auto uppercase text-4xl font-bold py-4 text-white">Mitarbeiterübersicht</h1>
            <button onclick="location.href='add/'" type="button" class="w-96 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Neuer Mitarbeiter</button>
        </div>
        <table class="w-2/3 mx-auto text-sm text-left text-gray-500 text-gray-400">
            <thead class="text-xs dark:text-gray-700 uppercase dark:bg-gray-50 bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Anrede</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Tel.</th>
                    <th scope="col" class="px-6 py-3">Natel</th>
                    <th scope="col" class="px-6 py-3">Strasse</th>
                    <th scope="col" class="px-6 py-3">Ort</th>
                    <th scope="col" class="px-6 py-3">PLZ</th>
                    <th scope="col" class="px-6 py-3">Berechtigungen</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b bg-gray-800 border-gray-700">
                    <?php
                    if (!isset($_SESSION['login_id']) && $_SESSION['login_b'] == "Mitarbeiter"){
                        header("Location: ../../login/");
                        die;
                    }

                    require '../php/include/db.php';

                    $stmt = $conn->prepare("SELECT * FROM users");
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        foreach ($stmt as $row) {
                            echo "<tr class='bg-white border-b bg-gray-800 border-gray-700 text-center'>";
                            echo "<th scope='row' class='tx-6 py-4 font-medium dark:text-gray-900 whitespace-nowrap text-white'>" . $row['u_id'] . "</th>";
                            echo "<td class='px-6 py-4'>" . $row['anrede'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['name'] . "</td>";
                            echo "<td class='px-6 py-4' id='phone'>" . $row['tel'] . "</td>";
                            echo "<td class='px-6 py-4' id='phone'>" . $row['phone'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['adresse'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['plz'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['ort'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['berechtigungen'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<td class='bg-white border-b bg-gray-800 border-gray-700 px-6 py-4' colspan='9'>Keine Mitarbeiter vorhanden</td>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <div class="flex flex-1 w-2/3 mx-auto items-center">
            <button onclick="location.href='../'" type="button" class="w-32 mt-5 text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                Zurück
            </button>
        </div>
    </div>
</body>
</html>