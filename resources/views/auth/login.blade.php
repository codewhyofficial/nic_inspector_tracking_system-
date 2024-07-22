<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @vite('resources/css/app.css')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- cryptojs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-8" id="loginLabel">Login</h2>
        <form name="a" id="a" method="POST" action="{{ route('login') }}" onsubmit="return hashPassword()" autocomplete="off" class="space-y-6">

            @csrf

            <!-- user_id -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Login-ID:</label>
                <input type="text" name="userid" id="userid" placeholder="User ID" tabindex="1" value="{{ old('userid') }}" class=" mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <div id="error-message-username" class="text-sm text-red-600">
                    @error('userid') {{$message}} @enderror
                </div>
            </div>

            <!-- password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Password" tabindex="2" class=" mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <span id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                        <i id="password-icon" class="fa fa-eye-slash text-gray-500"></i>
                    </span>
                </div>
                <div id="error-message-password" class="text-sm text-red-600">
                    @error('password') {{$message}} @enderror
                </div>
            </div>

            <!-- captcha -->
            <div>
                <label for="captcha_code" class="block text-sm font-medium text-gray-700">Captcha Code:</label>
                <div class="flex items-center space-x-3">
                    <input type="text" id="captcha_code" name="captcha_code" placeholder="Enter captcha code" maxlength="6" tabindex="3" class=" mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <img src="{{ route('captcha') }}" id='captchaimg' style="border: 1px solid #000;">
                    <div>
                        <i class="fas fa-sync cursor-pointer" onclick="refreshCaptcha()"></i>
                    </div>
                </div>
                <small class="text-green-600">Captcha code is case sensitive</small>
                <div class="text-sm text-red-600">@error('captcha_code') {{ $message }} @enderror</div>
            </div>

            <div>
                <button type="submit" name="login" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Log In
                </button>
            </div>

            <!-- Forgot Password Link -->
            <div class="text-center mt-4">
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-800">
                    Forgot Your Password?
                </a>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        })

        function refreshCaptcha() {
            var img = document.getElementById('captchaimg');
            var timestamp = new Date().getTime(); // get current timestamp
            img.src = img.src.split('?')[0] + '?' + timestamp;
        }

        function hashPassword() {
            var password = document.getElementById('password');
            var hashedPassword = CryptoJS.SHA256(password.value).toString();
            console.log("hashed password: ", hashedPassword)
            password.value = hashedPassword;
            return true; // continue with form submission
        }
    </script>
</body>

</html>
