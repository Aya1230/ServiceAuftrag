<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="icon" href="../../img/icon.ico">
    <script src="../../js/datetime.js"></script>
    <title>Neuen Auftrag erfassen</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <form action="#" class="w-2/3">
        <div class="bg-gray-800 rounded-lg py-8 px-10">
            <h2 class="text-2xl font-bold dark:text-gray-900 text-white">Neuen Auftrag hinzufügen.</h2>
                <div class="flex w-full grid-cols-2 gap-16">
                    <div class="col-span-1 w-1/2">
                        <h2 class="py-5 text-lg font-medium italic text-gray-400 text-white">Allgemeine Informationen</h2>
                        <div>
                            <label for="date" class="block text-sm mb-2 font-medium text-gray-300">Auftragseingang</label>
                            <input required type="datetime-local" id="date" name="auftragseingang" style="color-scheme: dark;" id="date" class="bg-gray-900 text-gray-400 text-sm rounded-lg block w-full px-4 py-3">
                        </div>
                        <div>
                        <label for="kunde" class="block mt-2 mb-2 text-sm font-medium text-gray-300">Kunde</label>
                        <select required name="kunde" id="kunde" class="text-gray-400 text-sm rounded-lg block w-full p-3 bg-gray-900">
                            <option>Kunde 1</option>
                            <option>Kunde 2</option>
                            <option>Kunde 3</option>
                        </select>
                        </div>
                        <div class="text-sm text-gray-400 mt-4">
                            <div class="bg-gray-900 rounded-lg px-4 py-5"> 
                            <h2 class="text-sm font-medium italic text-gray-300 mb-1">Kundeninformationen</h2>
                                <p>Herr</p>
                                <p>Max Mustermann</p>
                                <p>Musterstrasse 11</p>
                                <p>1111, Musterort</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="service" class="block mb-2 text-sm font-medium text-gray-300">Auszuführende Arbeiten</label>
                            <div class="flex">
                                <div class="flex items-center mr-4">
                                    <input name="reparatur" id="reparatur-checkbox" type="checkbox" value="reparatur" class="w-4 h-4 text-blue-600 rounded">
                                    <label for="reparatur-checkbox" class="ml-2 text-sm text-gray-400">Reparatur</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input name="sanitaer" id="sanitaer-checkbox" type="checkbox" value="sanitaer" class="w-4 h-4 text-blue-600 rounded">
                                    <label for="sanitaer-checkbox" class="ml-2 text-sm text-gray-400">Sanitär</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input name="heizung" id="heizung-checkbox" type="checkbox" value="heizung" class="w-4 h-4 text-blue-600 rounded">
                                    <label for="heizung-checkbox" class="ml-2 text-sm text-gray-400">Heizung</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input name="garantie" id="garantie-checkbox" type="checkbox" value="garantie" class="w-4 h-4 text-blue-600 rounded">
                                    <label for="garantie-checkbox" class="ml-2 text-sm text-gray-400">Garantie</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 w-1/2">
                        <h2 class="py-5 text-lg font-medium italic text-gray-400 text-white">Verrechnungsinfomationen</h2>
                        <div class="grid-cols-5 gap-5 flex">
                            <div class="col-span-2">
                            <label for="anrede" class="block mb-2 text-sm font-medium text-gray-300">Anrede</label>
                                <select required name="anrede" id="anrede" class="text-gray-400 text-sm rounded-lg block w-full p-3 bg-gray-900">
                                    <option>Herr</option>
                                    <option>Frau</option>
                                </select>
                            </div>
                            <div class="col-span-3 flex-1">
                                <label for="name" class="block text-sm mb-2 font-medium text-gray-300">Name</label>
                                <input required type="text" name="name" id="name" class="block px-4 py-3 w-full text-sm text-gray-400 bg-gray-900 rounded-lg mb-2" placeholder="Name...">
                            </div>
                        </div>
                        <label for="strasse" class="block text-sm mb-2 font-medium text-gray-300">Strasse</label>
                        <input required type="text" name="strasse" id="strasse" class="block px-4 py-3 w-full text-sm text-gray-400 bg-gray-900 rounded-lg mb-2" placeholder="Strasse...">
                        <div>
                        <div class="grid-cols-5 gap-5 flex">
                            <div class="col-span-4 flex-1">
                                <label for="ort" class="block text-sm mb-2 font-medium text-gray-300">Ort</label>
                                <input required type="text" name="ort" id="ort" class="block px-4 py-3 w-full text-sm text-gray-400 bg-gray-900 rounded-lg mb-2" placeholder="Ort...">
                            </div>
                            <div class="col-span-1">
                                <label for="plz" class="block text-sm mb-2 font-medium text-gray-300">Postleitzahl</label>
                                <input required type="number" name="plz" id="plz" min="1000" max="9999" class="block px-4 py-3 w-full text-sm text-gray-400 bg-gray-900 rounded-lg mb-2" placeholder="Postleitzahl...">
                            </div>
                        </div>
                        </div>
                        <label for="termin" class="block text-sm mb-2 font-medium text-gray-300">Terminwunsch</label>
                            <input required type="datetime-local" id="termin" name="auftragseingang" style="color-scheme: dark;"  class="bg-gray-900 text-gray-400 text-sm rounded-lg block w-full px-4 py-3">
                        <label for="details" class="block mb-2 text-sm font-medium text-gray-300">Details</label>
                            <textarea name="details" id="details" style="resize: none;" rows="4" class="block px-4 py-3 w-full text-sm text-gray-400 bg-gray-900 rounded-lg" placeholder="Weitere Informationen, Wünsche, etc."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto w-2/3 items-center">
            <button onclick="location.href='../../../../../../index.php'" type="button" class="w-32 mt-5 text-white text-center bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2">Abbrechen</button>
            <input type="submit" name="create_order" value="Hinzufügen" class="w-80 text-white text-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm mt-5 px-5 py-3 mb-2"></input>
        </div>
    </form>
</body>
</html>