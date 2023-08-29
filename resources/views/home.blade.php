@extends('layout')

@section('content')
    <x-font-list :fonts="$fonts" />

    <x-pagination :paginator="$fonts" :current_route_parameters="[]" />
@endsection
