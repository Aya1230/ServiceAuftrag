<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="icon" href="../img/icon.ico">
    <title>Kundenübersicht</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="w-full">
        <div class="flex flex-1 w-2/3 mx-auto items-center">
            <h1 class="w-full mx-auto uppercase text-4xl font-bold py-4 text-white">Kundenübersicht</h1>
                <button onclick="location.href='add/'" type="button" class="w-96 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Neuer Kunde</button>
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
                </tr>
            </thead>
            <tbody>
                    <?php
                        require '../php/include/db.php';

                        $stmt = $conn->prepare("SELECT * FROM kunde");
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            foreach ($stmt as $row) {
                                echo "<tr class='bg-white border-b bg-gray-800 border-gray-700 text-center'>";
                                echo "<th scope='row' class='tx-6 py-4 font-medium dark:text-gray-900 whitespace-nowrap text-white'>" . $row['k_id'] . "</th>";
                                echo "<td class='px-6 py-4'>" . $row['anrede'] . "</td>";
                                echo "<td class='px-6 py-4'>" . $row['name'] . "</td>";
                                echo "<td class='px-6 py-4'>" . $row['tel'] . "</td>";
                                echo "<td class='px-6 py-4'>" . $row['phone'] . "</td>";
                                echo "<td class='px-6 py-4'>" . $row['adresse'] . "</td>";
                                echo "<td class='px-6 py-4'>" . $row['plz'] . "</td>";
                                echo "<td class='px-6 py-4'>" . $row['ort'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<td class='bg-white border-b bg-gray-800 border-gray-700 px-6 py-4' colspan='8'>Keine Kunden vorhanden</td>";
                        }
                    ?>
                    <!--<td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Bearbeiten</a>
                    </td>-->
            </tbody>
        </table>
    </div>
</body>
</html>