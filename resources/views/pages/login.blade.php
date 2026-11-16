<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="shadow max-w-80 p-6 mx-auto mt-50 rounded-xl">
        <div>
            <h1 class="text-2xl flex justify-center">LOGIN</h1>
        </div>

        <div class="mt-10 flex flex-col gap-5">
            <form action="/login" method="POST">
                @csrf

                <div class="flex flex-col">
                    <label for="email" class="mb-2">Email</label>
                    <input type="email" id="email" name="email" class="bg-gray-100 p-2 rounded-xl" required>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-100 p-2 rounded-xl" required>
                </div>
                <div class="mt-5">
                    <button type="submit"
                        class="bg-blue-500 text-white px-3 py-1 rounded-full active:scale-95 duration-100 cursor-pointer">Masuk</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
