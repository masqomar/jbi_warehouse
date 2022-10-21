<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="invoice_number">{{ __('Invoice Number') }}</label>
            <input type="text" name="invoice_number" id="invoice_number" class="form-control @error('invoice_number') is-invalid @enderror" value="{{ $procurementCode }}" readonly />
            @error('invoice_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ isset($procurement) && $procurement->date ? $procurement->date->format('Y-m-d') : old('date') }}" placeholder="{{ __('Date') }}" required />
            @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="supplier_id">{{ __('Supplier') }}</label>
            <select class="form-select" name="supplier_id" id="supplier_id" class="form-control">
                <option value="" selected disabled>-- {{ __('Select supplier') }} --</option>

                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ isset($procurement) && $procurement->supplier_id == $supplier->id ? 'selected' : (old('supplier_id') == $supplier->id ? 'selected' : '') }}>
                    {{ $supplier->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="type">{{ __('Type') }}</label>
            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ isset($procurement) ? $procurement->type : old('type') }}" placeholder="{{ __('Type') }}" required />
            @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Procurement Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($procurement) ? $procurement->description : old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
<hr>
<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="category_id">{{ __('Category') }}</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">-- Select Category --</option>

                @foreach ($categories as $id)
                <option value="{{$id->id}}">{{$id->name}}</option>
                @endforeach

            </select>
            @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="asset_id">{{ __('Asset') }}</label>
            <select id="asset-dropdown" name="asset_id" class="form-control">
            </select>

            @error('asset_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="quantity">{{ __('Quantity') }}</label>
            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ isset($procurement) ? $procurement->quantity : old('quantity') }}" placeholder="{{ __('quantity') }}" required />
            @error('quantity')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ isset($procurement) ? $procurement->price : old('price') }}" placeholder="{{ __('price') }}" required />
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="item_description">{{ __('Asset Description') }}</label>
            <textarea name="item_description" id="item_description" class="form-control @error('item_description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($procurement) ? $procurement->item_description : old('item_description') }}</textarea>
            @error('item_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>


@push('css')
<link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/form-element-select.css">
@endpush

@push('js')
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#category_id").on('change', function() {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('procurements.create') }}",
                type: "GET",
                data: {
                    'category_id': category_id
                },
                success: function(data) {
                    console.log(data);

                    $('#asset-dropdown').html('<option value="">-- Select Asset --</option>');
                    $.each(data.assets, function(key, value) {
                        $("#asset-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@endpush