<a {{ $attributes->merge([
    "href" => "#",
    "class" => "focus:outline-none focus:ring-4 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2"
    ]) }}>
    {{$slot}}
</a>