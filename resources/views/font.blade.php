@extends('layout')

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"/>

    <x-block block-name="font-top" />

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

            <div class="border p-5">
                <form>
                    <div class="mb-5">
                        <label for="text" class="form-label">
                            Введите свой текст в поле ниже для <strong>предпросмотра шрифта {{ $font->name }}</strong> онлайн:
                        </label>
                        <input type="text"
                               class="form-control form-control-lg"
                               id="text"
                               placeholder="You can download this font"
                               value="You can download this font"
                        >
                    </div>

                    <div class="d-flex justify-content-around mb-5">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="font_color" class="form-label">Цвет шрифта: </label>
                            </div>
                            <div class="col-auto">
                                <input type="color" class="form-control form-control-lg form-control-color" id="font_color" value="#61C0BF" title="Выбрать цвет шрифта">
                            </div>
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="background_color" class="form-label">Цвет фона: </label>
                            </div>
                            <div class="col-auto">
                                <input type="color" class="form-control form-control-lg form-control-color" id="background_color" value="#FAE3D9" title="Выбрать цвет фона">
                            </div>
                        </div>
                    </div>
                </form>

                <p>Как выглядит ваш текст:</p>
                <div class="text-center border p-5 font-preview font-test" id="example_text">You can download this font</div>
            </div>

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

        <x-block block-name="font-bottom" />

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

@push('style')
    <style>
        @font-face {
            font-family: "{{ $font->ttf_file }}";
            src: url("{{ $font->ttf_file_url }}");
        }
        .font-preview {
            font-family: "{{ $font->ttf_file }}";
            font-size: 66px;
        }
        .font-test {
            font-size: 99px;
            color: #61C0BF;
            background-color: #FAE3D9;
        }
    </style>
@endpush
