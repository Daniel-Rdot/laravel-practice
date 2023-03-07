<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="images/favicon.ico"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/updatePreview.js') }} "></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>TenMedia Schnuppertag | Jobbörse</title>
</head>
<body class="mb-48">
<nav class="flex justify-between items-center mb-4">
    <a href="/"><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/></a>
    <ul class="flex space-x-6 mr-6 text-lg">
        {{--        @auth makes it so the wrapped content only shows if user is logged in--}}

        @auth('company')
            <li>
            <span class="font-bold uppercase">
{{--                auth helper can access user attributes--}}
                Willkommen {{auth('company')->user()->name}}
            </span>
            </li>

            <li>
                <a href="/listings/manage" class="hover:text-laravel">
                    <i class="fa-solid fa-object-group"></i> Stellenanzeigen verwalten
                </a>
            </li>
            <li>
                <a href="/companies/{{auth('company')->user()->id}}/edit" class="hover:text-laravel">
                    <i class="fa-solid fa-gear"></i> Accountdetails
                </a>
            </li>
            <li>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit"><i class="fa-solid fa-door-closed"></i> Ausloggen</button>
                </form>
            </li>
        @endauth
        @auth
            @guest('company')
                <li>
            <span class="font-bold uppercase">
{{--                auth helper can access user attributes--}}
                Willkommen {{auth()->user()->name}}
            </span>
                </li>
                <li>
                    <a href="/users/{{auth()->user()->id}}/edit" class="hover:text-laravel">
                        <i class="fa-solid fa-gear"></i> Accountdetails
                    </a>
                </li>
                <li>
                    <form class="inline" method="POST" action="/logout">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-door-closed"></i> Ausloggen</button>
                    </form>
                </li>
            @endguest
        @endauth
        @guest
            @guest('company')
                <li>
            <span class="font-bold uppercase">
{{--                auth helper can access user attributes--}}
                Auf der Suche nach deinem Traumjob? <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </span>
                </li>
                <li>
                    <a href="/register/user" class="hover:text-laravel"
                    ><i class="fa-solid fa-user-plus"></i> Registrieren</a>
                </li>
                <li>
                    <a href="/login/user" class="hover:text-laravel"
                    ><i class="fa-solid fa-arrow-right-to-bracket"></i> Einloggen</a>
                </li>
            @endguest
        @endguest
    </ul>
</nav>
<main>
    {{$slot}}
</main>
<footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
    <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>
    @auth('company')
        <a href="/listings/create"
           class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Neue Jobanzeige</a>
    @else
        <a href="/login/company"
           class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Arbeitgeber-Login</a>
    @endauth
</footer>
<x-flash-message/>
</body>
</html>

