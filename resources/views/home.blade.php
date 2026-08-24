@extends('layouts.app')

{{-- EDIT: browser-tab title while the hero is in view --}}
@section('title', 'Home')

@section('content')
    @include('partials.hero')
    @include('partials.about')
    @include('partials.education')
    @include('partials.projects')
    @include('partials.contact')
@endsection
