<div class="container mx-auto mt-5 flex flex-col justify-center">
    <div class="flex justify-between items-center mb-2">
        <h1 class="font-bold text-2xl">Inspector's List</h1>
        <div>
            <input type="text" id="searchInput" class="border-2 border-gray-400 p-1 mx-1 rounded-md" placeholder="Search by name..." autocomplete="off">
            <span><i class="fas fa-search text-white bg-gray-800 p-2 rounded-md"></i></span>
        </div>
    </div>
    <div>
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">S.no.</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Gender</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Nationality</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Place of Birth</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Inspector Rank</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Active Status</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Edit</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Action</th>
                </tr>
            </thead>
            <tbody id="inspectorTableBody" class="text-gray-700">
                @php $sno = 1 @endphp
                @foreach($users as $user)
                <tr class="border border-gray-200 hover:bg-gray-100 hover:rounded-md cursor-pointer hover-scale bg-white" onclick="window.location='{{ route('user', ['uiid' => $user->uiid]) }}'">
                    <td class="text-left py-4 px-4">{{ $sno++ }}</td>
                    <td class="text-left py-4 px-4">{{ $user->name }}</td>
                    <td class="text-left py-4 px-4">{{ $user->gender }}</td>
                    <td class="text-left py-4 px-4">{{ $user->nationality }}</td>
                    <td class="text-left py-4 px-4">{{ $user->place_of_birth }}</td>
                    <td class="text-left py-4 px-4">{{ $user->inspector_rank }}</td>
                    <td class="text-left py-4 px-4 " onclick="event.stopPropagation();">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" {{ $user->isActive == 'yes' ? 'checked' : '' }} data-uiid="{{ $user->uiid }}">
                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </td>
                    <td class="text-left py-4 px-4" onclick="event.stopPropagation(); window.location='{{ route('updateInspector', ['uiid' => $user->uiid]) }}'"><i class="fas fa-edit cursor-pointer hover:text-blue-600"></i></td>
                    <td class="text-left py-4 px-4">
                        <i class="fas fa-trash-alt cursor-pointer hover:text-red-600" onclick="event.stopPropagation(); showDeleteConfirmation(this)" data-url="{{ route('deleteInspector', ['uiid' => $user->uiid]) }}"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('lists.delete')

<script>
    document.querySelectorAll('input[type="checkbox"][data-uiid]').forEach(checkbox => {
        checkbox.addEventListener('change', function(event) {
            const uiid = event.target.dataset.uiid;
            const isActive = event.target.checked ? 'yes' : 'no';

            fetch(`/update-active-status/${uiid}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        isActive: isActive
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        event.target.checked = isActive === 'yes';
                    } else {
                        alert('Failed to update status');
                        event.target.checked = !event.target.checked; // Revert the change
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                    event.target.checked = !event.target.checked; // Revert the change
                });
        });
    });
</script>