@extends('blank')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update Exciting Offer</h6>
                @if (session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>                
                @endif
                <form class="forms-sample" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="event_text">Event Text</label>
                        <input type="text" name="event_text" class="form-control" id="event_text" value="{{ $data->event_text }}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" name="contact" class="form-control" id="contact" value="{{ $data->contact }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $data->address }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="arrival_link">New Arrival Link</label>
                                <input type="text" name="arrival_link" class="form-control" id="arrival_link" value="{{ $data->arrival_link }}">
                            </div>                            
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="facebook" class="form-control" id="facebook" value="{{ $data->facebook }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="whatsapp">What's App</label>
                                <input type="text" name="whatsapp" class="form-control" id="whatsapp" value="{{ $data->whatsapp }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="messenger">Messenger</label>
                                <input type="text" name="messenger" class="form-control" id="messenger" value="{{ $data->messenger }}">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="copyright">Copyright</label>                                
                                <textarea class="form-control" name="copyright" id="copyright" cols="30" rows="4">{{ $data->copyright }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="footer_text">Footer Text</label>                                
                                <textarea class="form-control" name="footer_text" id="footer_text" cols="30" rows="4">{{ $data->footer_text }}</textarea>
                            </div>
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="header_logo">Header Logo</label>
                                <input type="file" name="header_logo" class="form-control mb-2" id="header_logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <img id="blah" src="{{ asset('uploads') }}/theMart/{{ $data->header_logo }}" height="100" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="order_place">Order Placed Text</label>                                
                                <textarea class="form-control" name="order_place" id="order_place" cols="30" rows="4">{{ $data->order_place }}</textarea>
                            </div>
                        </div>
                    </div>                   

                    <button type="submit" class="btn btn-success mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>    
</div>
@endsection