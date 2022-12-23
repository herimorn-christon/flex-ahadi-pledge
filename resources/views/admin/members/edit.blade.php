@extends('layouts.master')

@section('title','Edit Member')


@section('content')


<div class="row mb-1">
    <div class="col-sm-6">
      {{-- <h1 class="m-0">Dashboard</h1> --}}
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="">    

        <a href="{{ url('admin/all-members') }}" class="btn btn-primary btn-sm"> 
        <i class="fa fa-list"></i>
        All Members
        </a>
    </li>
       
      </ol>
      
    </div><!-- /.col -->
  </div>
  @if (session('status'))
  <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
      {{ session('status') }}
  </div>
  @endif



        <div class="row">

            <div class="col-md-11 mx-auto">
                <div class="card mt-1">
                    <div class="card-header bg-light">
                        <h6 class="text-light">
                        </h6>
                    </div>
                    <div class="card-body">
                
                
                    {{--displaying all the errors  --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ url('admin/edit-member/'.$user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="fname" class="text-secondary">{{ __('First Name') }}</label>
        
                            <div class="form-group">
                                <input id="fname" value="{{ $user->fname }}" type="text" placeholder="Enter First Name" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>
        
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="mname" class="text-secondary">{{ __('Middle Name') }}</label>
        
                            <div class="">
                                <input id="mname" type="text" value="{{ $user->mname }}"  placeholder="Enter Middle Name" class="form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('fname') }}" required autocomplete="name" autofocus>
        
                                @error('mname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="text-secondary">{{ __('Last Name') }}</label>
        
                            <div class="form-group">
                                <input id="lname" type="text" value="{{ $user->lname }}" placeholder="Enter Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="name" autofocus>
        
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label text-secondary ">{{ __('phone') }}</label>
        
                            <div class="form-group">
                                <input id="phone" value="{{ $user->phone }}" type="text" placeholder="Enter Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
        
                
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="text-secondary">{{ __('Email Address') }}</label>
        
                            <div class="form-group">
                                <input id="email" value="{{ $user->email }}" type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                
                            </div>
                        </div>
        
                        @php
                        $jumuiya= App\Models\Jumuiya::get();
                        @endphp
                        <div class="col-md-6">
                            <label for="" class="text-secondary">Jumuiya (Community) </label>
                            <select name="jumuiya" class="form-control">
                                <option value="">--Select Community (Jumuiya) --</option>
                                @foreach ( $jumuiya as $item)
                                 <option value="{{ $item->id}}" {{$user->jumuiya == $item->id ? 'selected':'' }}>{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="col-lg-6">
                            <label for="birthdate" class="text-secondary">Birthdate</label>
                            <div class="form-group form-primary mb-3"> 
                                <input id="birthdate" value="{{ $user->date_of_birth }}" type="date" class="form-control" name="date_of_birth" placeholder="" > </div>
                        </div>
        
                    <div class="col-lg-6">
                        <label for="gender" class="text-secondary">Gender</label>
                        <div class="row mx-1 ">
                            
                          <div class="col-md-4 form-check form-check-inline"><input type="radio" id="male"   name="gender" value="male" class="form-check-input">
                            <label class="form-check-label" for="male" {{$user->gender == 'male' ? 'checked':'' }}>Male</label></div>
                          <div class="col-md-4 form-check form-check-inline">
                            <input type="radio" id="female"  name="gender" value="female" {{$user->gender == 'female' ? 'checked':'' }} class="form-check-input">
                            <label class="form-check-label" for="female">Female</label></div>
                        </div>
                    
                    </div>
        
        
                        <div class="col-md-12 mb-0 ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="text-secondary">Status</label>
                                        <input type="checkbox" name="status" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block text-decoration-none text-light bg-primary btn-block col-lg-12">
                                        {{ __('Update Member') }}
                                    </button>
                                </div>
                            </div>
             
                        </div>
                    </div>
                    </form>
            </div>
        </div>



    </div>
</div>


{{-- Add Community modal --}}

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h4 class="modal-title">Large Modal</h4> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('admin/edit-community') }}" method="post">
                @csrf
                <div class="row mb-3">
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="text-secondary">Pledge Type Title</label>
                        <input type="text" name="" id="name" class="form-control" placeholder="Enter Community Name">
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                     
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>
                            Update Pledge Type
                        </button>
                    </div>
                 </div>
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection