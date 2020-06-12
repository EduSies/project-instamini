@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        @if( $user->image )
                            <img src="{{ route('user.avatar',['filename' => $user->image]) }}" class="md-avatar size-4 rounded-circle mx-auto d-block shadow-sm border" />
                        @else
                            <div class="gray md-avatar rounded-circle size-4 mx-auto d-block shadow-sm border"></div>
                        @endif
                        <h4 class="font-weight-bold mb-0 mt-4">{{ $user->nick }}</h4>
                        <hr/>
                        <p class="dark-grey-text mb-0">{{ $user->name.' '.$user->surname }}</p>
                        <p class="card-text text-black-50 mb-0 mt-3">
                            <small>{{ __('Se unió: ').\FormatTime::LongTimeFilter($user->created_at) }}</small>
                        </p>
                    </div>
                </div>

                @foreach($user->images as $image)
                    @include('includes.image',['image' => $image])
                @endforeach

            </div>
        </div>
    </div>
@endsection
