@extends('layouts.app')

@section('title', trans('Create AssetMaintenances'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('AssetMaintenances') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Create an new assetmaintenance.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('asset-maintenances.index') }}">{{ __('AssetMaintenances') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('Create') }}
                </li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('asset-maintenances.store') }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="row mb-2">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="asset_item_id">{{ __('AssetItem') }}</label>
                                        <select class="choices form-select" name="asset_item_id" id="asset_item_id" class="form-control" required>

                                            @foreach ($assetItems as $assetItem)
                                            <option value="{{ $assetItem->id }}" {{ isset($assetMaintenance) && $assetMaintenance->asset_item_id == $assetItem->id ? 'selected' : (old('asset_item_id') == $assetItem->id ? 'selected' : '') }}>
                                                {{ $assetItem->full_code }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="initial_date">{{ __('Initial Date') }}</label>
                                        <input type="date" name="initial_date" id="initial_date" class="form-control @error('initial_date') is-invalid @enderror" value="{{ isset($assetMaintenance) && $assetMaintenance->initial_date ? $assetMaintenance->initial_date->format('Y-m-d') : old('initial_date') }}" placeholder="{{ __('Initial Date') }}" required />
                                        @error('initial_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($assetMaintenance) ? $assetMaintenance->description : old('description') }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @include('asset-maintenances.include.form')

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/form-element-select.css">
@endpush

@push('js')
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
@endpush