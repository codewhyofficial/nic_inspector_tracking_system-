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

<script>
    function refreshCaptcha() {
        var img = document.getElementById('captchaimg');
        var timestamp = new Date().getTime();
        img.src = img.src.split('?')[0] + '?' + timestamp;
    }
</script>