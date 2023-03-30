@extends('layouts.master')

@section('title','System Settings')
<section class="content">
    <br>
    <br>
    <br>
    <br>


    <!--the php code to fetch data fron the users model -->
    <div class="card" style="width:80%;margin:auto">
        <div class="card-body">
            <h1> all the dependants with their gurdian</h1>
            <table id="example1" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>fullName</th>
                        <th>relationship</th>
                        <th>date_of_birth</th>
                     
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->fullName }}  {{ $user->lname }}</td>
                        <td>{{ $user->relationship}}</td>
                        <td>{{ $user->birth_date }}</td>
                      
                        
                    </tr>
                        
                    @endforeach
                  
                </tbody>
               
            </table>

        </div>
    </div>

   
<!-- i will get the way to paginate<!>
</section>



@section('content')