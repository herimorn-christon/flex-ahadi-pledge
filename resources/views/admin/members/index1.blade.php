@extends('layouts.master')

@section('title','Dashboard')


@section('content')
<div class="row mb-1">
  <div class="col-sm-6">
    @if (session('status'))
    <div class="alert disabled" style="background-color: rgb(198, 253, 216)" role="alert">
        {{ session('status') }}
    </div>
    @endif
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="">  
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registerModal">
          <i class="fa fa-user-plus"></i>
           Register Member
      </button>  
  </li>
     
    </ol>
    
  </div><!-- /.col -->
</div>
<div class="card mt-1">
    <div class="card-header bg-light">
        <h6 class="text-light">
            {{-- All Members --}}
          
        </h6>
    </div>
    <div class="card-body">




        <div class="row">
            <table id="mytable" class="table table-bordered table-datatable ">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Full Name</th>
                        <th>Community (Jumuiya)</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->community->abbreviation }}/{{ $item->id }}</td>
                        <td>{{ $item->fname }} &nbsp; {{ $item->mname }} &nbsp;  {{ $item->lname }}</td>
                       
                        <td>
                            {{ $item->community->name }}
                        </td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td>
                            {{ $item->gender }}
                        </td>
                        <td class="text-success">{{ $item->status=='1'? 'Disabled':'Active' }}</td>
                        <td>
                            <a 

                            href="{{ url('admin/view-member/'.$item->id)}}" 
    
                            class="btn btn-primary btn-sm"
                            >
                        <i class="fa fa-eye"></i>
                          </a>
                            <a href="{{ url('admin/edit-member/'.$item->id)}}" class="btn btn-secondary btn-sm mx-1">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/delete-member/'.$item->id)}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>



    </div>
</div>



  <!-- Register User Modal  -->

  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1250px;">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('admin/add-member') }}">
                @csrf
                <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="fname" class="text-secondary">{{ __('First Name') }}</label>

                    <div class="form-group">
                        <input id="fname" type="text" placeholder="Enter First Name" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

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
                        <input id="mname" type="text" placeholder="Enter Middle Name" class="form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

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
                        <input id="lname" type="text" placeholder="Enter Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="name" autofocus>

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
                        <input id="phone" type="text" placeholder="Enter Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

        
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="email" class="text-secondary">{{ __('Email Address') }}</label>

                    <div class="form-group">
                        <input id="email" type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        
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
                         <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6">
                    <label for="card_no" class="text-secondary">Birthdate</label>
                    <div class="form-group form-primary mb-3"> 
                        <input id="password" type="date" class="form-control" name="date_of_birth" placeholder="" > </div>
                </div>

            <div class="col-lg-6">
                <label for="gender" class="text-secondary">Gender</label>
                <div class="row mx-1 ">
                    
                  <div class="col-md-4 form-check form-check-inline"><input type="radio" id="male"   name="gender" value="male" class="form-check-input">
                    <label class="form-check-label" for="male" >Male</label></div>
                  <div class="col-md-4 form-check form-check-inline"><input type="radio" id="female"  name="gender" value="female" class="form-check-input">
                    <label class="form-check-label" for="female">Female</label></div>
                </div>
            
            </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="text-secondary">{{ __('Password') }}</label>

                    <div class="form-group">
                        <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3 text-secondary">
                    <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                    <div class="form-group">
                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="col-md-12 mb-0 ">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block text-decoration-none text-light bg-primary btn-block col-lg-12">
                                {{ __('Save Member') }}
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
@endsection