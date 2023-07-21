@extends('layout')

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"/>

    <article itemscope itemtype="http://schema.org/Article">
        <h1 class="mt-5" itemprop="headline">Шрифт {{ $font->name }}</h1>

        <div class="social-buttons my-4">
            <span class="social-button social-button--vkontakte" data-social="vk"></span>
            <span class="social-button social-button--telegram" data-social="telegram"></span>
            <span class="social-button social-button--twitter" data-social="twitter"></span>
            <span class="social-button social-button--whatsapp" data-social="whatsapp"></span>
        </div>

        <div itemprop="articleBody">
            <p class="fs-5">Ниже можно скачать шрифт Staubiges Vergnügen в формате TTF (OTF) на английском и русском языке.</p>

            <style>
                @font-face {
                    font-family: "{{ $font->ttf_file }}";
                    src: url("{{ $font->ttf_file_url }}");
                }
                .font-preview {
                    font-family: "{{ $font->ttf_file }}";
                    font-size: 66px;
                }
            </style>

            <h2 class="mt-5 text-info">Латиница</h2>
            <div class="font-preview text-wrap text-break text-center border mb-5 p-5">
                abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
            </div>

            <h2 class="mt-5 text-info">Цифры</h2>
            <div class="font-preview text-wrap text-break text-center border mb-5 p-5">
                0123456789
            </div>

            <h2 class="mt-5 text-info">Кириллица</h2>
            <div class="font-preview text-wrap text-break text-center border mb-5 p-5">
                абвгдеёжзиклмнопрстуфхцчшщъьэюяАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЪЬЭЮЯ
            </div>

            <p class="fs-5">
                <a href="{{ $font->zip_file_url }}" class="text-danger fw-bold">Скачать шрифт {{ $font->name }}</a><br/>
                Вы можете <strong>скачать шрифт «{{ $font->name }}»</strong> одним zip-архивом, в архиве 1 шрифт.
            </p>
        </div>

        <div class="entry-social my-5">
            <div class="social-buttons">
                <span class="social-button social-button--vkontakte" data-social="vkontakte"></span>
                <span class="social-button social-button--telegram" data-social="telegram"></span>
                <span class="social-button social-button--twitter" data-social="twitter"></span>
                <span class="social-button social-button--whatsapp" data-social="whatsapp"></span>
            </div>
        </div>
    </article>
@endsection
