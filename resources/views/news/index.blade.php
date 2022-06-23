@extends('header.header')
@section('title')
   news
@endsection
@section('content')
<style type="text/css">
    .wrapper{
        min-height: 600px;
    }
</style>
<section class="container">
    <div class="row" id="search-row">
        <form id="search_form" action="javascript:void(0);">
            {{ csrf_field() }}

            <div class="col-md-2">
                <input type="text" name="title" class="form-control" value="" placeholder="Search Title">
            </div>
            <div class="col-sm-2">
                <select name="status" id="status" class="form-control">
                    <option value="">Select</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="button" id="search" class="btn btn-primary btn-sm" onclick ="getData();">Search</button>
                <button type="button" id="reset" class="btn btn-default btn-sm btn-flat">Reset</button>
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-success add_resource" data-url="{{route('news.create')}}" >Add New</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12" id="search_data">
        </div>
    </div>
        <div class="row">
        <div class="col-md-12" id="resource_modal_div">
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    $('#reset').click(function () {
        $("input[type='text']").val('');
        $("select").val('');
        getData()
    });

    $(document).on('click', '.add_resource',function(event){
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: "GET",
            dataType: "html"
        }).done(function(data){
            $("#resource_modal_div").empty().html(data);
            $('#add_resource_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            console.log('No response from server');
        });
    });

    $(document).on('click', '.edit_resource',function(event){
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: "GET",
            dataType: "html"
        }).done(function(data){
            $("#resource_modal_div").empty().html(data);
            $('#edit_resource_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            console.log('No response from server');
        });
    });

    $(document).on('click', '.delete_record',function(event){
      event.preventDefault();
      var x = confirm("Are you sure you want to delete?");
      if (x){
          $.ajax({
                  type: 'POST',
                  dataType: 'JSON',
                  url: "{{route('news.delete')}}",
                  data: {
                    id: $(this).attr('data-id'),
                  },
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (response) {
                    if (response.status == 'success') {
    	                Swal.fire({
    	                   position: 'top-end',
    	                   title: response.message,
    	                   icon: "success",
    	                   confirmButtonText: "Okay",
    	                   timer: 3000
    	                });
    	                getData();
    	              }else{
    	                Swal.fire({
    	                   position: 'top-end',
    	                   title: response.message,
    	                   icon: "warning",
    	                   confirmButtonText: "Okay",
    	                   timer: 3000
    	                });
    	              }
                  }
          });
      }
      return false;
    });

});

function getData(page = 1){
    $('#search').prop('disabled', true);
    $.ajax({
        url: "{{route('news')}}?" +$("#search_form").serialize(),
        type: "GET",
        dataType: "html",
        data: {
            'page': page,
            'sort_by': sort_by,
            'sort_order': sort_order
        }
    }).done(function(data){
        $("#search_data").empty().html(data);
        $('#search').prop('disabled', false);
    }).fail(function(jqXHR, ajaxOptions, thrownError){
        console.log('No response from server');
        $('#search').prop('disabled', false);
    });
}



</script>
@endsection
