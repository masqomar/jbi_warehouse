@extends('layouts.app')

@section('title', trans('Transactions'))

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- Content Row -->
    <div class="card">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ __('transaction') }}
            </h6>
        </div>

        @can('create transaction')
        <div class="d-flex justify-content-end">
            <a href="{{ route('out-products.index') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                {{ __('Create a new transaction') }}
            </a>
        </div>
        @endcan

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-transaction" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>No</th>
                            <th>Date</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr data-entry-id="{{ $transaction->id }}">
                            <td>

                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->pic }}</td>
                            <td>${{ $transaction->total_price }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Content Row -->

</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let deleteButtonTrans = 'delete selected'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });
                if (ids.length === 0) {
                    alert('zero selected')
                    return
                }
                if (confirm('are you sure ?')) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'asc']
            ],
            pageLength: 50,
        });
        $('.datatable-transaction:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endpush