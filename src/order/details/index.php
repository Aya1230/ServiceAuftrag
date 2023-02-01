<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Auftragsdetails</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
<form action="#" class="w-1/2">
    <div class="bg-gray-800 rounded-lg py-8 px-10">
        <div class="flex flex-1 mx-auto items-center">
            <h2 class="w-full mx-auto text-xl font-bold py-4 text-white">Auftragsdetails.</h2>
            <button onclick="location.href=''" name="pdf" class="w-24 text-white text-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-3 mb-2">PDF</button>
        </div>
        <div class="flex w-full grid-cols-2 gap-16">
            <div class="col-span-1 w-1/2">
                <div class="grid-cols-4 gap-4 flex">
                    <p class="col-span-1 text-base font-medium text-gray-300">Auftragseingang:</p>
                    <p class="col-span-3 text-gray-400 text-base block w-full">01.02.2023 21:55</p>
                </div>
                <h2 class="text-lg font-medium italic text-gray-400 mt-4">Kundeninformationen</h2>
                <div class="text-base text-gray-400 mt-2">
                    <div>
                        <div class="gap-4 mb-4 text-gray-400">
                            <p>
                                Herr <br>
                                Max Mustermann <br>
                                Musterstrasse 11 <br>
                                1111 Musterort
                            </p>
                            <div class="grid-cols-2 gap-4 flex mt-2">
                                <div class="font-medium">
                                    <p>Telefon:</p>
                                    <p>Natel:</p>
                                </div>
                                <div>
                                    <p>079 213 84 20</p>
                                    <p>072 348 67 19</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-medium italic text-gray-400 mt-4">Verrechnungsinformationen</h2>
                    <div class="text-base text-gray-400 mt-2">
                        <p>Frau</p>
                        <p>Maria Musterfrau</p>
                        <p>Musterstrasse 22</p>
                        <p>2222 Musterort</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 w-1/2">
                <h2 class="mt-10 text-lg font-medium italic text-gray-400">Auftragsinformationen</h2>
                <label for="service" class="block mt-2 mb-2 text-base font-medium text-gray-300">Auszuführende Arbeiten</label>
                <div class="flex">
                    <div class="flex items-center mr-4">
                        <input checked name="reparatur" id="reparatur-checkbox" type="checkbox" value="reparatur" class="w-4 h-4 text-blue-600 rounded">
                        <label for="reparatur-checkbox" class="ml-2 text-base text-gray-400">Reparatur</label>                                </div>
                    <div class="flex items-center mr-4">
                        <input disabled name="sanitaer" id="sanitaer-checkbox" type="checkbox" value="sanitaer" class="w-4 h-4 text-blue-600 rounded">
                        <label for="sanitaer-checkbox" class="ml-2 text-base text-gray-400">Sanitär</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input disabled name="heizung" id="heizung-checkbox" type="checkbox" value="heizung" class="w-4 h-4 text-blue-600 rounded">
                        <label for="heizung-checkbox" class="ml-2 text-base text-gray-400">Heizung</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input checked name="garantie" id="garantie-checkbox" type="checkbox" value="garantie" class="w-4 h-4 text-blue-600 rounded">
                        <label for="garantie-checkbox" class="ml-2 text-base text-gray-400">Garantie</label>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="block text-base font-medium text-gray-300">Terminwunsch</p>
                    <p class="block w-full text-base text-gray-400">04.06.2023</p>
                    <p class="block mt-2 text-base font-medium text-gray-300">Details</p>
                    <p class="block w-full text-base text-gray-400">Weitere Informationen, Wünsche, etc.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="flex-auto w-2/3 items-center">
        <button onclick="location.href='../'" type="button" class="w-32 mt-5 text-white text-center bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2">Abbrechen</button>
        <button onclick="location.href=''" name="edit_order" class="w-80 text-white text-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm mt-5 px-5 py-3 mb-2">Bearbeiten</button>
    </div>
</form>
</body>
</html>