@extends('blank')
@section('content')
<form class="forms-sample" method="POST" action="{{ route('about.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Fabrics Information</h6>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>                
                    @endif
                        <div class="form-group">
                            <label for="exampleInputHeadding1">Headding</label>
                            <input type="text" name="headding" class="form-control" id="exampleInputHeadding1" value="{{ $data->headding }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTitle1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputTitle1" value="{{ $data->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="7">{{ $data->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" class="form-control mb-2" id="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img id="blah" src="{{ asset('uploads') }}/theMart/{{ $data->photo }}" height="100" />
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Update</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Fabrics Information</h6>
                    @if (session('success2'))
                    <div class="alert alert-success" role="alert">{{ session('success2') }}</div>                
                    @endif                
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input type="text" name="title2" class="form-control" id="Title" value="{{ $data->title2 }}">
                        </div>
                        <div class="form-group">
                            <label for="desp2">Description</label>
                            <textarea name="desp2" class="form-control" id="desp2" cols="30" rows="7">{{ $data->desp2 }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link2" class="form-control" id="link" value="{{ $data->link2 }}">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Update</button>
                </div>
            </div>
        </div>
    </div>    
</form>
@endsection