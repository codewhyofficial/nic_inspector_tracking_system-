<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspector Visit Form</title>
    @vite('resources/css/app.css')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <h1 class="sm:text-xl md:text-2xl my-6 md:my-10 font-bold">Inspector Visit Details</h1>

    <div class="bg-white p-8 rounded-lg shadow-md mx-6 relative">
        @if ($errors->any())
        <div class="mt-4 p-3 bg-red-100 text-red-600 rounded">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <!-- Importing the arrays from 'app/Custom Data/dropdownOptions.php' -->
        @php
        $options = include(app_path('Custom Data/dropdownOptions.php'));
        @endphp

        <form action="/submit" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf

            <div class="mb-4">
                <label for="inspector" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Inspector:</label>
                <select id="inspector" name="inspector" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select</option>
                </select>
                <div class="text-sm text-red-600">@error('inspector') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="purpose" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Purpose of Visit:</label>
                <input type="text" id="purpose" name="purpose" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="text-sm text-red-600">@error('purpose') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Type of Inspection:</label>
                <select id="type" name="type" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select</option>
                    @foreach ($options['inspection-category'] as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="text-sm text-red-600">@error('type') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="site" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Site to be Inspected:</label>
                <input type="text" id="site" name="site" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="text-sm text-red-600">@error('site') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="entry" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Point of Entry:</label>
                <input type="text" id="entry" name="entry" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="text-sm text-red-600">@error('entry') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Date Time of Arrival:</label>
                <input type="date" id="dob" name="dob" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="text-sm text-red-600">@error('dob') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="inspectors" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> List of Inspectors:</label>
                <select id="inspectors" name="inspectors[]" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select</option>
                    <option value="inspector1">Inspector One</option>
                    <option value="inspector2">Inspector Two</option>
                    <option value="inspector3">Inspector Three</option>
                    <option value="inspector4">Inspector Four</option>
                    <option value="inspector5">Inspector Five</option>
                </select>
                <div class="text-sm text-red-600">@error('inspectors') {{$message}} @enderror</div>
                <div id="selected-inspectors" class="mt-2 flex flex-wrap">
                    <!-- Selected inspectors will be added here dynamically -->
                </div>
            </div>

            <div class="mb-4">
                <label for="teamlead" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Team Lead:</label>
                <select id="teamlead" name="teamlead" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select</option>
                </select>
                <div class="text-sm text-red-600">@error('teamlead') {{$message}} @enderror</div>
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Date Time of Departure:</label>
                <input type="date" id="dob" name="dob" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="text-sm text-red-600">@error('dob') {{$message}} @enderror</div>
            </div>

            <div class="mb-4 md:col-span-2">
                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks:</label>
                <textarea id="remarks" name="remarks" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                <div class="text-sm text-red-600">@error('remarks') {{$message}} @enderror</div>
            </div>

            <div class="md:col-span-3">
                <button type="submit" class="w-full py-2 px-4 rounded-md border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add
                </button>
            </div>
        </form>
    </div>

    
</body>

</html>