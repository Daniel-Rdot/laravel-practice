{{--tags come from the database as a comma separated string--}}
@props(['tagsCsv'])

@php
    // split string into array
        $tags = explode(',', $tagsCsv);
@endphp

<ul class="flex">
    @foreach($tags as $tag)
        <li
            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            {{--            in order to be able to filter listings by clicking on a tag, each tag has to be passed via GET--}}
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>
