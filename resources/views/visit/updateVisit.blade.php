<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspector Visit Form</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <h1 class="sm:text-xl md:text-2xl my-6 md:my-10 font-bold">Update Inspector Visit Details</h1>

    <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg mx-6">

        <!-- Importing the arrays from 'app/Custom Data/dropdownOptions.php' -->
        @php
        $options = include(app_path('Custom Data/dropdownOptions.php'));
        @endphp

        <form action="/submit" method="post" enctype="multipart/form-data" class="sm:grid sm:grid-cols-1 md:grid-cols-3 gap-4">

            <div class="mb-4">
                <label for="inspector" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Inspector:</label>
                <select id="inspector" name="inspector" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="purpose" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Purpose of Visit:</label>
                <input type="text" id="purpose" name="purpose" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="type" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Type of Inspection:</label>
                <select id="type" name="type" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                    @foreach ($options['inspection-category'] as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="site" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Site to be Inspected:</label>
                <input type="text" id="site" name="site" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="entry" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Point of Entry:</label>
                <input type="text" id="entry" name="entry" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="dob" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Date Time of Arrival:</label>
                <input type="date" id="dob" name="dob" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="inspectors" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>List of Inspectors:</label>
                <select id="inspectors" name="inspectors" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="teamlead" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Team Lead:</label>
                <select id="teamlead" name="teamlead" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Select</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="dob" class="block mb-2 font-semibold"><span class="text-red-600 text-xl">*</span>Date Time of Departure:</label>
                <input type="date" id="dob" name="dob" required class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4 col-span-3">
                <label for="remarks" class="block mb-2 font-semibold">Remarks:</label>
                <textarea id="remarks" name="remarks" rows="4" class="w-full font-semibold px-3 py-2 border-gray-200 border-2 rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <div class="col-span-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>

        </form>
    </div>

</body>

</html>