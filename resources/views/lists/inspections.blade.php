<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ZnneMtA5Srxh4TnLDX9FtNvZn5H7qO4kZlJ/8N3jOkNQDhjiyYH9mdy3b5K0yDQrmMNPwotCfE5oB/VbbQGdGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container mx-auto mt-5 flex flex-col justify-center">
    <div class="flex justify-between items-center mb-2">
        <h1 class="font-bold text-2xl">Inspection Details</h1>
        <div>
            <button onclick="window.location='{{ route('addInspection', ['uiid' => $user->uiid]) }}'" class=" bg-blue-600 hover:bg-blue-700 p-3 rounded-md text-white"><i class="fas fa-plus mr-2"></i>Add</button>
        </div>
    </div>
    <div>
        <table class="min-w-full bg-white">
            <thead class="bg-slate-900 text-white">
                <tr>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">S.no.</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Inspection Category</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Date of Joining</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Status</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Edit</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Action</th>
                </tr>
            </thead>
            <tbody id="inspectorTableBody" class="text-gray-700">
                @php $sno = 1 @endphp
                @foreach($inspections as $inspection)
                <tr class="border border-gray-200 hover:bg-gray-100 hover:rounded-md cursor-pointer hover-scale bg-white">

                    <td class="text-left py-4 px-4">{{ $sno++ }}</td>
                    <td class="text-left py-4 px-4">{{ $inspection->name }}</td>
                    <td class="text-left py-4 px-4">{{ $inspection->inspection_category }}</td>
                    <td class="text-left py-4 px-4">{{ $inspection->date_of_joining }}</td>
                    <td class="text-left py-4 px-4">{{ $inspection->status }}</td>
                    <td class="text-left py-4 px-4"><i class="fas fa-edit cursor-pointer hover:text-blue-600" onclick="window.location='{{ route('updateInspection', ['uiid' => $inspection->uiid, 'id' => $inspection->id]) }}'"></i></td>
                    <td class="text-left py-4 px-4"><i class="fas fa-trash-alt cursor-pointer hover:text-red-600"></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>