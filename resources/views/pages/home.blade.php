@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Home Page</a>
      </li>
      <li class="breadcrumb-item active">My Home Page</li>
    </ol>

    <form action="/home/money" method="post">
      @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Your Money</label>
    <input type="number" name="uang" class="form-control"  placeholder="Enter your money">
    
  </div>

  <button type="submit" value="new money"  class="btn btn-primary">Submit</button>
</form>



@endsection
