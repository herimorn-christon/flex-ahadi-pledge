@extends('layouts.master')

@section('title','company settings')


@section('content')

<section class="content">
    @if ($errors->any())
    @foreach ($errors->all() as $error  )
    <div class="alert alert-danger">
      {{ $error }}
    </div>
      
    @endforeach
      
    @endif

  <div class="card  p-2 border-left-flex">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="row mb-1">
      
   
<div class="">
  <div class="row starts-border mt-2 mb-2" >
    <div class="col-md-6"> <h6 class="text-secondary">this is all information about the company details
        </h6></div>
    <div class="col-md-6 text-right"><h6 class="font-weight-bolder" id="total_announcements"></h6></div>
  </div>

  
</div>
{{-- end of statistics --}}
 
    <div class="col-sm-6" id="alert-div">

    </div><!-- /.col -->
    <div class="col-sm-6">
        
      <ul class="float-sm-right" type="none">
        <li class="">    
            @if (!$companies)
            <button type="button" class="btn bg-flex text-light btn-sm" data-bs-toggle="modal"  data-bs-target="#myModal">
                <i class="fa fa-plus"></i>
                 add company infomation
                </button>
            @else
            <button type="button" class="btn bg-flex text-light btn-sm" data-bs-toggle="modal"  data-bs-target="#myModal1">
                <i class="fa fa-plus"></i>
                 edit company information
                </button>
          @endif
     
      
               
<form action="{{route('admin_update_companySettings',$companies->id) }}" method="POST" 
  enctype="multipart/form-data">
  @method('PUT')
@csrf
<div class="modal" id="myModal1">
      <div class="modal-dialog" >
          <div class="modal-content" style="width:40rem">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">please edit your company information</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                    
                      <div class="form-group">
                        <label for="title" class='form-label'>company name</label>
                        <input type="text" class="form-control" placeholder="please inter company name"
                        name="name" value="{{ $companies->name }}"/>
                      </div>
                      <div class="form-group">
                        <label for="description" class='form-label'>company email</label>
                        <input type="text" class="form-control" placeholder="inter company email"
                        name="email" value="{{$companies->email }}"/>
                      </div>
                      <div class="form-group">
                        <label for="description" class='form-label'>postal box </label>
                        <input type="text" class="form-control" placeholder="inter the company postal box"
                        name="postal_box" value="{{ $companies->postal_box}}"/>
                      </div>
                        <div class="form-group">
                          <label for="description" class='form-label'>city </label>
                          <input type="text" class="form-control" placeholder="inter the city name"
                          name="city" value="{{ $companies->city }}"/>
                        </div>
                        <div class="form-group">
                          <label for="description" class='form-label'>street</label>
                          <input type="text" class="form-control" placeholder="inter the street name"
                          name="street" value="{{ $companies->town }}"/>
                        </div>
                        
                        <img src="{{ asset($companies->logo) }}" width="20px" height="20px"/>
                        <div class="form-group">
                          <label for="company_image" class='form-label'>company logo </label>
                          <input type="file" class="form-control" 
                          name="image" value={{ $companies->logo }}/>
                        </div>
                      <div class="form-group">
                      
                        <input type="hidden" class="form-control" value=""
                        name="users_id"/>
                      </div>
                   
                  </div>
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">save date</button>
              </div>
          </div>
      </div>
  </div>
</form>

       
        {{-- end of create purpose button --}}


 




  
<form action="{{route('admin_store.company_setting') }}" method="POST" 
    enctype="multipart/form-data">
  @csrf
 <div class="modal" id="myModal">
        <div class="modal-dialog" >
            <div class="modal-content" style="width:40rem">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">add company information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      
                        <div class="form-group">
                          <label for="title" class='form-label'>company name</label>
                          name="name"/>
                        </div>
                        <div class="form-group">
                          <label for="description" class='form-label'>company email</label>
                          <input type="text" class="form-control" placeholder="inter company email"
                          name="email"/>
                        </div>
                        <div class="form-group">
                          <label for="description" class='form-label'>postal box </label>
                          <input type="text" class="form-control" placeholder="inter the company postal box"
                          name="postal_box"/>
                        </div>
                          <div class="form-group">
                            <label for="description" class='form-label'>city </label>
                            <input type="text" class="form-control" placeholder="inter the city name"
                            name="city"/>
                          </div>
                          <div class="form-group">
                            <label for="description" class='form-label'>street</label>
                            <input type="text" class="form-control" placeholder="inter the street name"
                            name="street"/>
                          </div>
                          <div class="form-group">
                            <label for="company_image" class='form-label'>company logo </label>
                            <input type="file" class="form-control" 
                            name="image"/>
                          </div>
                        <div class="form-group">
                        
                          <input type="hidden" class="form-control" value=""
                          name="users_id"/>
                        </div>
                     
                    </div>
                  </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">save date</button>
                </div>
            </div>
        </div>
    </div>
  </form>
    

{{-- this is the ends of update model --}}



        
        {{-- start register purpose modal --}}





        {{-- end of register purpose modal --}}

        {{-- start of ajax register purpose method --}}
      
        {{-- end of ajax delete purpose method --}}

    </li>
       
      </ul>
      
    </div>
  </div>
</div>
<div class="card mt-1">
        <div class="responsive p-1">
          {{-- start of all purposes table --}}
          @if($companies)
            <table id="example1" class="table ">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>name</th>
                        <th>email</th>
                         <th>city</th>
                      <th>street</th>
                      <th>postal box</th>
                      <th>company logo</th>
                    </tr>
                </thead>
                <?php
                $i=1;
                ?>
                <tbody id="purposes-table-body">
                   
                    <tr>
                    <td>{{$i}}</td>
                    <td>{{ $companies->name }}</td>
                    <td>{{ $companies->email }}</td>
                    <td>{{ $companies->location }}-{{ $companies->city }}</td>
                    <td>{{ $companies->town }}</td>
                    <td>{{ $companies->postal_box }}</td>
                    <td><img src="{{ asset($companies->logo)}}" width="50px" height="50px"/> </td>
                    <tr>
                </tbody>
            </table>
            @else
            <table id="example1" class="table ">
                <thead>
                    <tr class="text-secondary">
                        <th>SN</th>
                        <th>name</th>
                        <th>email</th>
                         <th>city</th>
                      <th>street</th>
                      <th>postal box</th>
                    </tr>
                </thead>
               
                <tbody id="purposes-table-body">
                   
                
                  

                </tbody>
            </table>
            @endif
        {{-- end of all purposes tables --}}

        {{-- start of ajax fetch all announcements method --}}
       
        </div>
</div>

</section>
    

  @endsection