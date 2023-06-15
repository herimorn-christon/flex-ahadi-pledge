@extends('layouts.profile_master')

@section('title','My Pledges')


@section('content')  
<?php
$user=Auth::User()->id;
$i=1;
$dependants=App\Models\User::find($user)->dependant;


?>
<div id="layout-wrapper">
    <div class="vertical-overlay"></div>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="profile-foreground position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg">
                           
                        </div>
                    </div>
                    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper position-relative" style="background:black">
                        <img src="{{ asset('herimorn/assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img"
                        style="position:absolute;opacity:0.5;width:100%" />
                        <div class="row g-4">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img id="show_image" src="{{ (!empty(Auth::user()->profile_picture))? url(
                                        'uploads/user/'.Auth::user()->profile_picture
                                    ):url('uploads/user/no_image.jpg')}}" class="img-thumbnail rounded-circle"
                                    style="width:256px;height:256px"/>

                                </div>
                            </div>
                            <!--end col-->
                            <div class="col">
                                <div class="p-2">
                                    <h3 class="text-white mb-1"
                                    style="text-transform:capitalize">{{Auth::User()->fname}} {{ Auth::user()->mname }}
                                    {{ Auth::user()->lname }}</h3>
                                   
                                    <div class="hstack text-white-50 gap-1">
                                        <div class="me-2" style="text-transform:capitalize;color:white">
                                            {{ Auth::user()->proffession }},</div>
                                        <div>
                                            <i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          

                        </div>
                        <!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="d-flex profile-wrapper">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block" 
                                                style="text-transform:capitalize"><strong><span style="color:white">Overview</span></strong></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                                <i class="ri-list-unordered d-inline-block d-md-none"
                                                style="text-transform:capitalize;color:white"></i> <span class="d-none d-md-inline-block" style="color:white">
                                                    <strong>spiritual information</strong></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab"
                                            style="text-transform:capitalize">
                                                <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block"
                                                style="color:white">dependants</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab"
                                            style="text-transform:capitalize">
                                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block"
                                                style="color:white">activate dependants</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                                            Edit Profile
                                          </button>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content pt-4 text-muted" style="text-transform:capitalize">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        {{-- <h5 class="card-title mb-5">Complete Your Profile</h5> --}}
                                                        <br>
                                                        {{-- <div class="progress animated-progress custom-progress progress-label">
                                                            <div class="progress-bar bg-secondary"
                                                             role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="label">30%</div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">Info</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Full Name :</th>
                                                                        <td class="text-muted">{{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Mobile :</th>
                                                                        <td class="text-muted">{{ Auth::user()->phone }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">E-mail :</th>
                                                                        <td class="text-muted">{{ Auth::user()->email }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">birthdate</th>
                                                                        <td class="text-muted">{{ Auth::user()->date_of_birth }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">gender</th>
                                                                        <td class="text-muted">{{ Auth::user()->gender }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div>
                                            <!--end col-->
                                          
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <div class="tab-pane fade" id="activities" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">spirtual information</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Deacon name:</th>
                                                                <td class="text-muted">{{ Auth::user()->deacon_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Deacon Phone:</th>
                                                                <td class="text-muted">{{ Auth::user()->deacon_phone}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">fellowship name:</th>
                                                                <td class="text-muted">{{ Auth::user()->fellowship_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">baptism date</th>
                                                                <td class="text-muted">{{ Auth::user()->baptization_date}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">kipaimara date</th>
                                                                <td class="text-muted">{{ Auth::user()->kipaimara_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Marriage date</th>
                                                                <td class="text-muted">{{ Auth::user()->marriage_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Place of marriage</th>
                                                                <td class="text-muted">{{ Auth::user()->place_of_marriage}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">patner name</th>
                                                                <td class="text-muted">{{ Auth::user()->partner_name }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                        <!--end card-->
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane fade" id="projects" role="tabpanel">
                                        
                                        <div class="card">
                                            <div class="card-body">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                style="float:right;margin:10px">
                                                    <i class="fa fa-user-plus"></i>
                                                     Create Dependants
                                                </button>  
                                                <table id="example1" class="table table-bordered cell-border">
                                                    <thead>
                                                        <tr class="text-secondary">
                                                            <th>SN</th>
                                                            <th>username</th>
                                                            <th>birthdate</th>
                                                            <th>relationship</th>
                                                            <th>action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="members-table-body"> 
                                                    @foreach ($dependants as $dependant )
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $dependant->fullName }}</td>
                                                        <td>{{ $dependant->birth_date }}</td>
                                                        <td>{{ $dependant->relationship }}</td>
                                                        <td>
                                                        <div style="display:flex;">
                                                                <form action="{{ route('member_dependant.destroy',$dependant->id) }}" method="POST">
                                                                 @csrf
                                                                 <button type="submit" style="background:blue" class="btn btn-sm btn-danger"><i class="fa fa-recycle" style="color:white" aria-hidden="true" ></i></button>
                                                                </form>
                                                        <button type="button" class="btn btn-sm btn-danger">
                                                            <a href={{ route('member_dependant.edit',$dependant->id) }}>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-pencil-square text-danger" viewBox="0 0 16 16" style="color:white">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            </svg>
                                                            </a>
                                                       </button>
                                                        {{-- <button style="background:grey"> 
                                                        
                                                        </a>
                                                    </button> --}}
                                                        </td>
                                                        </div>
                                                    </tr>
                                                    @endforeach
                                    
                                                    </tbody>
                                                </table>
  
                                                {{-- the table overview to show all the dependants --}}
                                                {{-- end of the table to show all the dependants --}}
                                                 

                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane fade" id="documents" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5 class="card-title flex-grow-1 mb-0">trashed dependants</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">
                                                            <table id="example1" class="table table-bordered cell-border">
                                                                <thead>
                                                                    <tr class="text-secondary">
                                                                        <th>SN</th>
                                                                        <th>username</th>
                                                                        <th>birthdate</th>
                                                                        <th>relationship</th>
                                                                        <th>action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="members-table-body">
                                                                  @foreach ($points as $dependant )
                                                                  <tr>
                                                                    <th scope="row">{{ $i++ }}</th>
                                                                    <td>{{ $dependant->fullName }}</td>
                                                                    <td>{{ $dependant->birth_date }}</td>
                                                                    <td>{{ $dependant->relationship }}</td>
                                                                    <td>
                                                                      <div style="display:flex;">
                                                                       <a class="" href={{ route('member.restore',$dependant->id) }} >
                                                                       <button type="submit" style="background:rgb(0, 46, 91)" class="btn btn-sm btn-danger"><i class="fa fa-trash-restore" style="color:white" aria-hidden="true" ></i></button>
                                                                       </a>  
                                                                    </div>
                                                                 
                                                                     </td>
                                                                    </div>
                                                                  </tr>
                                                                  @endforeach
                                                
                                                                </tbody>
                                                            </table>
                                                  
                                                        </div>
                                                        <div class="text-center mt-3">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                                <!--end tab-content-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

        </div><!-- end main content-->
</div>
<!--now lets open the model-->
<form  id="form1">
    @csrf
    <div class="modal fade" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Dependant</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-1" style="height:4rem">
              <input type="hidden" class="form-control" value="{{$user}}"
                name="users_dependant"/>
          <span id="parent" class="text-danger error_messages"></span>
            </div>
            <div class="form-group mb-3">
              <label for="">Dependant Name</label>
              <input type="text" name="dependant_name" class="form-control">
              <span id="dependants" class="text-danger error_messages"></span>
            </div>
            <div class="form-group mb-3">
              <label for="">Relationship</label>
              <input type="text" name="relationship" class="form-control">
              <span id="relationship" class="text-danger error_messages"></span>
            </div>
            <div class="form-group mb-3">
              <label for="">Birthdate</label>
              <input type="date" name="birth_date" class="form-control">
              <span id="birthdate" class="text-danger error_messages"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save">Save dependant</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  

  <!--closing the model -->
  <!--closing the model -->
  <!--starting the update profile models -->
 
    
  <!--ending the update profile models -->
  <form method="post" enctype="multipart/form-data" 
action="{{ route('admin.profile.stores') }}">
    @csrf
  <div class="modal fade" id="exampleModalScrollable" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px;">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
      
               
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="firstname" class="form-label"
                            style="color:black;font-weight:500">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="fname"
                            value="{{ Auth::user()->fname }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mname" class="form-label"
                            style="color:black;font-weight:500">Middle Name</label>
                            <input type="text" class="form-control" id="lastname" name="mname" 
                            value="{{ Auth::user()->mname }}" placeholder="Enter last name">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter last name"
                            name="lname" value="{{ Auth::user()->lname}}">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Phone</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter phone number" name="phone"
                            value="{{ Auth::user()->phone }}">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Email</label>
                            <input type="email" class="form-control" id="lastname" placeholder="please inter your email" name="email"
                            value="{{ Auth::user()->email }}">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Gender</label>
                            <br>
                          <select required  class="form-control" name="gender" value={{ Auth::user()->gender }}>
                              <option disabled selected>Select gender</option>
                              <option value="male">Male</option>
                              <option value="female">female</option>
                          </select>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Birthdate</label>
                            <input type="date" class="form-control" id="lastname" placeholder="please inter your email" name="date_of_birth"
                            value="{{ Auth::user()->date_of_birth }}">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Marital Status</label>
                            <br>
                          <select required name="marital_status" class="form-control" id="marital_status" name="martial_status">
                              <option disabled selected>Select status</option>
                              <option value="1">Married</option>
                              <option value="2">Single</option>
                              <option value="3">Widow</option>
                              <option value="4">divorced</option>
                             
                          </select>
                        </div>
                    </div> 
                    <div class="col-md-6" style="display:none" id="marriage_date">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Marriage Date</label>
                            <input type="date" class="form-control"  placeholder="please inter your email" name="marriage_date"
                            value="{{ Auth::user()->marriage_date}}">
                        </div>
                    </div> 
                    <div class="col-md-6" style="display:none" id="marriage_type">
                        <div class="mb-3">
                            <label> Marriage Type</label>
                            <br>
                          <select required name="marriage_type" class="form-control"  
                          value="{{ Auth::user()->marriage_type}}">
                              <option disabled selected>Select marriage type</option>
                              <option value="1">christian </option>
                              <option value="2">others</option>
                            
                          </select>
                        </div>
                    </div> 
                    <div class="col-md-6" style="display:none" id="marriage_patner">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Marriage Patner</label>
                            <input type="text" class="form-control"  placeholder="" name="partner_name" value="{{ Auth::user()->partner_name }}"
                            value="{{ Auth::user()->date_of_birth }}">
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label>occupation</label>
                        <br>
                      <select required  class="form-control" id="occupation"
                      name="occupation" value={{ Auth::user()->occupation }}>
                          <option disabled selected>select occupation</option>
                          <option value="1">Employed</option>
                          <option value="2">UnEmployed</option>
                          <option value="3">student</option>
                      </select>
                    </div>
                    </div> 
                    <div class="col-md-6" id="proffession" style="display:none" >
                        <div class="mb-3">
                        <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Proffession </label>
                            <input type="text" class="form-control"  name="proffession"  value="{{ Auth::user()->proffession }}"/>
                         
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>baptized</label>
                            <br>
                          <select required name="baptized" class="form-control" id="baptized"
                        value={{ Auth::user()->baptized }}>
                              <option disabled selected>Select Occupation</option>
                              <option value="0">No</option>
                              <option value="1">Yes</option>
                          </select>
                        </div>
                    </div> 
                    <div class="col-md-6" id="baptization_date">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Baptization Date</label>
                            <input type="date" class="form-control"  name="baptization_date"
                            value="{{ Auth::user()->baptization_date }}">
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label> Kipaimara</label>
                            <br>
                          <select required name="kipaimara" class="form-control" id="kipaimara"
                        value={{ Auth::user()->kipaimara}}>
                              <option disabled selected>have you get kipaimara?</option>
                              <option value="0">No</option>
                              <option value="1">Yes</option>
                          </select>
                        </div>
                    </div> 
                    <div class="col-md-6" id="kipaimara_date">
                        <div class="mb-3">
                            <label for="lastname" class="form-label"
                            style="color:black;font-weight:500">Kipaimara Date</label>
                            <input type="date" class="form-control"  name="kipaimara_date"
                            value="{{ Auth::user()->kipaimara_date}}">
                        </div>
                    </div> 
                    <div class="col-md-12">
                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label"
                        style="color:black;font-weight:500">Admin Profile Image</label>
                        <input type="file" id="image" class="form-control" name="profile_picture">
                    </div>
                     </div> 
                      {{-- starting of the preview image --}}
                      {{-- <div class="col-md-12">
                        <div class="mb-3">
                            <label for="example-fileinput" class="form-label"></label>
                            <img id="show_image" src="{{ (!empty(Auth::user()->profile_picture))? url(
                                'uploads/user/'.Auth::user()->profile_picture
                            ):url('uploads/user/no_image.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                            alt="profile-image" style="width:4rem">
                        </div>
                         </div>  --}}
                          
                      {{-- end of the image preview --}}
                      
                </div> <!-- end row -->  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
    //fetching fata with the ajax call without the page reloding
  
    
      $("#save").click(function(){
       // console.log("button-clicked");
                 var forms=$('#form1')[0];
                  var formData=new FormData(forms); 
                  $('.error_messages').html('');
                 // console.log(formData);
                //console.log(formData);
                $.ajaxSetup({
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                        });
    
    
                        $.ajax({
                          url:"{{ route('adminAddDependant.store')}}",
                          method:'POST',
                          processData:false,
                           contentType:false,
                          data:formData,
                          success: function (response) {
                            $("#exampleModal").modal("hide");
                               location.reload() 
                            //$("#exampleModal").modal("hide");
                          swal("welldon!",response.success, "success", {
                              button: "ok",
                               });
                          },
                          error:function(error){
                              console.log(error);
                            
                              $('#parent').html(error.responseJSON.errors.users_dependant);
                              $('#dependants').html(error.responseJSON.errors.dependant_name);
                              $('#relationship').html(error.responseJSON.errors.relationship);
                              $('#birthdate').html(error.responseJSON.errors.birth_date);
                              
                            //console.log(error.responseJSON.errors.users_dependant);
                            //console.log(error.responseJSON.errors.dependant_name);
                            //console.log(error.responseJSON.errors.relationship);
                            // console.log(error.responseJSON.errors.birth_date);
                             
                        }
                        });
    
              })
    
              //sending th
    
    </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
              $('#image').change(function(e){
                       var image=$('#image');
                     
                  var reader=new FileReader();
                  reader.onload=function(e){
                      $('#show_image').attr('src',e.target.result);
                  }
                  reader.readAsDataURL(e.target.files['0']);
      
              })
          });
      </script>
      
      <script>
      $(document).ready(function() {
        $('#marital_status').change(function() {
          var selectedValue = $(this).val();
      
          // show/hide Marriage Type and Marriage Date fields
          if (selectedValue === '1') {
            $('#marriage_type').show();
            $('#marriage_date').show();
            $('#marriage_patner').show();
          } else {
            $('#marriage_type').hide();
            $('#marriage_date').hide();
            $('#marriage_patner').hide();
          }
      
        });
        
        //selecting for the occupation
        $('#occupation').change(function() {
          var selectedValue = $(this).val();
      
          // show/hide Marriage Type and Marriage Date fields
          if (selectedValue === '1' || selectedValue === '2' ) {
            $('#proffession').show();
          } else {
            $('#proffession').hide();
          }
      
        });

        //for the baptism
        $('#baptized').change(function() {
          var selectedValue = $(this).val();
      
          // show/hide Marriage Type and Marriage Date fields
          if (selectedValue === '1') {
            $('#baptization_date').show();
          } else {
            $('#baptization_date').hide();
          }
      
        });
        //for kipaimara

        $('#kipaimara').change(function() {
          var selectedValue = $(this).val();
      
          // show/hide Marriage Type and Marriage Date fields
          if (selectedValue === '1' ) {
            $('#kipaimara_date').show();
          } else {
            $('#kipaimara_date').hide();
          }
      
        });
      });
      //for the baptism 
      


      //for the kipaimara
      </script>
@endsection