<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="mutation_id">{{ __('Mutation') }}</label>
            <select class="form-select" name="mutation_id" id="mutation_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select mutation') }} --</option>
                
                @foreach ($mutations as $mutation)
                    <option value="{{ $mutation->id }}" {{ isset($mutationFrom) && $mutationFrom->mutation_id == $mutation->id ? 'selected' : (old('mutation_id') == $mutation->id ? 'selected' : '') }}>
                        {{ $mutation->mutation_code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="placement_id">{{ __('Placement') }}</label>
            <select class="form-select" name="placement_id" id="placement_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select placement') }} --</option>
                
                @foreach ($placements as $placement)
                    <option value="{{ $placement->id }}" {{ isset($mutationFrom) && $mutationFrom->placement_id == $placement->id ? 'selected' : (old('placement_id') == $placement->id ? 'selected' : '') }}>
                        {{ $placement->placement_code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="asset_item_id">{{ __('AssetItem') }}</label>
            <select class="form-select" name="asset_item_id" id="asset_item_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select assetitem') }} --</option>
                
                @foreach ($assetItems as $assetItem)
                    <option value="{{ $assetItem->id }}" {{ isset($mutationFrom) && $mutationFrom->asset_item_id == $assetItem->id ? 'selected' : (old('asset_item_id') == $assetItem->id ? 'selected' : '') }}>
                        {{ $assetItem->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>