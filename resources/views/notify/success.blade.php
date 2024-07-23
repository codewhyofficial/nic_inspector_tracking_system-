<div id="success_message" class="fixed top-14 left-0 w-full flex justify-center p-4 z-20">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
</div>

<script>
    // Hide success message after 4 seconds
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success_message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.opacity = 0;
                successMessage.style.display = 'none';
            }, 4000); // 4 seconds
        }
    });
</script>