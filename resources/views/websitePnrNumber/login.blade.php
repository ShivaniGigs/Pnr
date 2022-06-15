@extends('websitePnrNumber.layout.app')
@section('title', 'Download Rupeezo Instant Loan App for Personal Loan')

@section('content')
<form class="modal-content animate" action="{{route('UserLogin')}}" method="post">
    @csrf
   
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit">Login</button>
      {{-- <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label> --}}
    

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="{{route('forgot.password.form')}}">password?</a></span>
    </div>
  </form>
  @stop