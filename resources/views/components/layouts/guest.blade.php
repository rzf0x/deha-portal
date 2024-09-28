<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-green-600 py-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div class="text-white text-2xl font-bold">Deha Portal</div>
            <nav class="space-x-4">
                <a href="#home" class="text-white hover:underline">Home</a>
                <a href="#about" class="text-white hover:underline">About</a>
                <a href="#contact" class="text-white hover:underline">Contact</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12 flex flex-col justify-center items-center">
        {{ $slot }}
    </main>

    <footer class="bg-green-600 py-4 text-center text-white">
        <p>&copy; 2024 Pondok Daarul Huffazh. All rights reserved.</p>
    </footer>

</body>
</html>
