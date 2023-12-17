<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<form action="controllers/UserRegister.php" method="post">
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
            class="bg-green-500 absolute inset-0 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">

            <div class="max-w-md mx-auto">
                <div>
                    <p class="text-red-400">
                        <?php
                        session_start();
                        if (isset($_SESSION['register'])) {
                            echo $_SESSION['register'];
                            session_destroy();
                        }
                        ?>
                    </p>
                    <h1 class="text-2xl font-semibold">Register</h1>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <div class="relative">
                            <input required autocomplete="off" name="username" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                            <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                Username
                            </label>
                        </div>
                        <div class="relative">
                            <input required autocomplete="off" name="email" type="email" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                            <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                Email Address
                            </label>
                        </div>
                        <div class="relative">
                            <input required autocomplete="off" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                            <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                Password
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-center">
                <button name="submit" class="bg-green-500 flex items-center border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <span class="text-white">SUBMIT</span>
                </button>
            </div>
            <p class="mt-6" style="font-size: 12px;">Already have an Account ? <a href="login.php"><span class="text-green-500 hover:opacity-70">Log In</span></a></p>
        </div>
    </div>
</div>
</form>
</body>
</html>