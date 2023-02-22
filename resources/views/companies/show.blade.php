<x-layout>
    @include('partials._search')

    <a href="/" class="inline-block text-black ml-4 mb-4">
        <i class="fa-solid fa-arrow-left"></i> Zurück
    </a>
    <div class="mx-4">
        <x-card>
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                     src="{{asset('images/no-image.png')}}"
                     alt=""
                />
                <h3 class="text-2xl font-bold mb-2">{{$company->name}}</h3>


                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$company->location}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Kontakt
                    </h3>
                    <div class="text-lg space-y-6">


                        <a href="{{$company->email}}"
                           class="block bg-laravel text-white mt-6 py-2 px-5 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            {{$company->email}}</a>

                        <a href="{{$company->website}}"
                           target="_blank"
                           class="block bg-black text-white py-2 px-5 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-globe"></i> {{$company->website}}
                        </a>
                    </div>
                </div>
                <div class="border border-gray-200 w-full mt-6 mb-6"></div>
                <div class="text-lg my-4">
                    <a href="/?company_id={{$company->id}}">Alle Stellenanzeigen von {{$company->name}} anzeigen</a>
                </div>
            </div>

        </x-card>
    </div>
</x-layout>
