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
   <form method="POST" action="{{route('file.save')}}" enctype="multipart/form-data">@csrf
     <input type="file" name="path">
     <input type="submit" name="submit" value="Submit">
   </form>
@endsection   