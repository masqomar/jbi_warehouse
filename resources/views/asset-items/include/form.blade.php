<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="code">{{ __('Code') }}</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ isset($assetItem) ? $assetItem->code : old('code') }}" placeholder="{{ __('Code') }}" required />
            @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="full_code">{{ __('Full Code') }}</label>
            <input type="text" name="full_code" id="full_code" class="form-control @error('full_code') is-invalid @enderror" value="{{ isset($assetItem) ? $assetItem->full_code : old('full_code') }}" placeholder="{{ __('Full Code') }}" required />
            @error('full_code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="asset_id">{{ __('Asset') }}</label>
            <select class="form-select" name="asset_id" id="asset_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select asset') }} --</option>
                
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}" {{ isset($assetItem) && $assetItem->asset_id == $asset->id ? 'selected' : (old('asset_id') == $asset->id ? 'selected' : '') }}>
                        {{ $asset->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="purchasing_no">{{ __('Purchasing No') }}</label>
            <input type="text" name="purchasing_no" id="purchasing_no" class="form-control @error('purchasing_no') is-invalid @enderror" value="{{ isset($assetItem) ? $assetItem->purchasing_no : old('purchasing_no') }}" placeholder="{{ __('Purchasing No') }}" />
            @error('purchasing_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="purchasing_date">{{ __('Purchasing Date') }}</label>
            <input type="date" name="purchasing_date" id="purchasing_date" class="form-control @error('purchasing_date') is-invalid @enderror" value="{{ isset($assetItem) && $assetItem->purchasing_date ? $assetItem->purchasing_date->format('Y-m-d') : old('purchasing_date') }}" placeholder="{{ __('Purchasing Date') }}" required />
            @error('purchasing_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">{{ __('Status') }}</label>
            <input type="text" name="status" id="status" class="form-control @error('status') is-invalid @enderror" value="{{ isset($assetItem) ? $assetItem->status : old('status') }}" placeholder="{{ __('Status') }}" required />
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="category_id">{{ __('Category') }}</label>
            <select class="form-select" name="category_id" id="category_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select category') }} --</option>
                
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($assetItem) && $assetItem->category_id == $category->id ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}>
                        {{ $category->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="company_id">{{ __('Company') }}</label>
            <select class="form-select" name="company_id" id="company_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select company') }} --</option>
                
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ isset($assetItem) && $assetItem->company_id == $company->id ? 'selected' : (old('company_id') == $company->id ? 'selected' : '') }}>
                        {{ $company->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="created_by">{{ __('User') }}</label>
            <select class="form-select" name="created_by" id="created_by" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ isset($assetItem) && $assetItem->created_by == $user->id ? 'selected' : (old('created_by') == $user->id ? 'selected' : '') }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="updated_by">{{ __('User') }}</label>
            <select class="form-select" name="updated_by" id="updated_by" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ isset($assetItem) && $assetItem->updated_by == $user->id ? 'selected' : (old('updated_by') == $user->id ? 'selected' : '') }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>