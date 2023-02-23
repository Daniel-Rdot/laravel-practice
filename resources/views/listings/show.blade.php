<x-layout>
    @include('partials._search')

    <a href="/" class="inline-block text-black ml-4 mb-4"
    ><i class="fa-solid fa-arrow-left"></i> Zurück
    </a>
    <div class="mx-4">
        <x-card class="bg-black">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                     src="{{asset('images/no-image.png')}}"
                     alt=""
                />

                <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
                <div class="text-xl font-bold mb-4"><a href="/companies/{{$listing->company_id}}/">
                        {{\App\Models\Company::find($listing->company_id)->name}}</a></div>
                {{--                bring in tags from database via component listing-tags--}}
                <x-listing-tags :tagsCsv="$listing->tags"/>

                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Stellenbeschreibung
                    </h3>
                    <div class="text-lg space-y-6">
                        {{$listing->description}}

                        <a href="{{$listing->email}}"
                           class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Anbieter kontaktieren</a>

                        <a href="{{$listing->website}}"
                           target="_blank"
                           class="block bg-black text-white py-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-globe"></i> Webseite aufrufen
                        </a>
                    </div>
                </div>
            </div>
        </x-card>
        {{--        <x-card class="mt-4 p-2 flex space-x-6">--}}
        {{--            <a href="/listings/{{$listing->id}}/edit">--}}
        {{--                <i class="fa-solid fa-pencil"></i> Anzeige bearbeiten--}}
        {{--            </a>--}}
        {{--            <form action="/listings/{{$listing->id}}" method="POST">--}}
        {{--                @csrf--}}
        {{--                @method('DELETE')--}}
        {{--                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Anzeige löschen</button>--}}
        {{--            </form>--}}
        {{--        </x-card>--}}
    </div>
</x-layout>
