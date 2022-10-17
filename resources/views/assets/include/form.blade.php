<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($asset) ? $asset->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="unit_id">{{ __('Unit') }}</label>
            <select class="form-select" name="unit_id" id="unit_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select unit') }} --</option>

                @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ isset($asset) && $asset->unit_id == $unit->id ? 'selected' : (old('unit_id') == $unit->id ? 'selected' : '') }}>
                    {{ $unit->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="specification">{{ __('Specification') }}</label>
            <textarea name="specification" id="specification" class="form-control @error('specification') is-invalid @enderror" placeholder="{{ __('Specification') }}">{{ isset($asset) ? $asset->specification : old('specification') }}</textarea>
            @error('specification')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="stock">{{ __('Stock') }}</label>
            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ isset($asset) ? $asset->stock : old('stock') }}" placeholder="{{ __('Stock') }}" required />
            @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ isset($asset) ? $asset->price : old('price') }}" placeholder="{{ __('Price') }}" required />
            @error('Price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($asset) ? $asset->description : old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="category_id">{{ __('Category') }}</label>
            <select class="choices form-select" name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ isset($asset) && $asset->category_id == $category->id ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="purchasing_no">{{ __('purchasing_no') }}</label>
            <input type="text" name="purchasing_no" id="purchasing_no" class="form-control @error('purchasing_no') is-invalid @enderror" value="{{ isset($asset) ? $asset->purchasing_no : old('purchasing_no') }}" placeholder="{{ __('Purchasing No') }}" />
            @error('purchasing_no')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="purchasing_date">{{ __('purchasing_date') }}</label>
            <input type="date" name="purchasing_date" id="purchasing_date" class="form-control @error('purchasing_date') is-invalid @enderror" value="{{ isset($asset) ? $asset->purchasing_date : old('purchasing_date') }}" placeholder="{{ __('purchasing_date') }}" />
            @error('purchasing_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label>Image:</label>
        <input type="file" name="asset_image" class="form-control">
    </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/form-element-select.css">
@endpush

@push('js')
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
@endpush