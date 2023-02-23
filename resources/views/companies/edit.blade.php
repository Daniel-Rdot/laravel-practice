<x-layout>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Accountdaten bearbeiten
            </h2>
            <p class="mb-4">{{$company->title}}</p>
        </header>

        <form method="POST" action="/companies/{{$company->id}}">
            @csrf
            {{--            directive to change the method into a PUT request--}}
            @method('PUT')
            <div class="mb-6">
                <label for="name"
                       class="inline-block text-lg mb-2">Name des Unternehmens</label>
                <input type="text"
                       class="border border-gray-200 rounded p-2 w-full"
                       name="name" value="{{$company->name}}"
                />
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="location"
                    class="inline-block text-lg mb-2">Arbeitsort</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="location" value="{{$company->location}}"
                />
                @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email" value="{{$company->email}}"
                />
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="website"
                    class="inline-block text-lg mb-2">Webseite</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="website" value="{{$company->website}}"
                />
                @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2">
                    Passwort
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password"
                />
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password2" class="inline-block text-lg mb-2">
                    Passwort bestätigen
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full"
                       name="password_confirmation"
                />
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Änderungen speichern
                </button>

                <a href="/" class="text-black ml-4"> Zurück </a>
            </div>
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <form action="/companies/{{$company->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Account löschen</button>
                </form>
            </td>
        </form>
    </div>
</x-layout>


