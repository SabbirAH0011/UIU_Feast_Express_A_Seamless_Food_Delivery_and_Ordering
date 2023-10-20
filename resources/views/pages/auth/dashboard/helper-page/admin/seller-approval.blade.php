@extends('layouts.dashboard-master')
@section('site_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive py-5">
                    <table class="table table-bordered border-success text-normal">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aapproval</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @forelse($get_shop as $shop)
                            <tr>
                                <td>{{ $shop->name }}</td>
                                <td>{{ $shop->email }}</td>
                                <td>{{ $shop->status }}</td>
                                <td>{{ $shop->permission }}</td>
                                <td>
                                    @if($shop->permission === 'Pending')
                                    <a href="{{ route('update.pending_approval',[
                                    'email' => $shop->email,
                                    'permission' => 'Approved',
                                    ]) }}" class="btn" id="fetch_details">Make as Approved</a>
                                    @else
                                    <a href="{{ route('update.pending_approval',[
                                    'email' => $shop->email,
                                    'permission' => 'Pending',
                                    ]) }}" class="btn" id="fetch_details">Make as Pending</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Shop registered</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
