@extends('header.header')
<style type="text/css">
  tr td{color: #000;font-family: bold;}
  button.multiselect.dropdown-toggle.btn.btn-default {
    margin-left: -14px;}
  .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
    z-index: -1;
    padding: 9px;}
input#sms {
    width: 704px;
    height: 37px;
    margin-left: 50px;
}
input.btn-btn-primary.btn-send {
    height: 37px;
    width: 77px;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@section('content')
<div class="container">
  <div class="row clearfix" id="data_view">
      
  </div>
</div>

<script type="text/javascript">
var page = 1;
$(function(){
    getData(page);
    $('[data-toggle="tooltip"]').tooltip();
 
});

function getData(page = 1)
{
  $.ajax({
    url: "{{route('chat')}}",
    type: "GET",
    dataType: "html",
    data: {
        'page': page
    }
    }).done(function(data){
      $("#data_view").empty().html(data);
    }).fail(function(jqXHR, ajaxOptions, thrownError){
        console.log('No response from server');
  });
}

</script>
@stop   