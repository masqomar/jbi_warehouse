@extends('layouts.app')

@section('title', trans('Detail of MutationFroms'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('MutationFroms') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of mutationfrom.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('mutation-froms.index') }}">{{ __('MutationFroms') }}</a>
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
                                        <td class="fw-bold">{{ __('Mutation') }}</td>
                                        <td>{{ $mutationFrom->mutation ? $mutationFrom->mutation->mutation_code : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Placement') }}</td>
                                        <td>{{ $mutationFrom->placement ? $mutationFrom->placement->placement_code : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('AssetItem') }}</td>
                                        <td>{{ $mutationFrom->asset_item ? $mutationFrom->asset_item->code : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $mutationFrom->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $mutationFrom->updated_at->format('d/m/Y H:i') }}</td>
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
