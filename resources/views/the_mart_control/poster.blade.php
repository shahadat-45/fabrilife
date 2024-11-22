@extends('blank')
@section('content')
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                <h6 class="card-title">Poster Table</h6>
                <p class="card-description">Your poster size must have <code> 500 X 500 </code></p>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @elseif (session('delete'))   
                    <div class="alert alert-success" role="alert">{{ session('delete') }}</div> 
                @endif
                <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    {{-- <th>SL</th> --}}
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($poster as $index => $poster)
                                <tr>
                                    {{-- <th>{{ $index + 1 }}</th> --}}
                                    <td>{{ $poster->title }}</td>
                                    <td>{{ $poster->link }}</td>
                                    <td>
                                        @if ($poster->status == 1)
                                            <button type="button" style="padding: 0.4rem 1rem 0.3rem" class="btn btn-sm btn-danger">First Slide</button>
                                            @elseif ($poster->status == 2)
                                            <button type="button" style="padding: 0.4rem 1rem 0.3rem" class="btn btn-sm btn-secondary">(1) Product Slide</button>
                                            @elseif ($poster->status == 3)
                                            <button type="button" style="padding: 0.4rem 1rem 0.3rem" class="btn btn-sm btn-primary">(2) Product Slide</button>
                                            @elseif ($poster->status == 4)
                                            <button type="button" style="padding: 0.4rem 1rem 0.3rem" class="btn btn-sm btn-info">Second Slide</button>
                                            @elseif ($poster->status == 5)
                                            <button type="button" style="padding: 0.4rem 1rem 0.3rem" class="btn btn-sm btn-success">(3) Product Slide</button>
                                            @elseif ($poster->status == 0)
                                            <button type="button" style="padding: 0.4rem 1rem 0.3rem" class="btn btn-sm btn-light">No Slide</button>
                                        @endif
                                    </td>

                                    <td><img src="{{ asset('uploads') }}/theMart/poster/{{ $poster->image }}" alt="{{ $poster->image }}" width="200px"></td>
                                    <td>
                                        {{-- <a href="{{ route('poster.delete', $poster->id) }}"><button type="button" class="btn btn-danger btn-icon"> <i data-feather="trash"></i> </button></a> --}}
                                    <form action="{{ route('poster.status' , $poster->id) }}" method="POST">
                                        @csrf
                                        <div class="btn-group">
                                            <button class="btn btn-light btn-sm" type="button">
                                              Change Status
                                            </button>
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button name="status" value="1" class="dropdown-item" type="submit">First Slide</button>
                                                <button name="status" value="2" class="dropdown-item" type="submit">(1) Product Slide</button>
                                                <button name="status" value="3" class="dropdown-item" type="submit">(2) Product Slide</button>
                                                <button name="status" value="4" class="dropdown-item" type="submit">Second Slide</button>
                                                <button name="status" value="5" class="dropdown-item" type="submit">(3) Product Slide</button>
                                            </div>
                                        </div>
                                    </form>
                                    </td>
                                </tr> 

                                @endforeach
                            </tbody>
                        </table>
                </div>
          </div>
        </div>
    </div>
    <div class="col-md-4 ml-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Poster </h6>
                <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{ route('poster.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Image</label>
                        <input type="file" class="form-control mb-1" name="image" id="exampleInputUsername1" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" onclick="document.getElementById('blah').classList.replace('d-none', 'd-block')">
                        <img class="mt-2 d-none" height="184px" id="blah">
                        @error('image')                            
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control mb-1" name="title" id="exampleInputEmail1" placeholder="Entre a title">
                        @error('title')                            
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Link</label>
                        <input type="text" class="form-control" name="link" id="exampleInputPassword1" placeholder="Enter redirection link">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection