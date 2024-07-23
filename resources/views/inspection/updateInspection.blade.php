<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inspection Details</title>
    @vite('resources/css/app.css')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="">

    @include('nav.userNav', ['user' => $inspection])

    <div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

        @if(session('error'))
        @include('notify.error')
        @endif

        <h1 class="text-2xl my-3 font-bold">Update Inspection Details</h1>

        <div class="bg-white p-8 rounded-lg shadow-md mx-6 relative md:max-w-5xl">
            @php
            $options = include(app_path('Custom Data/dropdownOptions.php'));
            @endphp

            <form method="POST" action="{{ route('updateInspection', ['uiid' => $inspection->uiid, 'id' => $inspection->id]) }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Inspector -->
                    <div>
                        <label for="inspector_name" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Inspector:</label>
                        <input value="{{ old('inspector_name', $inspection->name) }}" type="text" name="inspector_name" id="inspector_name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('inspector_name') {{$message}} @enderror</div>
                    </div>

                    <!-- Inspection Category -->
                    <div>
                        <label for="inspection_category" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Inspection Category:</label>
                        <select id="inspection_category" name="inspection_category" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            @foreach ($options['inspection-category'] as $value)
                            <option value="{{ $value }}" {{ old('inspection_category', $inspection->inspection_category) == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="text-sm text-red-600">@error('inspection_category') {{$message}} @enderror</div>
                    </div>

                    <!-- Joining Date -->
                    <div>
                        <label for="date_of_joining" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Joining Date:</label>
                        <input type="date" id="date_of_joining" name="date_of_joining" required value="{{ old('date_of_joining', $inspection->date_of_joining) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="text-sm text-red-600">@error('date_of_joining') {{$message}} @enderror</div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700"><span class="text-red-600 text-xl">*</span>Status:</label>
                        <select id="status" name="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            @foreach ($options['status'] as $value)
                            <option value="{{ $value }}" {{ old('status', $inspection->status) == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="text-sm text-red-600">@error('status') {{$message}} @enderror</div>
                    </div>

                    <!-- Remarks -->
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks:</label>
                        <textarea id="remarks" name="remarks" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('remarks', $inspection->remarks) }}</textarea>
                        <div class="text-sm text-red-600">@error('remarks') {{$message}} @enderror</div>
                    </div>
                </div>

                <!-- Captcha -->
                <div class="mt-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ route('captcha') }}" id='captchaimg' style="border: 1px solid #000;" class="w-40 h-20">
                        <i class="fas fa-sync cursor-pointer" onclick="refreshCaptcha()"></i>
                    </div>
                    <div class="flex items-center space-x-3 mt-3">
                        <input type="text" id="captcha_code" name="captcha_code" placeholder="Enter captcha code" maxlength="6" required class="block w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <small class="text-green-600">Captcha code is case sensitive</small>
                    </div>
                    <div class="text-sm text-red-600">@error('captcha_code') {{ $message }} @enderror</div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-2 px-4 rounded-md border border-transparent shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function refreshCaptcha() {
            var img = document.getElementById('captchaimg');
            var timestamp = new Date().getTime();
            img.src = img.src.split('?')[0] + '?' + timestamp;
        }
    </script>
</body>

</html>