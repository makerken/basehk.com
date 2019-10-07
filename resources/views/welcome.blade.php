@extends('layouts.app')

@section('content')

@guest
<div class="row justify-content-center mb-4">
    <div class="col-md-6 col-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Play randomized full screen words</h5>
                <p class="card-text">My sister, an elementary school teacher, asked me if PowerPoint could randomize slides 
                    because students would remember the order, and not necissarly learn the words. Once I saw the answer
                    would rely on writing a Visual Basic macro I wrote a web app instead.</p>
                <p>Each user can save lists, and customise the font and display settings.</p>
                <div class="alert alert-success" role="alert">
                    Free, share it with everyone. <a href="{{ route('register') }}">{{ __('Register') }}</a> to begin.
                </div>
                <p class="text-muted">
                    Backup your lists using export under logout, becasue I am the only person paying for this to exist.
                </p>
                <p class="text-muted mb-0"><b>Privacy policy</b> Hi I'm <a href="https:makerken.com">Ken</a>. 
                    There are no ads or tracking, and never will be.
                </p>
            </div>
        </div>
    </div>
</div>
@endguest

@auth

<div class="row mx-1">
    <div class="col col-md-4 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create list</h5>
                @include('create')
            </div>
        </div>
    </div>
    @include('lists')
</div>
@endauth

@endsection