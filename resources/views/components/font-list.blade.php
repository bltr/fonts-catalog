@foreach($fonts as $font)
    <div itemscope itemtype="https://schema.org/Collection">
        @if (in_array($loop->iteration, [1, 2, 3, 4]))
            <x-block block-name="font_listing-{{ $loop->iteration }}" />
        @endif
        <a href="{{ route('font', $font) }}"
           class="text-decoration-none fs-3 text-info"
        >
            <span itemprop="name">{{ $font->name }}</span>
        </a>

        <style>@font-face {font-family: "{{ $font->ttf_file }}";src: url("{{ $font->ttf_file_url }}");font-style: normal;font-display: swap;} .font-preview-{{ $font->name_hash }} {font-family: "{{ $font->ttf_file }}";font-size: 36px;}</style>

        <p class="border font-preview-{{ $font->name_hash }} mb-6 text-center p-4">
            You can download this font
        </p>
    </div>
@endforeach
