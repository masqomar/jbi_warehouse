<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($devision) ? $devision->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="company_id">{{ __('Company') }}</label>
            <select class="form-select" name="company_id" id="company_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select company') }} --</option>
                
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ isset($devision) && $devision->company_id == $company->id ? 'selected' : (old('company_id') == $company->id ? 'selected' : '') }}>
                        {{ $company->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>