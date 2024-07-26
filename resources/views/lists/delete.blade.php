<div id="deleteConfirmationModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-black opacity-50 absolute inset-0"></div> <!-- Background overlay -->
    <div class="bg-white p-6 rounded shadow-lg w-1/3 z-60 relative"> <!-- Form container -->
        <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
        <p class="mb-4">Are you sure you want to delete this record?</p>
        <div class="flex justify-end">
            <button id="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
            <button id="cancelDelete" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
        </div>
    </div>
</div>

<script>
    let deleteTarget = null;

    function showDeleteConfirmation(target) {
        deleteTarget = target;
        document.getElementById('deleteConfirmationModal').classList.remove('hidden');
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (deleteTarget) {
            fetch(deleteTarget.dataset.url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        deleteTarget.closest('tr').remove();
                        document.getElementById('deleteConfirmationModal').classList.add('hidden');
                    } else {
                        alert('Failed to delete item');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
        }
    });

    document.getElementById('cancelDelete').addEventListener('click', function() {
        document.getElementById('deleteConfirmationModal').classList.add('hidden');
    });

    document.getElementById('modalOverlay').addEventListener('click', function() {
        document.getElementById('deleteConfirmationModal').classList.add('hidden');
    });

</script>