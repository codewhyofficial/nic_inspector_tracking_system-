<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inspector Details</title>
    @vite('resources/css/app.css')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="">

    @include('nav.userNav', ['user' => $inspector])

    <div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-2xl my-3 font-bold">Update Inspector Details</h1>

        <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg mx-6 relative md:max-w-5xl">

            <!-- Importing the arrays from 'app/Custom Data/dropdownOptions.php' -->
            @php
            $options = include(app_path('Custom Data/dropdownOptions.php'));
            @endphp

            <form method="POST" action="{{ route('updateInspector', ['uiid' => $inspector->uiid]) }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Name:</label>
                        <input type="text" id="name" name="name" required value="{{ old('name', $inspector->name) }}" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('name') {{$message}} @enderror</div>
                    </div>

                    <!-- gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Gender:</label>
                        <select id="gender" name="gender" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            <option value="male" {{ old('gender', $inspector->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $inspector->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $inspector->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <div class="text-sm text-red-600">@error('gender') {{$message}} @enderror</div>
                    </div>

                    <!-- dob -->
                    <div>
                        <label for="dob" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Date of Birth:</label>
                        <input type="date" id="dob" name="dob" required value="{{ old('dob', $inspector->DOB) }}" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('dob') {{$message}} @enderror</div>
                    </div>

                    <!-- nationality -->
                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Nationality:</label>
                        <select id="nationality" name="nationality" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            @foreach ($options['nationalities'] as $value)
                            <option value="{{ $value }}" {{ old('nationality', $inspector->nationality) == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="text-sm text-red-600">@error('nationality') {{$message}} @enderror</div>
                    </div>

                    <!-- place of birth -->
                    <div>
                        <label for="placeofbirth" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Place of Birth:</label>
                        <select id="placeofbirth" name="placeofbirth" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            <option value="city1" {{ old('placeofbirth', $inspector->place_of_birth) == 'city1' ? 'selected' : '' }}>City 1</option>
                            <option value="city2" {{ old('placeofbirth', $inspector->place_of_birth) == 'city2' ? 'selected' : '' }}>City 2</option>
                            <option value="city3" {{ old('placeofbirth', $inspector->place_of_birth) == 'city3' ? 'selected' : '' }}>City 3</option>
                        </select>
                        <div class="text-sm text-red-600">@error('placeofbirth') {{$message}} @enderror</div>
                    </div>

                    <!-- passport number -->
                    <div>
                        <label for="passport" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Passport Number:</label>
                        <input type="text" id="passport" name="passport" placeholder="e.g., A1234567" maxlength="9" required value="{{ old('passport', $inspector->passport_number) }}" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('passport') {{$message}} @enderror</div>
                    </div>

                    <!-- unlp number -->
                    <div>
                        <label for="unlp" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>UNLP Number:</label>
                        <input type="text" id="unlp" name="unlp" placeholder="e.g., AB1234567" maxlength="9" required value="{{ old('unlp', $inspector->UNLP_number) }}" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('unlp') {{$message}} @enderror</div>
                    </div>

                    <!-- rank -->
                    <div>
                        <label for="rank" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Rank:</label>
                        <select id="rank" name="rank" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            @foreach ($options['rank'] as $value)
                            <option value="{{ $value }}" {{ old('rank', $inspector->inspector_rank) == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="text-sm text-red-600">@error('rank') {{$message}} @enderror</div>
                    </div>

                    <!-- qualification -->
                    <div>
                        <label for="qualification" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Qualification:</label>
                        <input type="text" id="qualification" name="qualification" required value="{{ old('qualification', $inspector->qualification) }}" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('qualification') {{$message}} @enderror</div>
                    </div>

                    <!-- experience -->
                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Professional Experience:</label>
                        <input type="text" id="experience" name="experience" required value="{{ old('experience', $inspector->professional_experience) }}" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('experience') {{$message}} @enderror</div>
                    </div>

                    <!-- clearance certificate -->
                    <div>
                        <label for="clearance_certificate" class="block text-sm font-medium text-gray-700">Clearance Certificate:</label>
                        <input type="file" id="clearance_certificate" name="clearance_certificate" class="mt-1 font-semibold block w-full text-gray-700 sm:text-sm">
                        <div class="text-sm text-red-600">@error('clearance_certificate') {{$message}} @enderror</div>
                        <div class="text-sm font-semibold text-red-600 underline cursor-pointer">View Uploaded Document</div>
                    </div>

                    <!-- remarks -->
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks:</label>
                        <textarea id="remarks" name="remarks" rows="3" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('remarks', $inspector->remarks) }}</textarea>
                        <div class="text-sm text-red-600">@error('remarks') {{$message}} @enderror</div>
                    </div>

                    <!-- Captcha -->
                    @include('Components.Captcha')
                </div>


                <div class="mt-6">
                    <button type="submit" tabindex="16" class="w-full py-2 px-4 rounded-md border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>