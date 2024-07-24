<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ZnneMtA5Srxh4TnLDX9FtNvZn5H7qO4kZlJ/8N3jOkNQDhjiyYH9mdy3b5K0yDQrmMNPwotCfE5oB/VbbQGdGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container mx-auto mt-5 mb-10 flex flex-col justify-center">
    <div class="flex justify-between items-center mb-2">
        <h1 class="font-bold text-2xl">Visit Details</h1>
        <div>
            <button onclick="window.location='{{ route('addVisit', ['uiid' => $user->uiid]) }}'" class=" bg-blue-600 hover:bg-blue-700 p-2 rounded-md text-white"><i class="fas fa-plus mr-2"></i>Add</button>
        </div>
    </div>
    <div>
        @if(empty($visits))
        <p class="text-gray-700 text-center">No visit details available.</p>
        @else
        <table class="min-w-full bg-white">
            <thead class="bg-blue-950 text-white">
                <tr>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">S.no.</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Purpose of visit</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Type of Inspection</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Site of Inspection</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Point of Entry</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Date Time of Arrival</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Date Time of Departure</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Edit</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-sm">Action</th>
                </tr>
            </thead>
            <tbody id="inspectorTableBody" class="text-gray-700">
                @php $sno = 1 @endphp
                @foreach($visits as $visit)
                <tr class="border border-gray-200 hover:bg-gray-100 hover:rounded-md cursor-pointer hover-scale bg-white">

                    <td class="text-left py-2 px-4">{{ $sno++ }}</td>
                    <td class="text-left py-2 px-4">{{ $visit->purpose_of_visit }}</td>
                    <td class="text-left py-2 px-4">{{ $visit->type_of_inspection }}</td>
                    <td class="text-left py-2 px-4">{{ $visit->site_of_inspection }}</td>
                    <td class="text-left py-2 px-4">{{ $visit->point_of_entry }}</td>
                    <td class="text-left py-2 px-4">{{ $visit->date_time_of_arrival }}</td>
                    <td class="text-left py-2 px-4">{{ $visit->date_time_of_departure }}</td>
                    <td class="text-left py-2 px-4"><i class="fas fa-edit cursor-pointer hover:text-blue-600" onclick="window.location='{{ route('updateVisit', ['uiid' => $visit->uiid, 'id' => $visit->id]) }}'"></i></td>
                    <td class="text-left py-2 px-4"><i class="fas fa-trash-alt cursor-pointer hover:text-red-600"></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>