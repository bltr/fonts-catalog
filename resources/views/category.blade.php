@extends('layout')

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"/>

    <h1 class="">Тип шрифтов: {{ $category->name }}</h1>

    <x-font-list :fonts="$fonts" />

    <x-pagination :paginator="$fonts" :currentRouteParameters="compact('category')" />
@endsection
