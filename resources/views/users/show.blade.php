@extends('layouts.app')

@section('title', trans('Detail User'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('User') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Detail user information.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('users.index') }}">{{ __('User') }}</a>
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
                                    <td colspan="2" class="text-center">
                                        <div class="avatar avatar-xl">
                                            @if ($user->avatar == null)
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}&s=500" alt="Avatar">
                                            @else
                                            <img src="{{ asset("uploads/images/avatars/$user->avatar") }}" alt="Avatar">
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Email') }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Role') }}</td>
                                    <td>{{ $user->getRoleNames()->toArray() !== [] ? $user->getRoleNames()[0] : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Email verified at') }}</td>
                                    <td>{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Created at') }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Asset</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Condition</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($placementAssets as $key => $item)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">{{ $item->placement_item ? $item->placement_item : '-'}}</td>
                                        <td class="text-center">{{ $item->type }}</td>
                                        <td class="text-center">{{ $item->condition }}</td>
                                        <td class="text-center">{{ $item->description }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
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

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endpush