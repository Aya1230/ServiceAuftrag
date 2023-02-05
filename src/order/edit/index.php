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
    <script src="../../js/checkbox.js"></script>
    <script src="../../js/select.js"></script>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
        }
    </style>
    <title>Auftrag erfassen</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
<?php

if (!isset($_SESSION['login_id']) && $_SESSION['login_b'] == "Mitarbeiter"){
    header("Location: ../../login/");
    die;
}

if (isset($_POST["create_order"])) {
    function error(string $error): void
    {
        switch ($error) {
            case "updateTask":
                echo "<script>alert('Auftrag wurde erfolgreich bearbeitet');window.location.replace('../');</script>";
                break;
        }
    }

    require '../../php/include/db.php';

    $stmt = $conn->prepare("UPDATE auftrag SET auftr_name=:auftr_name, details=:details, tag_nr=:tag_nr, s_nr=:s_nr, desired_date=:desired_date, anrede=:anrede, name=:name, adresse=:adresse, plz=:plz, ort=:ort, k_id=:k_id, u_id=:u_id WHERE auftr_nr=:a_nr");
    $stmt->execute([
        ':auftr_name' => strip_tags(htmlspecialchars($_POST['auftragsname'])),
        ':details' => strip_tags(htmlspecialchars($_POST['details'])),
        ':tag_nr' => $_POST['tag'],
        ':s_nr' => $_POST['status'],
        ':desired_date' => $_POST['wunschtermin'],
        ':anrede' => $_POST['anrede'],
        ':name' => strip_tags(htmlspecialchars($_POST['name'])),
        ':adresse' => strip_tags(htmlspecialchars($_POST['strasse'])),
        ':plz' => strip_tags(htmlspecialchars($_POST['plz'])),
        ':ort' => strip_tags(htmlspecialchars($_POST['ort'])),
        ':k_id' => $_POST['kunde'],
        ':u_id' => $_POST['user'],
        ':a_nr' => strip_tags(htmlspecialchars($_GET['a_nr'])),
    ]);
    error("updateTask");

}
?>
<?php
require '../../php/include/db.php';


$stmt = $conn->prepare("SELECT * FROM kunde");
$stmt->execute();
$kunde_tb = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$mitarbeiter_tb = $stmt->fetchAll();

if(isset($_GET['a_nr']) && !empty($_GET['a_nr'])) {
    $stmt = $conn->prepare("SELECT * FROM auftrag WHERE auftr_nr = :a_nr");
    $stmt->execute([
        ':a_nr' => strip_tags(htmlspecialchars($_GET['a_nr'])),
    ]);
    $row_auftrag = $stmt->fetch();
}
?>

