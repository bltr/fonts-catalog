@extends('layout')

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"/>

    <h1 class="mt-5">Шрифт {{ $font->name }}</h1>

    <div class="social-buttons my-4">
        <span class="social-button social-button--vkontakte" data-social="vk"></span>
        <span class="social-button social-button--telegram" data-social="telegram"></span>
        <span class="social-button social-button--twitter" data-social="twitter"></span>
        <span class="social-button social-button--whatsapp" data-social="whatsapp"></span>
    </div>

    <p class="fs-5">Ниже можно скачать шрифт Staubiges Vergnügen в формате TTF (OTF) на английском и русском языке.</p>

    <p class="fs-5">
        {{--        todo url cloaking--}}
        <a href="{{ $font->zip_file_url }}" class="text-danger fw-bold">Скачать шрифт {{ $font->name }}</a><br/>
        Вы можете <strong>скачать шрифт «{{ $font->name }}»</strong> одним zip-архивом, в архиве 1 шрифт.
    </p>

    <div class="entry-social my-5">
        <div class="social-buttons">
            <span class="social-button social-button--vkontakte" data-social="vkontakte"></span>
            <span class="social-button social-button--telegram" data-social="telegram"></span>
            <span class="social-button social-button--twitter" data-social="twitter"></span>
            <span class="social-button social-button--whatsapp" data-social="whatsapp"></span>
        </div>
    </div>
@endsection
