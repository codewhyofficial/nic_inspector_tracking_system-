<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inspector Details</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <h1 class="sm:text-xl md:text-2xl my-6 md:my-10 font-bold">Add Inspector Details</h1>

    <div class="bg-white p-8 rounded-lg shadow-md mx-6 relative">

        <span class="absolute top-0 right-0 mt-2 mr-4"><a class="text-blue-700 underline hover:text-blue-800" href="#">Check if exists</a></span>

        <!-- Importing the arrays from 'app/Custom Data/dropdownOptions.php' -->
        @php
        $options = include(app_path('Custom Data/dropdownOptions.php'));
        @endphp

        <form action="/submit" method="post" enctype="multipart/form-data" class="sm:grid sm:grid-cols-1 md:grid-cols-3 gap-4">

            <div class="mb-4">
                <label for="name" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Name:</label>
                <input type="text" id="name" name="name" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="gender" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Gender:</label>
                <select id="gender" name="gender" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="dob" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Date of Birth:</label>
                <input type="date" id="dob" name="dob" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="nationality" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Nationality:</label>
                <select name="Nationality" class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                    @foreach ($options['nationalities'] as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="placeofbirth" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Place of Birth:</label>
                <select id="placeofbirth" name="placeofbirth" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                    <option value="city1">City 1</option>
                    <option value="city2">City 2</option>
                    <option value="city3">City 3</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="passport" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Passport Number:</label>
                <input type="text" id="passport" name="passport" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="unlp" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>UNLP Number:</label>
                <input type="text" id="unlp" name="unlp" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="rank" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Rank:</label>
                <select id="rank" name="rank" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                    @foreach ($options['rank'] as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="qualification" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Qualification:</label>
                <input type="text" id="qualification" name="qualification" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="experience" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Professional Experience:</label>
                <input type="text" id="experience" name="experience" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="clearance" class="block mb-2 font-semibold">Clearance Certificate:</label>
                <input type="file" id="clearance" name="clearance" required class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4 col-span-2">
                <label for="remarks" class="block mb-2 font-semibold">Remarks:</label>
                <textarea id="remarks" name="remarks" rows="4" cols="50" class="w-full px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <div class="col-span-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add
                </button>
            </div>

        </form>
    </div>
</body>

</html>