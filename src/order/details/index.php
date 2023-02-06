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
    <link rel="icon" href="../../img/icon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="../../js/pdf.js"></script>
    <title>Auftragsdetails</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">

<div id="pdf" class="w-1/2">
<?php
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../login/");
    die;
}

require '../../php/include/db.php';
$successful = 0;

if(isset($_GET['a_nr']) && !empty($_GET['a_nr'])) {
    $stmt = $conn->prepare("SELECT * FROM auftrag JOIN users ON auftrag.u_id = users.u_id WHERE (berechtigungen = :berechtigungen OR berechtigungen = 'Bereichsleiter' OR berechtigungen = 'Administator')  AND (berechtigungen = 'Administator' OR berechtigungen = 'Bereichsleiter' OR :berechtigungen = 'Mitarbeiter')");
    $stmt->execute([
        ':berechtigungen' => $_SESSION['login_b']
    ]);
    $row_auftrag = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM kunde WHERE k_id = :k_id");
    $stmt->execute([
        ':k_id' => $row_auftrag['k_id']
    ]);
    $row_kunde = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM users WHERE u_id = :u_id");
    $stmt->execute([
        ':u_id' => $row_auftrag['u_id']
    ]);
    $row_user = $stmt->fetch();

    $successful = 1;
}
?>
    <div class="bg-gray-800 rounded-lg py-8 px-10">
        <div class="flex flex-1 mx-auto items-center text-gray-400">
            <?php
            if($successful == 1) {
                echo "<h2 class='w-full mx-auto text-xl font-bold py-4 text-white'>Auftragsdetails:<span class='block mt-2 mb-2 text-base font-medium'>" . $row_auftrag['auftr_name'] . "</span></h2>";
                echo "<button onclick='generatePDF()' class='w-24 text-white text-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-3 mb-2'>PDF</button>";
            }
            ?>
        </div>
        <div class="flex w-full grid-cols-2 gap-16 text-gray-400">
            <div class="col-span-1 w-1/2 text-gray-400">
                <div>
                    <h2 class="text-lg font-medium italic mt-4 ">Kundeninformationen</h2>
                    <div class="gap-4 mb-4 text-gray-400 mt-2 ">
                        <p>
                            <?php
                            if($successful == 1) {
                                echo "<textarea disabled name='verrechnungsinformationen' id='details'  style='resize: none;' rows='5' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500' placeholder='Weitere Informationen, Wünsche, etc.'>" . $row_kunde['anrede'] . " " . $row_kunde['name'] . "&#13;&#10;" . $row_kunde['adresse'] . "&#13;&#10;" . $row_kunde['plz']  .", ". $row_kunde['ort'] . "&#13;&#10;&#13;&#10;" .  "Telefon: ". $row_kunde['tel'] . "&#13;&#10;" . "Natel: " . $row_kunde['phone'] . "</textarea>";
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-medium italic mt-4 text-gray-400">Verrechnungsinformationen</h2>
                    <div class="text-base text-gray-400 mt-2">
                        <?php
                        if($successful == 1) {
                            echo "<textarea disabled name='verrechnungsinformationen' id='details'  style='resize: none;' rows='2' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500' placeholder='Weitere Informationen, Wünsche, etc.'>" . $row_auftrag['anrede'] . " " . $row_auftrag['name'] . "&#13;&#10;" . $row_auftrag['adresse'] . "&#13;&#10;" . $row_auftrag['plz']  .", ". $row_auftrag['ort'] ."</textarea>";
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-medium italic mt-4 text-gray-400">Verantwortlicher Mitarbeiter</h2>
                    <div class="gap-4 mb-4 text-gray-400 mt-2">
                        <p>
                            <?php
                            if($successful == 1) {
                                echo "<p id='details' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500' placeholder='Weitere Informationen, Wünsche, etc.'>" . $row_user['anrede'] . " " . $row_user['name'] . " (" .  $row_user['berechtigungen'] . ")" . "</p>";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-gray-400 col-span-2 w-1/2">
                <div>
                    <h2 class="mt-10 text-lg font-medium italic text-gray-400">Auftragsinformationen</h2>
                    <div>
                        <?php
                        if($successful == 1) {
                            echo "<label for='service' class='block mt-2 mb-2 text-base font-medium'>Details</label> ";
                            echo "<textarea disabled='details' id='details'  style='resize: none; rows=4' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2 leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500' placeholder='Weitere Informationen, Wünsche, etc.'>" . $row_auftrag['details'] . "</textarea>";
                        }
                        ?>
                    </div>
                    <div class="mt-4 text-gray-400">
                        <?php
                        if($successful == 1) {
                            echo "<label for='service' class='block mt-2 mb-2 text-base font-medium'>Auftragseingang</label> ";
                            echo "<p class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2  leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500'>" . $row_auftrag['date'] .  "</p>";
                            echo "<label for='service' class='block mt-2 mb-2 text-base font-medium'>Terminwunsch</label> ";
                            echo "<p class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 outline-none appearance-none border border-transparent rounded w-full p-2  leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500'>" . $row_auftrag['desired_date'] .  "</p>";
                           }
                        ?>
                    </div>
                    <div>
                        <label for="service" class="block mt-2 mb-2 text-base font-medium">Auszuführende Arbeiten</label>
                        <?php
                        if($successful == 1) {
                            switch($row_auftrag['tag_nr']){
                                case '1':
                                    echo "<p class='italic'>" . "Reperatur" . "</p>";
                                    break;
                                case '2':
                                    echo "<p class='italic'>" . "Sanitär" . "</p>";
                                    break;
                                case '3':
                                    echo "<p class='italic'>" . "Garantie" . "</p>";
                                    break;
                                case '4':
                                    echo "<p class='italic'>" . "Heizung" . "</p>";
                                    break;
                            }
                            ?>
                            <label for="service" class="block mt-2 mb-2 text-base font-medium">Ausführungsstatus</label>
                            <?php
                            echo "<ul>";
                            switch($row_auftrag['s_nr']){
                                case '1':
                                    echo "<p class='italic'>" . "Backlog" . "</p>";
                                    break;
                                case '2':
                                    echo "<p class='italic'>" . "In arbeit" . "</p>";
                                    break;
                                case '3':
                                    echo "<p class='italic'>" . "Done" . "</p>";
                                    break;
                            }
                            echo "</ul>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-auto w-2/3 items-center">
        <button onclick="location.href='../'" type="button" class="w-32 mt-5 text-white text-center bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2">Abbrechen</button>
        <button onclick="location.href='../edit' + window.location.search" name="edit_order" class="w-80 text-white text-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm mt-5 px-5 py-3 mb-2">Bearbeiten</button>
    </div>
</div>
</body>
</html>