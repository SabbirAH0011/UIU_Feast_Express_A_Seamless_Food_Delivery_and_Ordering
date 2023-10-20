@extends('frontend.layouts.dashboard-master')
@section('content')
<!-- User modal -->
<div class="modal fade" id="user_model" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4 style="color: #0a7151;">Update User</h4>
                    </div>
                    <div class="my-2">
                        <form action="{{ route('update.user') }}" method="POST">
                            @csrf
                            <div class="mb-3" hidden>
                                <input type="text" class="form-control" id="user_email" name="user_email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Change path</label>
                                <select class="form-select" id="path" name="path" required="">
                                    <option value="">Choose</option>
                                    <option value="User">User</option>
                                    <option value="Raider">Raider</option>
                                </select>
                            </div>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-danger">Save</button>
                        </form>
                        <button type="button" class="btn btn-warning" id="close_user_modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal end -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive py-5">
                    <table class="table table-bordered border-success text-normal">
                    <thead>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Zone</th>
                        <th>Path</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse($user_list as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->zone }}</td>
                            <td>{{ $user->path }}</td>
                            <td><button class="btn" id="fetch_details" value="{{ $user->email }}">View</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No user registered</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        function Reload() {
            location.reload();
        }
        $(document).on('click', '#fetch_details', function (e) {
            e.preventDefault();
            const email = $(this).val();
            $('#user_model').modal('show');
            $('#user_email').val(email);
        });
        $(document).on('click', '#close_user_modal', function (e) {
            e.preventDefault();
            $('#serial').val('');
            $('#user_model').modal('hide');
            setTimeout(Reload, 500);
        });
    });
</script>
@endsection
