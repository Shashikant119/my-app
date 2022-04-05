@extends('header.header')
<style type="text/css">
  tr td{color: #000;font-family: bold;}
  button.multiselect.dropdown-toggle.btn.btn-default {
    margin-left: -14px;}
  .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
    z-index: -1;
    padding: 9px;}
</style>


@section('content')
 <div class="card-body container">
    <form method="post" action="{{route('add-lag.save')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="1">
        <label>Add language </label>
        <?php
          $d = $datest;
          $s = ["Laravel","Symfony","CodeIgniter","ZendFramework","FuelPHP","Slim","Phalcon","Aura","angular","vue","Phalcon","CSS","Java","Javascript","Jquery"];

          $i = implode(" ",$s);

         // print_r($i);
        ?>
        <textarea multiple class="form-control" rows="4" name="language" placeholder="Enter Multiple Language .....">{{$i}}</textarea>
      
        <div class="text-center" style="margin-top:10px">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>


@endsection   