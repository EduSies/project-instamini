@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-4">{{ __('Inicio') }}</h1>

            @include('includes.message')

            @foreach($images as $image)
                @include('includes.image',['image' => $image])
            @endforeach
            <div class="row justify-content-center">{{ $images->links() }}</div>

        </div>
    </div>
</div>
@endsection
