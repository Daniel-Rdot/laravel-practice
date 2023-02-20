<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{--    merge not working somehow... idk why--}}
    {{$slot}}
</div>
