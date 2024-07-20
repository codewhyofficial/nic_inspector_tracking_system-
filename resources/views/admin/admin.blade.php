<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    @vite('resources/css/app.css') <!-- Assuming you're using Vite for CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom styles for hover effect */
        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.01);
            z-index: 10;
        }
    </style>
</head>

<body>

    @include('nav.adminNav')

    <div class="container mx-auto mt-5 flex flex-col justify-center">
        <div class="flex justify-between items-center mb-2">
            <h1 class="font-bold text-2xl">Inspector's List</h1>
            <div>
                <input type="text" id="searchInput" class="border-2 border-gray-400 p-1 mx-1 rounded-md" placeholder="Search by name..." autocomplete="off">
                <span><i class="fas fa-search text-white bg-gray-800 p-2 rounded-md"></i></span>
            </div>
        </div>
        <div>
            <table class="min-w-full bg-white ">
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
                    <tr class="border border-gray-200 hover:bg-gray-100 hover:rounded-md cursor-pointer hover-scale bg-white">

                        <td class="text-left py-4 px-4">{{ $sno++ }}</td>
                        <td class="text-left py-4 px-4">{{ $user->name }}</td>
                        <td class="text-left py-4 px-4">{{ $user->gender }}</td>
                        <td class="text-left py-4 px-4">{{ $user->nationality }}</td>
                        <td class="text-left py-4 px-4">{{ $user->place_of_birth }}</td>
                        <td class="text-left py-4 px-4">{{ $user->inspector_rank }}</td>
                        <td class="text-left py-4 px-4">{{ $user->isActive }}</td>
                        <td class="text-left py-4 px-4" onclick="window.location='{{ route('updateInspector', ['uiid' => $user->uiid]) }}'"><i class="fas fa-edit cursor-pointer hover:text-blue-600"></i></td>
                        <td class="text-left py-4 px-4"><i class="fas fa-trash-alt cursor-pointer hover:text-red-600"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('inspectorTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function(event) {
                const searchText = event.target.value.toLowerCase();

                Array.from(rows).forEach(row => {
                    const nameColumn = row.getElementsByTagName('td')[1];
                    if (nameColumn) {
                        const nameText = nameColumn.textContent.toLowerCase();
                        if (nameText.includes(searchText)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        });

        
    </script>
</body>

</html>