<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inspector Details</title>
    @vite('resources/css/app.css')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-2xl my-10 font-bold">Add Inspector Details</h1>

    <div class="bg-white p-8 rounded-lg shadow-md mx-6 relative">
        @if ($errors->any())
        <div class="mt-4 p-3 bg-red-100 text-red-600 rounded">
            @error('error') {{$message}} @enderror
        </div>
        @endif
        <span class="absolute top-0 right-0 mt-2 mr-4"><a class="text-blue-700 underline font-semibold text-sm hover:text-blue-800" href="#">Check if exists</a></span>

        <!-- Importing the arrays from 'app/Custom Data/dropdownOptions.php' -->
        @php
        $options = include(app_path('Custom Data/dropdownOptions.php'));
        @endphp

        <form method="POST" action="{{ route('addInspector') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- userid -->
                <div>
                    <label for="userid" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Login-ID:</label>
                    <input type="text" id="userid" name="userid" tabindex="1" placeholder="User ID" required value="{{ old('userid') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div id="error-message-username" class="text-sm text-red-600">
                        @error('userid') {{$message}} @enderror
                    </div>
                </div>

                <!-- name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Name:</label>
                    <input type="text" id="name" name="name" tabindex="2" required value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('name') {{$message}} @enderror</div>
                </div>

                <!-- gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Gender:</label>
                    <select id="gender" name="gender" tabindex="3" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    <div class="text-sm text-red-600">@error('gender') {{$message}} @enderror</div>
                </div>

                <!-- dob -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Date of Birth:</label>
                    <input type="date" id="dob" name="dob" tabindex="4" required value="{{ old('dob') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('dob') {{$message}} @enderror</div>
                </div>

                <!-- nationality -->
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Nationality:</label>
                    <select id="nationality" name="nationality" tabindex="5" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        @foreach ($options['nationalities'] as $key => $value)
                        <option value="{{ $value }}" {{ old('nationality') == $value ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="text-sm text-red-600">@error('nationality') {{$message}} @enderror</div>
                </div>

                <!-- place of birth -->
                <div>
                    <label for="placeofbirth" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Place of Birth:</label>
                    <select id="placeofbirth" name="placeofbirth" tabindex="6" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="city1" {{ old('placeofbirth') == 'city1' ? 'selected' : '' }}>City 1</option>
                        <option value="city2" {{ old('placeofbirth') == 'city2' ? 'selected' : '' }}>City 2</option>
                        <option value="city3" {{ old('placeofbirth') == 'city3' ? 'selected' : '' }}>City 3</option>
                    </select>
                    <div class="text-sm text-red-600">@error('placeofbirth') {{$message}} @enderror</div>
                </div>

                <!-- passport number -->
                <div>
                    <label for="passport" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Passport Number:</label>
                    <input type="text" id="passport" name="passport" tabindex="7" placeholder="e.g., A1234567" maxlength="9" required value="{{ old('passport') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('passport') {{$message}} @enderror</div>
                </div>

                <!-- unlp number -->
                <div>
                    <label for="unlp" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>UNLP Number:</label>
                    <input type="text" id="unlp" name="unlp" tabindex="8" placeholder="e.g., AB1234567" maxlength="9" required value="{{ old('unlp') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('unlp') {{$message}} @enderror</div>
                </div>

                <!-- rank -->
                <div>
                    <label for="rank" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Rank:</label>
                    <select id="rank" name="rank" tabindex="9" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        @foreach ($options['rank'] as $key => $value)
                        <option value="{{ $value }}" {{ old('rank') == $value ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="text-sm text-red-600">@error('rank') {{$message}} @enderror</div>
                </div>

                <!-- qualification -->
                <div>
                    <label for="qualification" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Qualification:</label>
                    <input type="text" id="qualification" name="qualification" tabindex="10" required value="{{ old('qualification') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('qualification') {{$message}} @enderror</div>
                </div>

                <!-- experience -->
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Professional Experience:</label>
                    <input type="text" id="experience" name="experience" tabindex="11" required value="{{ old('experience') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('experience') {{$message}} @enderror</div>
                </div>

                <!-- clearance certificate -->
                <div>
                    <label for="clearance" class="block text-sm font-medium text-gray-700">Clearance Certificate:</label>
                    <input type="file" id="clearance" name="clearance" tabindex="12" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="text-sm text-red-600">@error('clearance') {{$message}} @enderror</div>
                </div>

                <!-- remarks -->
                <div class="md:col-span-2">
                    <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks (if any):</label>
                    <textarea id="remarks" name="remarks" rows="4" tabindex="14" value="{{ old('remarks') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    <div class="text-sm text-red-600">@error('remarks') {{$message}} @enderror</div>
                </div>
            </div>

            <!-- captcha -->
            <div class="mt-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ route('captcha') }}" id='captchaimg' style="border: 1px solid #000;" class="w-40 h-20">
                    <i class="fas fa-sync cursor-pointer" onclick="refreshCaptcha()"></i>
                </div>
                <div class="flex items-center space-x-3 mt-3">
                    <input type="text" id="captcha_code" name="captcha_code" placeholder="Enter captcha code" maxlength="6" tabindex="15" class="block w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <small class="text-green-600">Captcha code is case sensitive</small>
                </div>
                <div class="text-sm text-red-600">@error('captcha_code') {{ $message }} @enderror</div>
            </div>

            <div class="mt-6">
                <button type="submit" tabindex="16" class="w-full py-2 px-4 rounded-md border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add
                </button>
            </div>
        </form>
    </div>

    <script>
        function refreshCaptcha() {
            var img = document.getElementById('captchaimg');
            var timestamp = new Date().getTime(); // get current timestamp
            img.src = img.src.split('?')[0] + '?' + timestamp;
        }
    </script>
</body>

</html>