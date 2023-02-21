<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) == 0)

            @foreach ($listings as $listing)
                {{--               pre-designed listings imported--}}
                {{--                now turned into a component--}}
                {{--                to pass in a variable we have to add the :prefix to bind it to the prop--}}
                {{--            passing in just a regular string does not require a prefix--}}
                <x-listing-card :listing="$listing"/>
            @endforeach

        @else
            <p>No listings found</p>
        @endunless
    </div>
</x-layout>
