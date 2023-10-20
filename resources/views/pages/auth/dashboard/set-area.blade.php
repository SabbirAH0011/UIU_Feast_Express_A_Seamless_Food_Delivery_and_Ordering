@extends('frontend.layouts.dashboard-master')
@section('content')
<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive py-5">
                    <table class="table table-bordered border-success text-normal">
                        <thead>
                            <th>Name</th>
                            <th>Delivery Charge</th>
                            <th>Free shipping</th>
                            <th>Free shippiing cost</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @forelse($get_location as $location)
                            <tr>
                                <td>{{ $location->location }}</td>
                                <td>{{ $location->delivary_charge }}</td>
                                <td>{{ $location->is_free_shipping }}</td>
                                <td>{{ $location->free_shipping_price }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No location found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $get_location->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="m-2">
                    <form action="{{ route('submit.location') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Area <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="area" name="area" required>
                            @error('area')
                            <span class="text-danger text-center">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Delivary Charge <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="delivery_charge" name="delivery_charge" required>
                            @error('delivery_charge')
                            <span class="text-danger text-center">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_free_shipping" name="is_free_shipping">
                            <label class="form-check-label">Is it in free shipping method?</label>
                        </div>
                        <div class="mb-3 shipping_field" style="display: none;">
                            <label class="form-label">Free shipping on <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text">&#2547;</div>
                                <input type="number" class="form-control" id="free_shipping_price" name="free_shipping_price">
                                @error('free_shipping_price')
                                <span class="text-danger text-center">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('change', '#is_free_shipping', function () {
            if ($(this).is(':checked') === true) {
                $('.shipping_field').css('display', 'block');
            } else {
                $('.shipping_field').css('display', 'none');
            }
        });
    });
</script>
@endsection
