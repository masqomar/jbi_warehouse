@extends('layouts.app')

@section('title', trans('Detail of ComingProducts'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('ComingProducts') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of comingproduct.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('coming-products.index') }}">{{ __('ComingProducts') }}</a>
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
                                        <td>{{ isset($comingProduct->code) ? $comingProduct->code : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Date') }}</td>
                                        <td>{{ isset($comingProduct->date) ? $comingProduct->date->format('d/m/Y') : '-'  }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Product') }}</td>
                                        <td>{{ $comingProduct->product ? $comingProduct->product->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Price') }}</td>
                                        <td>{{ isset($comingProduct->price) ? $comingProduct->price : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Qty') }}</td>
                                        <td>{{ isset($comingProduct->qty) ? $comingProduct->qty : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $comingProduct->user ? $comingProduct->user->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Company') }}</td>
                                        <td>{{ $comingProduct->company ? $comingProduct->company->code : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Supplier') }}</td>
                                        <td>{{ $comingProduct->supplier ? $comingProduct->supplier->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $comingProduct->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $comingProduct->updated_at->format('d/m/Y H:i') }}</td>
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
