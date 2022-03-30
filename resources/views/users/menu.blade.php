@extends('header.header')
<style type="text/css">
  tr td{color: #000;font-family: bold;}
</style>
@section('content')
<div class="container mt-5" id="menu_list">
   
</div>
<script type="text/javascript">
var page = 1;
var sort_by = 'id';
var sort_order = 'asc';

$(function(){
    getData(page);
    $('[data-toggle="tooltip"]').tooltip();
  $(document).on('click', '.pagination a',function(event){
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        page = $(this).attr('href').split('page=')[1];
        getData(page);
    });
 });
    
function getData(page = 1){
  $('#search').prop('disabled', true);
  $.ajax({
        url: "{{route('menu.list')}}?" +$("#menu_list").serialize(),
        type: "GET",
        dataType: "html",
        data: {
            'page': page,
            'sort_by': sort_by,
            'sort_order': sort_order
        }
    }).done(function(data){
      $("#menu_list").empty().html(data);
      $('#search').prop('disabled', false);
    }).fail(function(jqXHR, ajaxOptions, thrownError){
        console.log('No response from server');
        $('#search').prop('disabled', false);
    });
}
</script>
@endsection

