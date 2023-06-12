@extends('layout')

@section('content')
    <ul>
        <li><a href="/">Главная</a></li>
        @foreach($breadcrumbs as $breadcrumb)
            <li><a href="{{ route('category', $breadcrumb['slug']) }}">{{ $breadcrumb['name'] }}</a></li>
        @endforeach
    </ul>

    <h1>{{ $category->name }}</h1>

    <ul>
        @foreach($fonts as $font)
            <li><a href="{{ route('font', $font) }}">{{ $font->name }}</a></li>
        @endforeach
    </ul>
    {{ $fonts->links() }}
@endsection
