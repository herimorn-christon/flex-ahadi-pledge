@extends('layouts.member')

@section('title','My dashboad')




@section('content')

    <!-- Main content -->
    <section class="content">
      @php
      $user=Auth::User()->id;
      $dependants=App\Models\User::find($user)->dependant;
     @endphp
   
   <!--lets impliments the model logic here -->
   <div class="main-content mt-5">
    @if ($errors->any())
    @foreach ($errors->all() as $error  )
    <div class="alert alert-danger">
      {{ $error }}
    </div>
      
    @endforeach
    {{ $dependants }}
      
    @endif
    <div class="card " style="height:100%;margin:auto">
        <div class="card-header">
            All dependants
            <a href="" class="btn btn-success " data-bs-toggle="modal" 
            data-bs-target="#myModal">add dependant</a>
            <a href="{{ route('trash')}}" class="btn btn-warning">trashed</a>
        </div>
        <?php
          $i=1;
        ?>
       
        <div class="card-body">
            <table class="table  table-striped  table-condensed" id="example1">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width:10%">
                      username
                    </th>
                    <th scope="col" style="width:20%">birth Date</th>
                    <th scope="col"style="width:30%">Relationship</th>
                     <th scope="col"style="width:20%">action</th>
                  </tr>
                </thead>
                <tbody >
                  @foreach ($dependants as $dependant )
                  <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $dependant->fullName }}</td>
                    <td>{{ $dependant->birth_date }}</td>
                    <td>{{ $dependant->relationship }}</td>
                    <td style="height:10px">
                     <form action="{{ route('member_dependant.destroy',$dependant->id) }}" method="POST">
                      @csrf
                      <button class=" btn-danger btn" >trash</button>
                     </form>
                  
                  
                 
                    <a class="btn btn-primary" href={{ route('member_dependant.edit',$dependant->id) }}>edit</a>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>

    <!--implimenting the boostrap model to edit the data -->
    <form action="{{route('member_dependant.weka')}}" method="POST">
      @csrf

     <div class="modal" id="myModal">
            <div class="modal-dialog" >
                <div class="modal-content" style="width:40rem">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">please enter your dependant</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          
                            <div class="form-group">
                              <label for="title" class='form-label'>dependant Name</label>
                              <input type="text" class="form-control" placeholder="inter dependant Name"
                              name="fullName"/>
                            </div>
                            <div class="form-group">
                              <label for="description" class='form-label'>birthdate</label>
                              <input type="date" class="form-control" placeholder="inter the title"
                              name="birth_date"/>
                            </div>
                            <div class="form-group">
                              <label for="description" class='form-label'>relationship</label>
                              <input type="text" class="form-control" placeholder="inter the rletionship"
                              name="relationship"/>
                            </div>
                            <div class="form-group">
                            
                              <input type="hidden" class="form-control" value="{{$user}}"
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


      <!--the model for update page-->

      <form action="" method="POST">

        <div class="modal" id="myModal1">
               <div class="modal-dialog" >
                   <div class="modal-content" style="width:40rem">
                       <!-- Modal Header -->
                       
                       <div class="modal-header">
                           <h4 class="modal-title">Editing the posts</h4>
                           <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                       </div>
   
                       <!-- Modal body -->
                       <div class="modal-body">
                         <div class="card">
                           <div class="card-body">
                        
                            <div class="form-group">
                              <label for="description" class='form-label'>birthdate</label>
                              <input type="date" class="form-control" placeholder="inter the title"
                              name="birth_date"/>
                            </div>
                            <div class="form-group">
                              <label for="description" class='form-label'>username</label>
                              <input type="text" class="form-control" placeholder="inter the username"
                              name="username"/>
                            </div>
                            <div class="form-group">
                              <label for="description" class='form-label'>relationship</label>
                              <input type="text" class="form-control" placeholder="inter the rletionship"
                              name="relatioship"/>
                            </div>
                            <div class="form-group">
                            
                              <input type="hidden" class="form-control" value="{{$user}}"
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


         <!--the model for confirm deletion -->
         


         <!--confirm deletion -->



         <form action="">

          <div class="modal" id="myModal2">
                 <div class="modal-dialog" >
                     <div class="modal-content" style="width:40rem">
                         <!-- Modal Header -->
                         <div class="modal-header">
                             <h4 class="modal-title">Editing the posts</h4>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                         </div>
     
                         <!-- Modal body -->
                         <div class="modal-body">
                           <div class="card">
                             <div class="card-body">
                             
                               <h1> are you sure you want to delete</h1>
                              
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
</div>

   
   <!--end of the model logic here -->



        
    </section>
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @endsection
 

  <!-- Control Sidebar -->


</html>
