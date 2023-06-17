@foreach($fonts as $font)
    <a href="{{ route('font', $font) }}"
       class="text-decoration-none fs-3 text-info"
    >
        {{ $font->name }}
    </a>

    <style>
        @font-face {
            font-family: "{{ $font->ttf_file }}";
            src: url("{{ $font->ttf_file_url }}");
        }
        .font-preview-{{ sha1($font->name) }} {
            font-family: "{{ $font->ttf_file }}";
            font-size: 36px;
        }
    </style>

    <p class="border font-preview-{{ sha1($font->name) }} mb-6 text-center p-4">
        You can download this font
    </p>
@endforeach
