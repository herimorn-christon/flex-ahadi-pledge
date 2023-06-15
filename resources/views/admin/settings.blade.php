@extends('layouts.master')

@section('title','System Settings')


@section('content')


<section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2 bg-white">
              <ul class="nav nav-tabs nav-light">
                <li class="nav-item">
                  <a class="nav-link text-navy active" href="#calendar"  data-toggle="tab">Calendar & Events</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy " href="#interface"  data-toggle="tab">System Settings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#audits"  data-toggle="tab">System Audits</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#roles"  data-toggle="tab">Create Roles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#permission"  data-toggle="tab">Create pemission</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#assignRoles"  data-toggle="tab">Assign Roles to user </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-navy" href="#rolesPermission"  data-toggle="tab">Assign permission</a>
                </li>

              </ul>
            </div><!-- /.card-header -->
            <div class="">
              <div class="tab-content">
                <div class=" tab-pane" id="interface">
                  {{-- start of interface settings --}}

                    <div class="col-md-12">
                      <div class="p-2">

                          <div class="">
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif
                              <form action="{{ url('admin/settings') }}" method="post"  enctype="multipart/form-data" >
                                  @csrf
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">System Name</label>
                                      <input name="system_name"  type="text" @if($setting) value="{{ $setting->system_name}}" @endif class="form-control">
                                  </div>
                                   <div class="mb-3">
                                      <label for="" class="text-secondary">System Logo</label>
                                      <input name="logo" type="file" class="form-control">
                                      <img src="{{ asset('uploads/settings/'.$setting->logo)}}" width="20px" height="20px">

                                  </div>
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">System Favicon</label>
                                      <input name="favicon" type="file" class="form-control">

                                      <img src="{{ asset('uploads/settings/'.$setting->favicon)}}" width="20px" height="20px">

                                  </div>
                                  <div class="mb-3">
                                      <label for="" class="text-secondary">System Theme</label>
                                      <select name="theme" id="theme" class="custom-select form-control ">
                                        <option value="light">Fléx Theme</option>
                                        <option value="dark" >Navy Theme</option>
                                        <option value="navy" >Dark Theme</option>

                                      </select>

                                  </div>
                                <hr>
                                  <div class="row">

                                      <div class="col-md-9"></div>
                                      <div class="col-md-3 ">
                                          <button class="btn bg-flex  text-light btn-block float-end" type="submit">
                                            <i class="fa fa-save"></i>
                                            Save Settings
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>



                



                  {{-- end of interface settings --}}
                </div>

                  
                <div class=" tab-pane" id="permission">
                  {{-- start of interface settings --}}

                    <div class="col-md-12">
                      <div class="p-2">

                          <div class="">
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif

                         {{-- start of the form  --}}
                         <form action="{{ route('permissions.store') }}" method="POST">
                          @csrf
                  
                          <div class="form-group">
                              <label for="name">Permission Name</label>
                              <input type="text" id="name" name="name" class="form-control" required>
                          </div>
                  
                          <button type="submit" class="btn btn-primary">Create Permission</button>
                      </form>
                         {{-- end of the form --}}
                        


                          </div>
                      </div>
                  </div>



                



                  {{-- end of interface settings --}}
                </div>


                <div class=" tab-pane" id="roles">
                  {{-- start of interface settings --}}

                    <div class="col-md-12">
                      <div class="p-2">

                          <div class="">
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif

                         {{-- start of the form  --}}
                         <form action="{{ route('roles.store') }}" method="POST">
                          @csrf
                  
                          <div class="form-group">
                              <label for="name">Role Name</label>
                              <input type="text" id="name" name="name" class="form-control" required>
                          </div>
                  
                          <button type="submit" class="btn btn-primary">Create Role</button>
                      </form>
                         {{-- end of the form --}}
                        


                          </div>
                      </div>
                  </div>



                



                  {{-- end of interface settings --}}
                </div>



                <div class=" tab-pane" id="rolesPermission">
                  {{-- start of interface settings --}}

                    <div class="col-md-12">
                      <div class="p-2">

                          <div class="">
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif

                         {{-- start of the form  --}}
              
    <form action="{{ route('roles.store-permissions') }}" method="POST">
      @csrf

      <div class="form-group">
          <label for="role">Role</label>
          <select id="role" name="role" class="form-control" required>
              @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endforeach
          </select>
      </div>

      <div class="form-group">
          <label for="permissions">Permissions</label>
          <select id="permissions" name="permissions[]" class="form-control" multiple required>
              @foreach($permissions as $permission)
                  <option value="{{ $permission->id }}">{{ $permission->name }}</option>
              @endforeach
          </select>
      </div>

      <button type="submit" class="btn btn-primary">Assign Permissions</button>
  </form>
                         {{-- end of the form --}}
                        


                          </div>
                      </div>
                  </div>



                



                  {{-- end of interface settings --}}
                </div>


                
                <div class=" tab-pane" id="assignRoles">
                  {{-- start of interface settings --}}

                    <div class="col-md-12">
                      <div class="p-2">

                          <div class="">
                               {{--displaying all the errors  --}}
                               @if ($errors->any())
                               <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                       <div>{{$error}}</div>
                                   @endforeach
                               </div>
                               @endif

                     <form action="{{ route('users.store-roles') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user">User</label>
            <select id="user" name="user" class="form-control" required>
                <option value="" disabled selected>Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->fname }}{{ $user->mname }} {{ $user->lname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="roless">Roles</label>
            <select id="roless" name="roles[]" class="form-control" multiple required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign Roles</button>
    </form>
                        


                          </div>
                      </div>
                  </div>



                



                  {{-- end of interface settings --}}
                </div>


                <!-- /.tab-pane -->
                <div class="tab-pane" id="audits">

                  {{-- start of pledges --}}
                  <div class="p-2">
                    <table id="example1"  class="table table-bordered cell-border">
                      <thead>
                          <tr class="text-secondary">
                              <th>ID</th>
                              <th>User</th>
                              <th>User Agent</th>
                              <th>Event</th>
                              <th>IP Address</th>
                              <th>Url</th>
                              <th>Audit Type</th>
                              <th>Date</th>
                          </tr>
                      </thead>
                      <tbody id="pledges-table-body">
                        @php

                        $user=Auth::user()->id;
                        $audits=App\Models\Audit::orderBy('created_at','DESC')->get();
                        @endphp
                        @foreach ($audits as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->user_agent}}</td>
                        <td>{{$item->event}}</td>
                        <td>{{$item->ip_address}}</td>
                        <td>{{$item->url}}</td>
                        <td>{{$item->auditable_type}}</td>
                        <td>{{$item->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                   </table>
                  </div>


                {{-- end of pledges --}}





              </div>
                <!-- /.tab-pane -->

                <div class="tab-pane active" id="calendar">


                  <div class="row p-1">

                    <div class="col-md-5">
                      <div class="card" style="height:400px !important;">
                        <div class="card-header">
                          <i class="fa fa-calendar"></i>
                          Today's Events
                        </div>
                        <div class="card-body">
                          @php

                          $user=Auth::user()->id;
                          $date=date('Y-m-d');
                          $events=App\Models\Todo::where('date',$date)->get();
                          @endphp

                          @forelse($events as $item)
                          <p>
                            <input type="hidden" value="{{ $item->id }}" name="id"/>
                            <i class="fa fa-clock text-flex"></i> {{ $item->date}}|  {{ $item->title}}
                            | <a href="{{ route('destroy_events',['id'=>$item->id]) }}" class="btn btn-danger  btn-sm text-end"> <i class="fa fa-trash"></i></a>
                          </p>
                          @empty
                          <p>No Event Was Created !!</p>

                          @endforelse

                        </div>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <div class="card">
                        <div class="card-header">
                          <i class="fa fa-calendar"></i>
                            Add Events
                        </div>
                        <div class="card-body">
                          <form action="{{ url('add-remove-multiple-input-fields') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                            </div>
                            @endif
                            @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            <table class="table table-border-none" id="dynamicAddRemove">
                            <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                            </tr>
                            <tr>
                            <td><input type="date" name="moreFields[0][date]" placeholder="Enterdate" class="form-control" /></td>
                            <td><input type="text" name="moreFields[0][title]" placeholder="Enter title" class="form-control" /></td>
                            <td><textarea name="moreFields[0][description]" placeholder="Enter description" class="form-control" rows="3"></textarea></td>
                            <td><button type="button" name="add" id="add-btn" class="btn bg-cyan btn-sm"> +Add</button></td>
                            </tr>
                            </table>
                            <button type="submit" class="btn bg-flex text-light"><i class="fa fa-save"></i> Save Events</button>
                            </form>
                            <script type="text/javascript">
                              var i = 0;
                              $("#add-btn").click(function(){
                              ++i;
                              $("#dynamicAddRemove").append('<tr><td><input type="date" name="moreFields['+i+'][date]" placeholder="Enter title" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][title]" placeholder="Enter title" class="form-control" /></td><td><textarea name="moreFields['+i+'][description]" placeholder="Enter description" class="form-control" rows="3"></textarea></td><td><button type="button" class="btn btn-danger btn-sm  remove-tr">Remove</button></td></tr>');
                              });
                              $(document).on('click', '.remove-tr', function(){
                              $(this).parents('tr').remove();
                              });
                              </script>
                        </div>
                      </div>
                    </div>

                  </div>


                </div>
                <!-- /.tab-pane -->


                  {{-- start of the section --}}
                  
                  {{-- end of the section  --}}


              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

</section>


{{-- Register Member modal --}}
<div class="modal fade" id="registeredModal" tabindex="-1" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/registered-members') }}" method="GET">
            @csrf

            <div class="mb-3">
            <h5 class="text-secondary">
                Generate Registered Member Report From the Given Start Date To the given End Date
            </h5>
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">From Date:</label>
               <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter Start Date">
            </div>
            <div class="mb-3">
              <label for="message-text" class="text-secondary">To Date:</label>
               <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter End Date">
            </div>
            <div class="mb-3">
                <label for="message-text" class="text-secondary">Sort By:</label>
                <select name="sort_by" id="sort_by">
                    <option value="created_at">Registered Date</option>
                    <option value="fname">First Name</option>
                    <option value="date_of_birth">Birthdate</option>
                </select>
              </div>
            <div class="row">
              <div class="col-md-6">

              </div>
              <div class="mb-3 col-md-6">
                 <button type="submit" class="btn btn-primary btn-block " id="save-purpose-btn">
                  <i class="fa fa-download"></i>
                  Download Report
                </button>
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>



  <script>
    $(document).ready(function() {
        // Initialize Select2 for user and roles
        $('#user').select2();
        // $('#roless').select2();
    });
</script>



  @endsection
