<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="table-responsive p-1">
                    <table class="table table-hover table-bordered table-stripped" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Placement ID</th>
                                <th class="text-center">Asset Item ID</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($placementAssets as $key => $product)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{ $product->placement_id }}</td>
                                <td>{{ $product->asset_item_id }}</td>
                                <td>
                                    <a href="{{ route('mutations.add.to.cart', $product->id) }}" class="btn btn-outline-success btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <h6><strong>Detail Mutation Items</strong></h6>
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Place ID</th>
                    <th style="width:10%">Asset Code</th>
                    <th style="width:10%"></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                <tr data-id="{{ $id }}">
                    <td>
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['placement_id'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td>${{ $details['asset_item_id'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">
                        <h6><strong>Total Asset Item {{ $total }}</strong></h6>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="form-group">
            <label for="placement_description">{{ __('Placement Description') }}</label>
            <textarea name="placement_description" id="placement_description" class="form-control @error('placement_description') is-invalid @enderror" placeholder="{{ __('Placement Description') }}">{{ isset($mutation) ? $mutation->description : old('placement_description') }}</textarea>
            @error('placement_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>



<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="mutation_code">{{ __('Mutation Code') }}</label>
            <input type="text" name="mutation_code" id="mutation_code" class="form-control @error('mutation_code') is-invalid @enderror" value="" placeholder="{{ 'MA' .'-'. date('mY') . '-' . str_pad($mutationCode, 5, '0', STR_PAD_LEFT) }}" readonly />
            @error('mutation_code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ isset($mutation) && $mutation->date ? $mutation->date->format('Y-m-d') : old('date') }}" placeholder="{{ __('Date') }}" required />
            @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="condition">{{ __('Condition') }}</label>
            <select name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror">
                <option value="Bagus">{{__('Bagus') }}</option>
                <option value="Rusak">{{__('Rusak') }}</option>
            </select>
            @error('condition')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($mutation) ? $mutation->description : old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="room_id">{{ __('Room') }}</label>
            <select class="form-select" name="room_id" id="room_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select room') }} --</option>

                @foreach ($room as $ruang)
                <option value="{{ $ruang->id }}">
                    {{ $ruang->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="staff_id">{{ __('PIC') }}</label>
            <select class="form-select" name="staff_id" id="staff_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select PIC') }} --</option>

                @foreach ($pics as $pic)
                <option value="{{ $pic->id }}">
                    {{ $pic->name }} || {{ $pic->devision->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/styles/css/choices.css" integrity="sha512-0bYNWBaGnMqLCuum81OA7oZo7/pIEjWb/ad3vdKuKlgTZXalLMDkRT3P4Z262/aQBnNuznUg3WpTb5Vgu11abw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js" integrity="sha512-7PQ3MLNFhvDn/IQy12+1+jKcc1A/Yx4KuL62Bn6+ztkiitRVW1T/7ikAh675pOs3I+8hyXuRknDpTteeptw4Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<script type="text/javascript">
    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: "{{route('mutations.remove.from.cart')}}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endpush