<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ZnneMtA5Srxh4TnLDX9FtNvZn5H7qO4kZlJ/8N3jOkNQDhjiyYH9mdy3b5K0yDQrmMNPwotCfE5oB/VbbQGdGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container mx-auto mt-5 mb-10 flex flex-col justify-center">
    <div class="flex justify-between items-center mb-2">
        <h1 class="font-bold text-2xl">Visit Details</h1>
        <div>
            <button onclick="window.location='{{ route('addVisit', ['uiid' => $user->uiid]) }}'" class="bg-blue-600 hover:bg-blue-700 p-2 rounded-md text-white">
                <i class="fas fa-plus mr-2"></i>Add
            </button>
        </div>
    </div>
    <div class="overflow-x-auto">
        @if(empty($visits))
        <p class="text-gray-700 text-center">No visit details available.</p>
        @else
        <table class="min-w-full bg-white">
            <thead class="bg-blue-950 text-white">
                <tr>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">S.no.</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Purpose of Visit</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Type of Inspection</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Site of Inspection</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Point of Entry</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Date Time of Arrival</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Date Time of Departure</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Inspectors</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Team Lead</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Edit</th>
                    <th class="text-left py-2 px-4 uppercase font-semibold text-xs">Action</th>
                </tr>
            </thead>
            <tbody id="inspectorTableBody" class="text-gray-700">
                @php $sno = 1 @endphp
                @foreach($visits as $visit)
                <tr class="border border-gray-200 hover:bg-gray-100 hover:rounded-md cursor-pointer hover-scale bg-white">
                    <td class="text-left py-2 px-4 text-sm">{{ $sno++ }}</td>
                    <td class="text-left py-2 px-4 text-sm">{{ $visit->purpose_of_visit }}</td>
                    <td class="text-left py-2 px-4 text-sm">{{ $visit->type_of_inspection }}</td>
                    <td class="text-left py-2 px-4 text-sm">{{ $visit->site_of_inspection }}</td>
                    <td class="text-left py-2 px-4 text-sm">{{ $visit->point_of_entry }}</td>
                    <td class="text-left py-2 px-4 text-sm">{{ $visit->date_time_of_arrival }}</td>
                    <td class="text-left py-2 px-4 text-sm">{{ $visit->date_time_of_departure }}</td>
                    <td class="text-left py-2 px-4 text-sm">
                        @if($visit->inspectors_details && $visit->inspectors_details->count())
                        @php $inspectors = $visit->inspectors_details; @endphp
                        <div id="inspectors-list-{{ $visit->id }}">
                            <span class=" font-bold">{{ $inspectors->first()->name }}</span> | {{ $inspectors->first()->inspector_rank }}
                            @if($inspectors->count() > 1)
                            <a href="#" class="text-blue-500 hover:underline" onclick="toggleInspectors('{{ $visit->id }}')">View More</a>
                            <div id="more-inspectors-{{ $visit->id }}" class="hidden">
                                @foreach($inspectors->slice(1) as $inspector)
                                <span class=" font-bold">{{ $inspector->name }}</span>| {{ $inspector->inspector_rank }}<br>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @else
                        No Inspectors
                        @endif
                    </td>
                    <td class="text-left py-2 px-4 text-sm">
                        @if($visit->team_lead_details)
                        {{ $visit->team_lead_details->name }} | {{ $visit->team_lead_details->inspector_rank }}
                        @else
                        No Team Lead
                        @endif
                    </td>
                    <td class="text-left py-2 px-4">
                        <i class="fas fa-edit cursor-pointer hover:text-blue-600" onclick="window.location='{{ route('updateVisit', ['uiid' => $visit->uiid, 'id' => $visit->id]) }}'"></i>
                    </td>
                    <td class="text-left py-2 px-4">
                        <i class="fas fa-trash-alt cursor-pointer hover:text-red-600" onclick="event.stopPropagation(); showDeleteConfirmation(this)" data-url="{{ route('deleteVisit', ['uiid' => $visit->uiid, 'id' => $visit->id]) }}"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<script>
    function toggleInspectors(id) {
        const moreInspectors = document.getElementById('more-inspectors-' + id);
        const viewMoreLink = moreInspectors.previousElementSibling;
        if (moreInspectors.classList.contains('hidden')) {
            moreInspectors.classList.remove('hidden');
            viewMoreLink.textContent = 'View Less';
        } else {
            moreInspectors.classList.add('hidden');
            viewMoreLink.textContent = 'View More';
        }
    }
</script>