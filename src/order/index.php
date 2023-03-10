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
    <title>Auftragsübersicht</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="w-full">
        <div class="flex flex-1 w-2/3 mx-auto items-center">
            <h1 class="w-full mx-auto uppercase text-4xl font-bold py-4 text-white">Auftragsübersicht</h1>
            <button onclick="location.href='add/'" type="button" class="w-96 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Neuer Auftrag 
            </button>
        </div>
        <table class="w-2/3 mx-auto text-sm text-left text-gray-500 text-gray-400">
            <thead class="text-xs dark:text-gray-700 uppercase dark:bg-gray-50 bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Auftrag Name</th>
                    <th scope="col" class="px-6 py-3">Tags</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Hinzugefügt am</th>
                    <th scope="col" class="px-6 py-3">Wunschtermin</th>
                    <th scope="col" class="px-6 py-3">Mitarbeiter zugewiesen</th>
                    <th scope="col" class="px-6 py-3">Kunde zugewiesen</th>
                    <th scope="col" class="px-6 py-3">Details</th>
                    <th scope="col" class="px-6 py-3">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b bg-gray-800 border-gray-700">
                    <?php
                    require '../php/include/db.php';

                    if (!isset($_SESSION['login_id'])) {
                        header("Location: ../login/");
                        die;
                    }

                    $stmt = $conn->prepare("SELECT auftrag.*, users.name as user_name, kunde.name as customer_name FROM auftrag JOIN users ON auftrag.u_id = users.u_id JOIN kunde ON auftrag.k_id = kunde.k_id WHERE (berechtigungen = :berechtigungen OR berechtigungen = 'Bereichsleiter' OR berechtigungen = 'Administator')  AND (berechtigungen = 'Administator' OR berechtigungen = 'Bereichsleiter' OR :berechtigungen = 'Mitarbeiter')");
                    $stmt->execute([
                        ':berechtigungen' => $_SESSION['login_b']
                    ]);
                    $all = $stmt->fetchAll();

                    if ($stmt->rowCount() > 0) {
                        foreach ($all as $row) {
                            echo "<tr class='bg-white border-b bg-gray-800 border-gray-700 text-center'>";
                            echo "<th scope='row' class='tx-6 py-4 font-medium dark:text-gray-900 whitespace-nowrap text-white'>" . $row['auftr_nr'] . "</th>";
                            echo "<td class='px-6 py-4'>" . $row['name'] . "</td>";
                            switch($row['tag_nr']){
                                case '1':
                                    echo "<td class='px-6 py-4'>" . "Reperatur" . "</td>";
                                    break;
                                case '2':
                                    echo "<td class='px-6 py-4'>" . "Sanitär" . "</td>";
                                    break;
                                case '3':
                                    echo "<td class='px-6 py-4'>" . "Garantie" . "</td>";
                                    break;
                                case '4':
                                    echo "<td class='px-6 py-4'>" . "Heizung" . "</td>";
                                    break;
                            }
                            switch($row['s_nr']){
                                case '1':
                                    echo "<td class='px-6 py-4'>" . "Backlog" . "</td>";
                                    break;
                                case '2':
                                    echo "<td class='px-6 py-4'>" . "Work in Progrss" . "</td>";
                                    break;
                                case '3':
                                    echo "<td class='px-6 py-4'>" . "Done" . "</td>";
                                    break;
                            }
                            echo "<td class='px-6 py-4'>" . $row['date'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['desired_date'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['user_name'] . "</td>";
                            echo "<td class='px-6 py-4'>" . $row['customer_name'] . "</td>";
                            echo "<td class='px-6 py-4'>" . "<a href='details/?a_nr=" . $row['auftr_nr'] . "' class='font-medium text-blue-600 dark:text-blue-400 hover:underline'>Details</a>" . "</td>";
                            echo "<td class='px-6 py-4'>" . "<a href='?del_nr=" . $row['auftr_nr'] . "' class='font-medium text-red-600 dark:text-blue-400 hover:underline'>Delete</a>" . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<td class='bg-white border-b bg-gray-800 border-gray-700 px-6 py-4' colspan='9'>Keine Aufträge vorhanden</td>";
                    }
                    ?>
                    <?php
                    if(isset($_GET['del_nr']) && !empty($_GET['del_nr'])) {
                        $stmt = $conn->prepare("DELETE FROM auftrag WHERE auftr_nr = :del_nr");
                        $stmt->execute([
                            ':del_nr' => strip_tags(htmlspecialchars($_GET['del_nr']))
                        ]);
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