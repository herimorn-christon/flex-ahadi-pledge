@extends('layouts.member')

@section('title','All Communities')


@section('content')


<!--fetching the whole value by executiong a single query in the profile posts -->
@php
$user=App\Models\User::find($id);
//selecting jumuiys
//$jumuiya=App\Models\Jumuiya::where('id', $user->jumuiya)->first();


@endphp
<div class="card">

    <div class="card-body" >
        <form
            method="post" action="{{ route('member_profile.update', $user->id)}}" >
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label for="" class="form-label">firstName</label>
                <input type="text" class="form-control" name="fName" value="{{ $user->fname}}">
            </div>
            <div class="mb-2">
                <label for="" class="form-label">lastName</label>
                <input type="text" class="form-control" name="lname" value="{{ $user->lname}}">
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Community</label>
                <select name="jumuiya" id="" class="form-control" style="height:3rem">
                    @php
                      $jumuiyas=App\Models\Jumuiya::all();
                      @endphp
                      @foreach ($jumuiyas as $jumuiya)
                      <option value="{{ $jumuiya->id }}" class="form-control">{{ $jumuiya->name }}</option>
                      @endforeach
                  </select>
               
            </div>
            <div class="mb-2">
                <label for="" class="form-label">phone number</label>
                <input type="text" class="form-control" name="phone" value='{{ $user->phone }}'>
            </div>
            <button type="submit" class="btn btn-primary">edit profile</button>
        </form>
    </div>
</div>



<!--take the boostrap form to edit the user profile--
@endsection