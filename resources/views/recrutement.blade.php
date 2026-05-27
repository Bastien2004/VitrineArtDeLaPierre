@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recruitment.css') }}">
@endpush

@section('content')
    @livewire('recruitment-form')
@endsection
