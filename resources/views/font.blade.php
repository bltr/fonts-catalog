@extends('layout')

@section('content')
    <ul>
        <li><a href="/">Главная</a></li>
        @foreach($breadcrumbs as $breadcrumb)
            <li><a href="{{ route('category', $breadcrumb['slug']) }}">{{ $breadcrumb['name'] }}</a></li>
        @endforeach
    </ul>

    <h1>{{ $font->name }}</h1>

    <p>Файл: {{ $font->zip_file }}</p>
@endsection
