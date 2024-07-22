<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-8">Reset Password</h2>
        
        <!-- Request OTP Form -->
        <form id="request-otp-form" class="space-y-6" style="display: block;">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Request OTP
                </button>
            </div>
        </form>

        <!-- Reset Password Form -->
        <form id="reset-password-form" class="space-y-6" style="display: none;">
            @csrf
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700">OTP:</label>
                <input type="text" id="otp" name="otp" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="new-password" class="block text-sm font-medium text-gray-700">New Password:</label>
                <input type="password" id="new-password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                <input type="password" id="password-confirm" name="password_confirmation" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Reset Password
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('request-otp-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add AJAX call to request OTP
            // On success, hide request-otp-form and show reset-password-form
        });

        document.getElementById('reset-password-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add AJAX call to reset password
            // On success, show success message and redirect to login page
        });
    </script>
</body>
</html>