<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    @vite('resources/css/app.css')
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

<body class="bg-gray-100">

    @include('nav.userNav')

    @if(session('success'))
    @include('notify.success')
    @endif

    @include('lists.inspections')

    @include('lists.visits')

</body>

</html>