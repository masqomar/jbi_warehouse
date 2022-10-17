@extends('layouts.app')

@section('title', trans('Edit AssetMaintenances'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('AssetMaintenances') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Edit a assetmaintenance.') }}
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
                    {{ __('Edit') }}
                </li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('asset-maintenances.update', $assetMaintenance->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">{{ __('Code') }}</label>
                                        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ isset($assetMaintenance) ? $assetMaintenance->code : old('code') }}" placeholder="{{ __('Code') }}" readonly />
                                        @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="asset_item_id">{{ __('AssetItem') }}</label>
                                        <input type="text" name="asset_item_id" id="asset_item_id" class="form-control @error('asset_item_id') is-invalid @enderror" value="{{ isset($assetMaintenance) ? $assetMaintenance->asset_item_id : old('asset_item_id') }}" placeholder="{{ __('asset_item_id') }}" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="finish_date">{{ __('Finish Date') }}</label>
                                        <input type="date" name="finish_date" id="finish_date" class="form-control @error('finish_date') is-invalid @enderror" value="{{ isset($assetMaintenance) && $assetMaintenance->finish_date ? $assetMaintenance->finish_date->format('Y-m-d') : old('finish_date') }}" placeholder="{{ __('Finish Date') }}" required />
                                        @error('finish_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="finish_note">{{ __('Finish Note') }}</label>
                                        <textarea name="finish_note" id="finish_note" class="form-control @error('finish_note') is-invalid @enderror" placeholder="{{ __('Finish Note') }}" required>{{ isset($assetMaintenance) ? $assetMaintenance->finish_note : old('finish_note') }}</textarea>
                                        @error('finish_note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">{{ __('Status') }}</label>
                                        <select class="form-select" name="status" id="status" class="form-control" required>
                                            <option value="" selected disabled>-- {{ __('Select status') }} --</option>
                                            <option value="Proses" {{ isset($assetMaintenance) && $assetMaintenance->status == 'Proses' ? 'selected' : (old('status') == 'Proses' ? 'selected' : '') }}>Proses</option>
                                            <option value="Selesai" {{ isset($assetMaintenance) && $assetMaintenance->status == 'Selesai' ? 'selected' : (old('status') == 'Selesai' ? 'selected' : '') }}>Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @include('asset-maintenances.include.form')



                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection