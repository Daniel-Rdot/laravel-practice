<x-layout>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Stellenanzeige bearbeiten
            </h2>
            <p class="mb-4">{{$listing->title}}</p>
        </header>

        <form method="POST" action="/listings/{{$listing->id}}">
            @csrf
            {{--            directive to change the method into a PUT request--}}
            @method('PUT')
            <div class="mb-6">
                <label
                    for="company"
                    class="inline-block text-lg mb-2">Name des Unternehmens</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="company" value="{{$listing->company}}" readonly
                />
                @error('company')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Jobbezeichnung</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    placeholder="Beispiel: Senior Entwickler Laravel" value="{{$listing->title}}"
                />
                @error('title')
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
                    name="location" value="{{$listing->location}}"
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
                    name="email" value="{{$listing->email}}"
                />
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="website"
                    class="inline-block text-lg mb-2">
                    Webseite
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="website" value="{{$listing->website}}"
                />
                @error('website')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Kommasepariert)
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="tags"
                    placeholder="Beispiel: Laravel, Backend, Postgres, etc" value="{{$listing->tags}}"
                />
                @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{--            <div class="mb-6">--}}
            {{--                <label for="logo" class="inline-block text-lg mb-2">--}}
            {{--                    Firmenlogo--}}
            {{--                </label>--}}
            {{--                <input--}}
            {{--                    type="file"--}}
            {{--                    class="border border-gray-200 rounded p-2 w-full"--}}
            {{--                    name="logo"--}}
            {{--                />--}}
            {{--            </div>--}}

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2">
                    Jobbeschreibung
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                >{{$listing->description}}</textarea>
                @error('description')
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
        </form>
    </div>
</x-layout>

