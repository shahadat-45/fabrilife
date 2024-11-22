@extends('blank')

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delivery</li>
    </ol>
</nav>

<div class="row">    
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">          
                <div class="card-body">
                    <h6 class="card-title">Delivery Charge list</h6>
                    @if (session('delete_success'))
                    <div class="alert alert-success" role="alert">{{ session('delete_success') }}</div>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>                                        
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $delivery as $key=> $delivery )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $delivery->title }}</td>
                                        <td>{{ $delivery->charge }}</td>
                                        <td><button onclick="updateDelivery({{ $delivery->id }})" type="button" class="btn btn-warning btn-icon">
                                            <i data-feather="share"></i>
                                        </button></td>
                                    </tr>               
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card insertUpdate">
        <div class="card" style="max-height: 300px;">
            <div class="card-body">
                <h6 class="card-title">Create Delivery Charges</h6>
                @if (session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <form class="forms-sample" action="{{ route('insert.delivery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-1">
                        <label class="mt-2" for="name">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="example">
                    </div>
                    @error('delivery')
                    <strong class="text-danger mb-2">{{ $message }}</strong>
                    @enderror
                    <div class="form-group mb-1">
                        <label class="mt-2" for="name">Amount</label>
                        <input type="number" class="form-control" name="charge" placeholder="example">
                    </div>                                              
                    <button type="submit" class="btn btn-primary mr-2 mt-2">Insert</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card updateDelivery d-none">
        <div class="card" style="max-height: 300px;">
            <div class="card-body">
                <h6 class="card-title">Update Delivery Charges</h6>                
                <form class="forms-sample updateAttr" action="" method="POST">
                    @csrf
                    <div class="form-group mb-1">
                        <label class="mt-2" for="name">Title</label>
                        <input type="text" class="form-control updateTitle" name="title" value="">
                    </div>
                    <div class="form-group mb-1">
                        <label class="mt-2" for="name">Amount</label>
                        <input type="number" class="form-control updateAmount" name="charge" value="">
                    </div>                                              
                    <button type="submit" class="btn btn-success mr-2 mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection
@section('footer-script')
<script>
    function updateDelivery(id) {
        $.ajax({
            url: '/delivery/push', // Adjust this to your route
            type: 'GET',
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(response) {
                $('.insertUpdate').addClass('d-none');
                $('.updateDelivery').removeClass('d-none');
                if (response.success) {
                    $('input.updateTitle[name=title]').val(response.data.title);
                    $('input.updateAmount[name=charge]').val(response.data.charge);
                    $('form.updateAttr').attr('action', `http://127.0.0.1:8000/delivery/update/${response.data.id}`);
                } else {
                    alert('Failed to update delivery!');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection