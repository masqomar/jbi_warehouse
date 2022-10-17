@extends('layouts.app')

@section('title', trans('Detail of AssetItems'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('AssetItems') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of assetitem.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('asset-items.index') }}">{{ __('AssetItems') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <td class="fw-bold">{{ __('Code') }}</td>
                                        <td>{{ isset($assetItem->code) ? $assetItem->code : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Full Code') }}</td>
                                        <td>{{ isset($assetItem->full_code) ? $assetItem->full_code : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Asset') }}</td>
                                        <td>{{ $assetItem->asset ? $assetItem->asset->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Purchasing No') }}</td>
                                        <td>{{ isset($assetItem->purchasing_no) ? $assetItem->purchasing_no : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Purchasing Date') }}</td>
                                        <td>{{ isset($assetItem->purchasing_date) ? $assetItem->purchasing_date->format('d/m/Y') : '-'  }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Status') }}</td>
                                        <td>{{ isset($assetItem->status) ? $assetItem->status : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Category') }}</td>
                                        <td>{{ $assetItem->category ? $assetItem->category->code : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Company') }}</td>
                                        <td>{{ $assetItem->company ? $assetItem->company->code : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $assetItem->user ? $assetItem->user->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $assetItem->user ? $assetItem->user->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $assetItem->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $assetItem->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
