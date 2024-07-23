<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-8">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="userid" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="userid" id="userid" placeholder="Email" value="{{ $userid }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('userid') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
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
</body>

</html>