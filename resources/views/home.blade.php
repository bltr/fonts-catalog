@extends('layout')

@section('content')

    <ul>
    @foreach($fonts as $font)
        <li><a href="{{ route('font', $font) }}">{{ $font->name }}</a></li>
    @endforeach
    </ul>
    {{ $fonts->links() }}
@endsection
