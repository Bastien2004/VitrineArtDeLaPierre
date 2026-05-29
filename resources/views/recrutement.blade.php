@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recruitment.css') }}">
@endpush

@push('seo')
    <title>Recrutement | Frédéric Oden</title>
    <meta name="description" content="Rejoignez Frédéric Oden, tailleur de pierre et sculpteur à Bellignies.">
    <meta property="og:title" content="Recrutement | Frédéric Oden">
    <meta property="og:description" content="Rejoignez Frédéric Oden, tailleur de pierre et sculpteur à Bellignies.">
    <meta name="robots" content="noindex">
@endpush

@section('content')
    @livewire('recruitment-form')
@endsection
