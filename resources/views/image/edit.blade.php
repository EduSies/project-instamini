@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Editar Foto') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}" />

                            <div class="form-group row">
                                <label for="image_path" class="col-md-4 col-form-label text-md-right align-self-center">{{ __('Foto Actual') }}</label>

                                <div class="col-md-6">
                                    <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="card-img-top border" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Foto') }}</label>

                                <div class="col-md-6">
                                    <input id="image_path" type="file" class="mt-1 form-control-file @error('image_path') is-invalid @enderror" name="image_path" />

                                    @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="6" placeholder="{{ __('Añade un comentario...') }}" required>{{ $image->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar Foto') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
