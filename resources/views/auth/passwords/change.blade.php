<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    @vite('resources/css/app.css')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- cryptojs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-indigo-900 text-white text-center py-4 px-6">
                    <h2 class="text-lg font-semibold">Change Password</h2>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('password.change') }}" onsubmit="return hashPassword()">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password:</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="New Password" tabindex="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <span id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                    <i id="password-icon" class="fa fa-eye-slash text-gray-500"></i>
                                </span>
                            </div>
                            <div id="error-message-password" class="text-sm text-red-600 mt-2">
                                @error('password') {{$message}} @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                            <div class="relative">
                                <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" tabindex="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <span id="toggle-password-confirm" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                    <i id="password-icon-confirm" class="fa fa-eye-slash text-gray-500"></i>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-2 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-300">
                                Change Password
                            </button>
                            <a href="{{ route('password.skip') }}" class=" text-blue-800 font-semibold">
                                Skip
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function hashPassword() {
            var password = document.getElementById('password');
            var passwordConfirm = document.getElementById('password-confirm');
            var hashedPassword = CryptoJS.SHA256(password.value).toString();
            console.log("hashed password: ", hashedPassword)
            password.value = hashedPassword;
            passwordConfirm.value = hashedPassword;
            return true; // continue with form submission
        }

        function togglePassword(id, iconId) {
            const passwordField = document.getElementById(id);
            const passwordIcon = document.getElementById(iconId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        }

        document.getElementById('toggle-password').addEventListener('click', function() {
            togglePassword('password', 'password-icon');
        });

        document.getElementById('toggle-password-confirm').addEventListener('click', function() {
            togglePassword('password-confirm', 'password-icon-confirm');
        });
    </script>
</body>

</html>