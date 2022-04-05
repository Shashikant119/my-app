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
   

   <div id="data_view">
    
   </div>
</div>

<script type="text/javascript">
var page = 1;
$(function(){
    getData(page);
    $('[data-toggle="tooltip"]').tooltip();
 
});

function getData(page = 1){
  $('#search').prop('disabled', true);
  $.ajax({
        url: "{{route('learn1')}}",
        type: "GET",
        dataType: "html",
        data: {
            'page': page
        }
    }).done(function(data){
      $("#data_view").empty().html(data);
      $('#search').prop('disabled', false);
    }).fail(function(jqXHR, ajaxOptions, thrownError){
        console.log('No response from server');
        $('#search').prop('disabled', false);
    });
}
</script> 
@endsection   