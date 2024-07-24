<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Check Dropdown</title>
    <style>
        .multi-check-container {
            position: relative;
            width: 200px;
        }

        .multi-check-menu {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            background-color: white;
        }

        .multi-check-option {
            padding: 5px;
            cursor: pointer;
        }

        .multi-check-option:hover {
            background-color: #f0f0f0;
        }

        .multi-check-option input {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="multi-check-container">
        <input type="text" id="multi-check-input" placeholder="Select options" readonly>
        <div id="multi-check-menu" class="multi-check-menu">
            <div class="multi-check-option">
                <input type="checkbox" id="option1" value="1">
                <label for="option1">Option 1</label>
            </div>
            <div class="multi-check-option">
                <input type="checkbox" id="option2" value="2">
                <label for="option2">Option 2</label>
            </div>
            <div class="multi-check-option">
                <input type="checkbox" id="option3" value="3">
                <label for="option3">Option 3</label>
            </div>
            <div class="multi-check-option">
                <input type="checkbox" id="option4" value="4">
                <label for="option4">Option 4</label>
            </div>
            <div class="multi-check-option">
                <input type="checkbox" id="option5" value="5">
                <label for="option5">Option 5</label>
            </div>
        </div>
    </div>

    <script>
        const input = document.getElementById('multi-check-input');
        const menu = document.getElementById('multi-check-menu');
        const options = menu.querySelectorAll('input[type="checkbox"]');

        input.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });

        options.forEach(option => {
            option.addEventListener('change', updateInput);
        });

        function updateInput() {
            const selectedOptions = Array.from(options)
                .filter(option => option.checked)
                .map(option => option.nextElementSibling.textContent);
            input.value = selectedOptions.join(', ');
        }

        // Close the dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.multi-check-container')) {
                menu.style.display = 'none';
            }
        });
    </script>
</body>

</html>