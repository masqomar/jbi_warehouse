@extends('layouts.app')

@section('title', trans('Create Categories'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Categories') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Create an new category.') }}
                </p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                            </div>
                            <div class="form-group">
                                <label for="category">{{ __('category') }}</label>
                                <select name="category_id" id="category" class="form-control">
                                    @foreach($categories as $id => $categoryName)
                                    <option value="{{ $id }}">{{ $categoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="unit">{{ __('unit') }}</label>
                                <select name="unit_id" id="unit" class="form-control">
                                    @foreach($units as $id => $unitName)
                                    <option value="{{ $id }}">{{ $unitName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">{{ __('price') }}</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" />
                            </div>
                            <div class="form-group">
                                <label for="quantity">{{ __('quantity') }}</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" />
                            </div>
                            <div class="form-group">
                                <label for="danger_level">{{ __('danger_level') }}</label>
                                <input type="number" class="form-control" id="danger_level" name="danger_level" value="{{ old('danger_level') }}" />
                            </div>
                            <div class="form-group">
                                <label for="image">image</label>
                                <div class="needsclick dropzone" id="image-dropzone">

                                </div>
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection