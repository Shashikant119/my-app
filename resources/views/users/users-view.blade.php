@extends('header.header')
<style type="text/css">
  tr td{color: #fff;font-family: bold;}
</style>
@section('content')
<div class="container mt-5">
  <table class="table table-bordered">
    <thead>
      <tr>
      	<th>Sr No.</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Created Date</th>
        <th colspan="2" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    @php 
      $color = array("brown", "red", "green", "blue", "chartreuse", "blueviolet", "pink","darkgoldenrod","darkslategray");
      $last = array_key_last($color);
      //$count = count($color);
      $i = rand(0, $last);
     // echo $last
    @endphp
    @foreach($users as $key => $user)	
      <tr style="background-color: {{$color[$i]}};">
        <td>{{$key++}}</td>
        <td id="name">{{$user->name}}</td>
        <td><input type="text" name="name"></td>
        <td id="email">{{$user->email}}</td>
        <td>{{$user->created_at}}</td>
        <td>
          <button class="btn btn-primary edit_btn" data_all="{{$key}}" data_id="{{$user->id}}">Edit</button>
        </td>
        <td>delete</td>
      </tr>
    @endforeach  
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(function() {

  })
</script>
@endsection

