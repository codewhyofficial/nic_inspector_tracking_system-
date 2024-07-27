<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div id="check-email-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative"> <!-- Modal container -->
        <button id="close-check-email-modal" class="absolute top-2 right-3 text-gray-600 hover:text-gray-900">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-lg font-semibold mb-4">Check User</h2>
        <input type="email" id="email" name="email" placeholder="Enter Email" autocomplete="off" class="mt-1 font-semibold block w-full px-3 py-2 mb-4 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm md:text-base">
        <button id="check-email-btn" class="bg-blue-500 text-white py-2 px-3 rounded focus:border-blue-500">Check</button>
        <div id="check-email-result" class="mt-4 text-sm"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('open-check-email-modal').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('check-email-modal').classList.remove('hidden');
        });

        document.getElementById('close-check-email-modal').addEventListener('click', function() {
            document.getElementById('check-email-modal').classList.add('hidden');
            document.getElementById('email').value = '';
            document.getElementById('check-email-result').textContent = '';
        });

        document.getElementById('check-email-btn').addEventListener('click', function() {
            var email = document.getElementById('email').value;

            if (email.trim() === "") {
                document.getElementById('check-email-result').textContent = "Please enter an email to check.";
                document.getElementById('check-email-result').style.color = 'red';
                return;
            }

            fetch("{{ route('checkEmail') }}?email=" + encodeURIComponent(email), {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('check-email-result').textContent = "Email already exists.";
                        document.getElementById('check-email-result').style.color = 'red';
                    } else {
                        document.getElementById('check-email-result').textContent = "Email is available.";
                        document.getElementById('check-email-result').style.color = 'green';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('check-email-result').textContent = "An error occurred while checking the email.";
                    document.getElementById('check-email-result').style.color = 'red';
                });
        });
    });
</script>