<div id="error_message" class="fixed top-16 left-0 w-full flex justify-center p-4 z-20">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
</div>

<script>
    // Hide success message after 4 seconds
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('error_message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.opacity = 0;
                successMessage.style.display = 'none';
            }, 4000); // 4 seconds
        }
    });
</script>