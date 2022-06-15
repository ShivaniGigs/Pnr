@extends('websitePnrNumber.layout.app')
@section('title', 'Download Rupeezo Instant Loan App for Personal Loan')

@section('content')



<form action="{{route('forgot.password.link')}}" method="post">
    @csrf
    @if (Session::has("success"))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ Session::get('success') }}
    </div>
@elseif (Session::has("failed"))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ Session::get('failed') }}
    </div>
@endif
    <label for="lname">Email:</label><br>
    <input type="text" id="email" name="email" value=""><br><br>
    <input type="submit" value="Submit">
  </form> 



@stop