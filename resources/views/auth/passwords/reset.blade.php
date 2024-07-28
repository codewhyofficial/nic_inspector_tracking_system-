<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
    <!-- cryptojs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-8">Reset Password</h2>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6" onsubmit="return hashPasswords()">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input readonly type="email" name="email" id="email" placeholder="Email" value="{{ $email }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('email') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">New Password:</label>
                <input type="password" name="password" id="password" placeholder="New Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('password') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('password_confirmation') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Reset Password
                </button>
            </div>
        </form>
    </div>

    <script>
        function hashPasswords() {
            var password = document.getElementById('password').value;
            var passwordConfirm = document.getElementById('password_confirmation').value;

            // Hash the password values using SHA-256
            var hashedPassword = CryptoJS.SHA256(password).toString();
            var hashedPasswordConfirm = CryptoJS.SHA256(passwordConfirm).toString();

            document.getElementById('password').value = hashedPassword;
            document.getElementById('password_confirmation').value = hashedPasswordConfirm;
            return true;
        }
    </script>
</body>

</html>