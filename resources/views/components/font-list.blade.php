@foreach($fonts as $font)
    <div class="card my-4">
        <div class="card-body">
            <a href="{{ route('font', $font) }}"
               class="text-decoration-none fs-3 text-danger-emphasis"
            >
                {{ $font->name }}
            </a>
        </div>
    </div>
@endforeach