<form action="" method="post" onsubmit="return validateForm()" class="w-2/3">
    <div class="bg-gray-800 rounded-lg py-8 px-10">
        <h2 class="text-2xl font-bold dark:text-gray-900 text-white">Auftrag bearbeiten</h2>
        <div class="flex w-full grid-cols-2 gap-16">
            <div class="col-span-1 w-1/2">
                <h2 class="py-5 text-lg font-medium italic text-gray-400 text-white">Allgemeine Informationen</h2>
                <div>
                    <label for="date" class="block text-sm mb-2 font-medium text-gray-300">Auftragseingang</label>
                    <input disabled required type="datetime-local"  name="date" style="color-scheme: dark;" id="date" class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-gray-500 outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" value="<?php echo !empty($row_auftrag['date']) ? $row_auftrag['date'] : ''; ?>">
                </div>
                <div class="col-span-3 flex-1">
                    <label for="auftragsname" class="block pt-2 text-sm mb-2 font-medium text-gray-300">Auftragsname</label>
                    <input required type="text" name="auftragsname" id="auftragsname"  class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" placeholder="Name..." value="<?php echo !empty($row_auftrag['auftr_name']) ? $row_auftrag['auftr_name'] : ''; ?>">
                </div>
                <div>
                    <label for="details" class="block pt-2 mb-2 text-sm font-medium text-gray-300">Details</label>
                    <textarea name="details" id="details" style="resize: none;" rows="4"  class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" placeholder="Weitere Informationen, Wünsche, etc."></textarea>
                </div>
                <div class="mt-2">
                    <label for="service" class="block pt-2 mb-2 text-sm font-medium text-gray-300">Auszuführende Arbeiten</label>
                    <div class="flex">
                        <div class="flex items-center mr-4">
                            <input name="tag" id="tag" type="checkbox" value="1"  class="w-4 h-4 text-blue-600 rounded">
                            <label for="reparatur-checkbox" class="ml-2 text-sm text-gray-400">Reparatur</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input name="tag" id="tag" type="checkbox" value="2"  class="w-4 h-4 text-blue-600 rounded" >
                            <label for="sanitaer-checkbox" class="ml-2 text-sm text-gray-400">Sanitär</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input name="tag" id="tag" type="checkbox" value="3"  class="w-4 h-4 text-blue-600 rounded">
                            <label for="garantie-checkbox" class="ml-2 text-sm text-gray-400">Garantie</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input name="tag" id="tag" type="checkbox" value="4"  class="w-4 h-4 text-blue-600 rounded" >
                            <label for="heizung-checkbox" class="ml-2 text-sm text-gray-400">Heizung</label>
                        </div>
                    </div>
                    <label for="service" class="block mb-2 pt-2 text-sm font-medium text-gray-300">Status</label>
                    <div class="flex">
                        <div class="flex items-center mr-4">
                            <input checked name="status" id="status" type="radio" value="1"  class="w-4 h-4 text-blue-600 rounded">
                            <label for="backlog-radio" class="ml-2 text-sm text-gray-400">Backlog</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input name="status" id="status" type="radio" value="2"  class="w-4 h-4 text-blue-600 rounded" >
                            <label for="wip-radio" class="ml-2 text-sm text-gray-400">in Arbeit</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input name="status" id="status" type="radio" value="3"  class="w-4 h-4 text-blue-600 rounded">
                            <label for="done-radio" class="ml-2 text-sm text-gray-400">Done</label>
                        </div>
                    </div>
                    <div>
                        <label for="termin" class="block pt-2 text-sm mb-2 font-medium text-gray-300">Terminwunsch</label>
                        <input required type="date" id="termin" name="wunschtermin" style="color-scheme: dark;"   class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-gray-500 outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" value="<?php echo !empty($row_auftrag['desired_date']) ? $row_auftrag['desired_date'] : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="col-span-1 w-1/2">
                <h2 class="py-5 text-lg font-medium italic text-gray-400 text-white">Verrechnungsinfomationen</h2>
                <div class="grid-cols-5 gap-5 flex">
                    <div class="col-span-2">
                        <label for="anrede" class="block mb-2 text-sm font-medium text-gray-300">Anrede</label>
                        <select required name="anrede"  id="anrede" class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-gray-500 border border-transparent rounded w-full p-2  text-white leading-normal  focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white">
                            <option selected>Herr</option>
                            <option>Frau</option>
                        </select>
                    </div>
                    <div class="col-span-3 flex-1">
                        <label for="name" class="block text-sm mb-2 font-medium text-gray-300">Name</label>
                        <input required type="text" name="name" id="name"  class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" placeholder="Name..." value="<?php echo !empty($row_auftrag['name']) ? $row_auftrag['name'] : ''; ?>">
                    </div>
                </div>
                <label for="strasse" class="block pt-2 text-sm mb-2 font-medium text-gray-300">Strasse</label>
                <input required type="text" name="strasse" id="strasse"  class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" placeholder="Strasse..." value="<?php echo !empty($row_auftrag['adresse']) ? $row_auftrag['adresse'] : ''; ?>">
                <div>
                    <div class="grid-cols-5 gap-5 flex">
                        <div class="col-span-4 flex-1">
                            <label for="ort" class="block pt-2 text-sm mb-2 font-medium text-gray-300">Ort</label>
                            <input required type="text" name="ort" id="ort"  class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" placeholder="Ort..." value="<?php echo !empty($row_auftrag['ort']) ? $row_auftrag['ort'] : ''; ?>">
                        </div>
                        <div class="col-span-1">
                            <label for="plz" class="block pt-2 text-sm mb-2 font-medium text-gray-300">Postleitzahl</label>
                            <input required type="number" name="plz" id="plz" min="1000" max="9999"  class="border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white" placeholder="Postleitzahl..." value="<?php echo !empty($row_auftrag['plz']) ? $row_auftrag['plz'] : ''; ?>">
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="py-5 text-lg font-medium italic text-gray-400 text-white">Kundeninformationen</h2>
                    <label for="kunde" class="block mt-2 mb-2 text-sm font-medium text-gray-300">Kunde</label>
                    <?php


                    if ($kunde_tb == true) {
                        echo "<select required name='kunde' id='kunde' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white'>";
                        foreach ($kunde_tb as $row) {
                            echo "<option value='" . $row['k_id'] . "'>" . $row['name'] . "</option>";
                        }
                        echo "</select>";

                    } else {
                        echo "<p name='kunde' id='kunde' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-gray-500 outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white'>Kein Kunde vorhanden</p>";
                    }

                    ?>
                </div>
                <div class="text-sm text-gray-400 mt-4">
                    <div class="bg-gray-900 rounded-lg px-4 py-5">
                        <h2 class="text-sm font-medium italic text-gray-300 mb-1">Kundeninformationen</h2>
                        <?php
                        if ($stmt->rowCount() > 0) {
                            if(!isset($_GET["k_id"]) && empty($_GET["k_id"])) {
                                echo "<p>" . $row['anrede'] . "</p>";
                                echo "<p>" . $row['name'] . "</p>";
                                echo "<p>" . $row['adresse'] . "</p>";
                                echo "<p>" . $row['plz'] . ", " . $row['ort'] . "</p>";
                            } else {
                                $stmt = $conn->prepare("SELECT * FROM kunde WHERE k_id = :k_id");
                                $stmt->execute([
                                    ':k_id' => strip_tags(htmlspecialchars($_GET['k_id']))
                                ]);
                                $kunde = $stmt->fetch();
                                echo "<p>" . $kunde['anrede'] . "</p>";
                                echo "<p>" . $kunde['name'] . "</p>";
                                echo "<p>" . $kunde['adresse'] . "</p>";
                                echo "<p>" . $kunde['plz'] . ", " . $row['ort'] . "</p>";
                            }
                        } else {
                            echo "<p>Keine Kundeninformationen vorhanden</p>";
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <h2 class="py-5 text-lg font-medium italic text-gray-400 text-white">Mitarbeiter</h2>
                    <label for="kunde" class="block mt-2 mb-2 text-sm font-medium text-gray-300">Zu Mitarbeiter zuweisen</label>
                    <?php
                    if ($mitarbeiter_tb == true) {
                        echo "<select required name='user' id='user' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-white outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white'>";
                        foreach ($mitarbeiter_tb as $row) {
                            echo "<option value='" . $row['u_id'] . "'>" . $row['name'] . "</option>";
                        }
                        echo "</select>";

                    } else {
                        echo "<p id='user' class='border-gray-200 bg-white text-sm placeholder-gray-500 shadow-sm border-gray-700 bg-gray-900 text-gray-500 outline-none appearance-none border border-transparent rounded w-full p-2  text-white leading-normal appearance-none focus:outline-none focus:bg-white focus:bg-gray-800 focus:border-gray-300 focus:border-gray-500 focus:text-white placeholder-white'>Kein Kunde vorhanden</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="flex-auto w-2/3 items-center">
        <button onclick="location.href='../'" type="button" class="w-32 mt-5 text-white text-center bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2">Abbrechen</button>
        <input type="submit" <?php if (!($stmt->rowCount() > 0)) echo "disabled"?> name="create_order" value="Hinzufügen" class="w-80 text-white text-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm mt-5 px-5 py-3 mb-2"></input>
    </div>
</form>
</body>
</html>