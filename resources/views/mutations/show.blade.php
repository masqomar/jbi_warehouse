@extends('layouts.app')

@section('title', trans('Detail of Mutations'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Mutations') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Detail of mutation.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('mutations.index') }}">{{ __('Mutations') }}</a>
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
                                    <td class="fw-bold">{{ __('Mutation Code') }}</td>
                                    <td>{{ isset($mutation->mutation_code) ? $mutation->mutation_code : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Date') }}</td>
                                    <td>{{ isset($mutation->date) ? $mutation->date->format('d/m/Y') : '-'  }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Condition') }}</td>
                                    <td>{{ isset($mutation->condition) ? $mutation->condition : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Description') }}</td>
                                    <td>{{ isset($mutation->description) ? $mutation->description : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('User') }}</td>
                                    <td>{{ $mutation->user ? $mutation->user->name : '' }}</td>
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