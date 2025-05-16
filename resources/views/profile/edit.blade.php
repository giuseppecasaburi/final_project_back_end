@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<div class="container">
    <h2 class="text-white my-4">
        Profilo
    </h2>
    <div class="card p-4 mb-4 rounded-lg">

        @include('profile.partials.update-profile-information-form')

    </div>

    <div class="card p-4 mb-4 rounded-lg">


        @include('profile.partials.update-password-form')

    </div>

    <div class="card p-4 mb-4 rounded-lg">


        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection
