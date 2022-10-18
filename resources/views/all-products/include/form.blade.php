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
            <label for="price">{{ __('Price') }}</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ isset($asset) ? $asset->price : old('price') }}" placeholder="{{ __('Price') }}" required />
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="quantity">{{ __('Stock') }}</label>
            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ isset($asset) ? $asset->quantity : old('quantity') }}" placeholder="{{ __('quantity') }}" required />
            @error('quantity')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="danger_level">{{ __('Danger Level') }}</label>
            <input type="number" name="danger_level" id="danger_level" class="form-control @error('danger_level') is-invalid @enderror" value="{{ isset($asset) ? $asset->danger_level : old('danger_level') }}" placeholder="{{ __('Danger Level') }}" required />
            @error('danger_level')
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
    <div class="mb-3">
        <label>Image:</label>
        <input type="file" name="product_image" class="form-control">
    </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/form-element-select.css">
@endpush

@push('js')
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
@endpush