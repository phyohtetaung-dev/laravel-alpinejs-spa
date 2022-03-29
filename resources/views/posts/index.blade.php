<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Laravel Alpine</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AlpineJs -->
    <script defer src="https://unpkg.com/alpinejs@3.9.3/dist/cdn.min.js"></script>
</head>

<body>
    <div x-data="list({{ json_encode(csrf_token()) }})">
        <!-- Alert -->
        <x-alert></x-alert>

        <div class="container w-50">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between">
                    @include('posts._search')
                </div>
                <div class="card-body">
                    @include('posts._table')
                    @include('posts._modal')
                </div>
                <div class="card-footer">
                    @include('posts._pagination')
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="js/list.js"></script>
</body>

</html>