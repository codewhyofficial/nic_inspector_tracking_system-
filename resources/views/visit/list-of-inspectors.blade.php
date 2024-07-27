<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<div class="my-4 grid grid-cols-1 md:grid-cols-2">
    <div class="">
        <label for="list_of_inspectors" class="block text-sm font-medium text-gray-700">
            <span class="text-red-600 text-xl">*</span> List of Inspectors:
            <input type="text" id="multi-check-input" placeholder="Select Inspectors" class="border border-gray-300 font-semibold px-2 py-1 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </label>
        <div class="mt-2 ml-2 relative w-[27rem]">
            <div id="multi-check-menu" class="absolute border border-gray-400 max-h-60 overflow-y-auto hidden bg-white z-10 w-full mt-1">
                @foreach ($inspectors as $inspector)
                <div class="multi-check-option px-2 py-1 cursor-pointer hover:bg-gray-200 text-sm">
                    <input type="checkbox" id="inspector_{{ $inspector->uiid }}" value="{{ $inspector->uiid }}" data-name="{{ $inspector->name }} | {{ $inspector->inspector_rank }} | {{ $inspector->nationality }} | {{ $inspector->place_of_birth }}" class="mr-2">
                    <label for="inspector_{{ $inspector->uiid }}">{{ $inspector->name }} | {{$inspector->inspector_rank}} | {{$inspector->nationality}} | {{$inspector->place_of_birth}}</label>
                </div>
                @endforeach
            </div>
            <!-- Hidden input to store the selected inspector IDs -->
            <input type="hidden" id="selected-inspectors-ids" name="list_of_inspectors[]">
            <div class="text-sm text-red-600">@error('list_of_inspectors') {{$message}} @enderror</div>
        </div>
        <div id="selected-inspectors" class="mt-2 w-fit flex flex-col">
            <!-- Selected inspectors will be added here dynamically -->
        </div>
    </div>

    <div class="">
        <label for="team_lead" class="text-sm font-medium text-gray-700">
            <span class="text-red-600 text-xl">*</span> Team Lead:
            <select id="team_lead" name="team_lead" required class="border border-gray-300 font-semibold px-2 py-1 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select Team Lead</option>
                <!-- Options will be populated dynamically -->
            </select>
        </label>
    </div>
</div>

<script>
    const input = document.getElementById('multi-check-input');
    const menu = document.getElementById('multi-check-menu');
    const options = menu.querySelectorAll('input[type="checkbox"]');
    const selectedInspectorsDiv = document.getElementById('selected-inspectors');
    const selectedInspectorsIdsInput = document.getElementById('selected-inspectors-ids');
    const teamLeadSelect = document.getElementById('team_lead');

    input.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    options.forEach(option => {
        option.addEventListener('change', updateSelectedInspectors);
    });

    input.addEventListener('input', filterInspectors);

    function updateSelectedInspectors() {
        selectedInspectorsDiv.innerHTML = ''; // Clear previous selections
        const selectedOptions = Array.from(options)
            .filter(option => option.checked);

        const selectedIds = selectedOptions.map(option => option.value);
        selectedInspectorsIdsInput.value = JSON.stringify(selectedIds); // Store as JSON array

        // Clear existing options in team lead dropdown
        teamLeadSelect.innerHTML = '<option value="">Select Team Lead</option>';

        selectedOptions.forEach(option => {
            const span = document.createElement('span');
            span.textContent = option.getAttribute('data-name');
            span.className = 'selected-inspector bg-gray-200 rounded-full px-2 py-1 m-1 text-sm relative';
            selectedInspectorsDiv.appendChild(span);

            // Add option to team lead dropdown
            const teamLeadOption = document.createElement('option');
            teamLeadOption.value = option.value;
            teamLeadOption.textContent = option.getAttribute('data-name');
            teamLeadSelect.appendChild(teamLeadOption);

            // Add a remove button to the span
            const removeButton = document.createElement('button');
            removeButton.textContent = '×';
            removeButton.className = 'absolute top-0 right-0 text-red-600 text-base font-semibold cursor-pointer';
            removeButton.addEventListener('click', () => {
                option.checked = false;
                updateSelectedInspectors();
            });
            span.appendChild(removeButton);
        });
    }

    function filterInspectors() {
        const filter = input.value.toLowerCase();
        const optionDivs = menu.querySelectorAll('.multi-check-option');
        optionDivs.forEach(div => {
            const label = div.querySelector('label').textContent.toLowerCase();
            if (label.includes(filter)) {
                div.classList.remove('hidden');
            } else {
                div.classList.add('hidden');
            }
        });
    }

    // Close the dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.relative')) {
            menu.classList.add('hidden');
        }
    });
</script>