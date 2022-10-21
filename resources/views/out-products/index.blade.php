@extends('layouts.app')

@section('title', trans('Out Products'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="row mb-2">
                <div class="col">
                    <form class="d-flex">
                        <input type="text" class="form-control productCode" placeholder="Scan Barcode..." />
                        <button class="btn btn-sm rounded btn-success scan">Find</button>
                    </form>
                </div>
            </div>
            <div class="user-cart">
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th class="text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="{{ route('transactions.store') }}" method="post">
                @csrf
                <div class="row mt-2">
                    <div class="col">Total:</div>
                    <div class="col text-right">
                        <input type="number" value="" name="total" readonly class="form-control total">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">Purpose:</div>
                    <div class="col text-right">
                        <input type="text" name="purpose" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">Description:</div>
                    <div class="col text-right">
                        <textarea rows="3" name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">PIC:</div>
                    <div class="col text-right">
                        <input type="text" name="pic" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-block">
                            Cancel
                        </button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="mb-2">
                <input type="text" class="form-control search" placeholder="Search Product..." />
            </div>
            <div class="order-product product-search" style="display: flex;column-gap: 0.5rem;flex-wrap: wrap;row-gap: .5rem;">

                @foreach($products as $product)
                @if ($product->company_id === Auth::user()->company_id)
                <button type="button" class="item" style="cursor: pointer; border: none;" value="{{ $product->id }}">

                    <img src="{{$product->getFirstMediaUrl('product_image', 'thumb')}}" / width="90px" height="90px" alt="product_image">

                    <h6 style="margin: 0;">{{ $product->name }}</h6>
                    <span>@rupiah($product->price)</span>
                </button>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        function getCarts() {
            $.ajax({
                type: 'get',
                url: "carts",
                dataType: "json",
                success: function(response) {
                    let total = 0;
                    $('tbody').html("");
                    $.each(response.carts, function(key, product) {
                        total += product.price * product.quantity
                        $('tbody').append(`
                            <tr>
                                <td>${product.name}</td>
                                <td class="d-flex">
                                    <select class="form-control qty">
                                    ${[...Array(product.stock).keys()].map((x) => (
                                        `<option ${product.quantity == x + 1 ? 'selected' : null} value=${x + 1}>
                                            ${x + 1}
                                        </option>`
                                    ))}
                                    </select>
                                    <input
                                        type="hidden"
                                        class="cartId"
                                        value="${product.id}"
                                        />
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm delete"
                                        value="${product.id}"
                                        
                                    >
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-right">
                                Rp.${ product.quantity * product.price}
                                </td>
                            </tr>
                            `)
                    });

                    const test = $('.total').attr('value', `${total}`);
                }
            })
        }

        getCarts()

        $(document).on('change', '.received', function() {
            const total = $('.total').val();
        })

        $(document).on('change', '.qty', function() {
            const qty = $(this).val();
            const cartId = $(this).closest('td').find('.cartId').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'put',
                url: `carts/${cartId}`,
                data: {
                    qty
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 400) {
                        alert(response.message);
                    }
                    getCarts()
                }
            })
        })

        $(document).on('keyup', '.search', function() {
            const search = $(this).val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: `products/search`,
                data: {
                    search
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('.product-search').html("");
                    $.each(response, function(key, product) {
                        $('.product-search').append(`
                            <button type="button"
                                class="item"
                                style="cursor: pointer; border: none;"
                                value="${product.id}"
                            >
                            <img src="http://lcgudang.test/storage/${product.image.id}/${product.image.file_name}" / width="90px" height="90px" alt="product_image">
                    
                                <h6 style="margin: 0;">${product.name}</h6>
                                <span >(${product.price})</span>
                            </button>
                            `)
                    });
                }
            })
        })

        $(document).on('click', '.delete', function() {
            const cartId = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'delete',
                url: `carts/${cartId}`,
                success: function(response) {
                    if (response.status === 400) {
                        alert(response.message);
                    }
                    getCarts()
                }
            })
        })

        $('.scan').click(function(e) {
            e.preventDefault();
            const productCode = $(this).closest('form').find('.productCode').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: `carts`,
                data: {
                    productCode
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 400 || response.status === 500) {
                        alert(response.message);
                    }
                    getCarts()
                }
            })
        });

        $(document).on('click', '.item', function() {
            const productId = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: `carts`,
                data: {
                    productId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 400) {
                        alert(response.message);
                    }
                    getCarts()
                }
            })

        })
    })
</script>
@endpush