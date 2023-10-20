@extends('layouts.dashboard-master')
@section('site_content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        @include('pages.auth.dashboard.helper-page.seller.set-menue-insert')
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <p class="text-normal">Registered Product List</h5>
            </div>
            <div class="card-body">
                <div class="mt-2 mb-2">
                    <div class="table-responsive">
                        <table class="table table-bordered border-success text-normal">
                            <thead>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th></th>
                            </thead>
                            @forelse($get_menu as $product)
                            <tr>
                                <td><img src="{{ asset($product->img) }}" alt="{{ $product->name }}"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->prev_price }}</td>
                                <td>{{ $product->start_price }}</td>
                                <td>
                                    <div class="btn-group">
                                       <!--  <a href="" class="btn btn-primary">Edit</a> -->
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No item found</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $get_menu->withQueryString()->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
