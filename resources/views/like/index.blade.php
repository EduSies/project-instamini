@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="mb-4">{{ __('Mis imagenes favoritas') }}</h1>

                @foreach($likes as $like)
                    @include('includes.image',['image' => $like->image])
                @endforeach
                <div class="row justify-content-center">{{ $likes->links() }}</div>

            </div>
        </div>
    </div>
@endsection
