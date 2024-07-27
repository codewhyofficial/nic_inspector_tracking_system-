    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Inspector Visit Details</title>
        @vite('resources/css/app.css')
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>

    <body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

        @include('nav.userNav')

        <h1 class="text-2xl my-3 font-bold">Update Inspector Visit Details</h1>

        <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg mx-6 relative">
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

            <form action="{{ route('updateVisit', ['uiid' => $visit->uiid, 'id' => $visit->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- Inspector -->
                    <div>
                        <label for="inspector_name" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Inspector:</label>
                        <input readonly value="{{$user->name}}" type="text" name="inspector_name" id="inspector_name" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('inspector_name') {{$message}} @enderror</div>
                    </div>

                    <!-- Purpose of Visit -->
                    <div>
                        <label for="purpose_of_visit" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Purpose of Visit:</label>
                        <input type="text" id="purpose_of_visit" name="purpose_of_visit" value="{{ old('purpose_of_visit', $visit->purpose_of_visit) }}" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('purpose_of_visit') {{$message}} @enderror</div>
                    </div>

                    <!-- Type of Inspection -->
                    <div>
                        <label for="type_of_inspection" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Type of Inspection:</label>
                        <select id="type_of_inspection" name="type_of_inspection" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            @foreach ($options['type_of_inspection'] as $key => $value)
                            <option value="{{ $value }}" {{ old('type_of_inspection', $visit->type_of_inspection) == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="text-sm text-red-600">@error('type_of_inspection') {{$message}} @enderror</div>
                    </div>

                    <!-- Site to be Inspected -->
                    <div>
                        <label for="site_of_inspection" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Site to be Inspected:</label>
                        <input type="text" id="site_of_inspection" name="site_of_inspection" value="{{ old('site_of_inspection', $visit->site_of_inspection) }}" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('site_of_inspection') {{$message}} @enderror</div>
                    </div>

                    <!-- Point of Entry -->
                    <div>
                        <label for="point_of_entry" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Point of Entry:</label>
                        <input type="text" id="point_of_entry" name="point_of_entry" value="{{ old('point_of_entry', $visit->point_of_entry) }}" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('point_of_entry') {{$message}} @enderror</div>
                    </div>

                    <!-- Date Time of Arrival -->
                    <div>
                        <label for="date_time_of_arrival" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Date Time of Arrival:</label>
                        <input type="datetime-local" id="date_time_of_arrival" name="date_time_of_arrival" value="{{ old('date_time_of_arrival', $visit->date_time_of_arrival) }}" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('date_time_of_arrival') {{$message}} @enderror</div>
                    </div>
                </div>

                <!-- List of Inspectors -->
                @include('visit.list-of-inspectors')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Date Time of Departure -->
                    <div>
                        <label for="date_time_of_departure" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span> Date Time of Departure:</label>
                        <input type="datetime-local" id="date_time_of_departure" name="date_time_of_departure" value="{{ old('date_time_of_departure', $visit->date_time_of_departure) }}" required class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('date_time_of_departure') {{$message}} @enderror</div>
                    </div>

                    <!-- Remarks -->
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks (if any):</label>
                        <textarea id="remarks" name="remarks" rows="4" class="mt-1 font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('remarks') }}</textarea>
                        <div class="text-sm text-red-600">@error('remarks') {{$message}} @enderror</div>
                    </div>
                </div>

                <!-- Captcha -->
                @include('Components.Captcha')

                <div class="md:col-span-3 mt-2">
                    <button type="submit" class="w-full py-2 px-4 rounded-md border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </body>

    </html>