<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Mitarbeiterübersicht</title>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="w-full">
        <div class="flex flex-1 w-2/3 mx-auto items-center">
            <h1 class="w-full mx-auto uppercase text-4xl font-bold py-4 text-white">Mitarbeiterübersicht</h1>
            <button type="button" class="w-96 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Neuer Mitarbeiter 
            </button>
        </div>
        <table class="w-2/3 mx-auto text-sm text-left text-gray-500 text-gray-400">
            <thead class="text-xs dark:text-gray-700 uppercase dark:bg-gray-50 bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Anrede</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Benutzername</th>
                    <th scope="col" class="px-6 py-3">Tel.</th>
                    <th scope="col" class="px-6 py-3">Natel</th>
                    <th scope="col" class="px-6 py-3">Strasse</th>
                    <th scope="col" class="px-6 py-3">Ort</th>
                    <th scope="col" class="px-6 py-3">PLZ</th>
                    <!--<th scope="col" class="px-6 py-3">
                      <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Bearbeiten</a>
                    </th>-->
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b bg-gray-800 border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium dark:text-gray-900 whitespace-nowrap text-white">
                        1
                    </th>
                    <td class="px-6 py-4">Herr</td>
                    <td class="px-6 py-4">Max Mustermann</td>
                    <td class="px-6 py-4">MMustermann</td>
                    <td class="px-6 py-4">078 213 14 11</td>
                    <td class="px-6 py-4">071 234 65 23</td>
                    <td class="px-6 py-4">Musterstrasse 4</td>
                    <td class="px-6 py-4">Musterort</td>
                    <td class="px-6 py-4">1432</td>
                    <!--<td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</a>
                    </td>-->
                </tr>
            </tbody>
        </table>
        <div class="flex flex-1 w-2/3 mx-auto items-center">
            <button type="button" class="w-32 mt-5 text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                Zurück 
            </button>
        </div>
    </div>
</body>
</html>