<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ isset($comingProduct) && $comingProduct->date ? $comingProduct->date->format('Y-m-d') : old('date') }}" required />
            @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="product_id">{{ __('Product') }}</label>
            <select class="form-select" name="product_id" id="product_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select product') }} --</option>

                @foreach ($produk as $product)
                <option value="{{ $product->id }}" {{ isset($comingProduct) && $comingProduct->product_id == $product->id ? 'selected' : (old('product_id') == $product->id ? 'selected' : '') }}>
                    {{ $product->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ isset($comingProduct) ? $comingProduct->price : old('price') }}" placeholder="{{ __('Price') }}" required />
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="qty">{{ __('Qty') }}</label>
            <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ isset($comingProduct) ? $comingProduct->qty : old('qty') }}" placeholder="{{ __('Qty') }}" required />
            @error('qty')
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
                <option value="{{ $supplier->id }}" {{ isset($comingProduct) && $comingProduct->supplier_id == $supplier->id ? 'selected' : (old('supplier_id') == $supplier->id ? 'selected' : '') }}>
                    {{ $supplier->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>