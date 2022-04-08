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
   <section class="content">
    <div class="row" id="search-row">
    	<form id="search_form" action="javascript:void(0);">
    		{{ csrf_field() }}
    		<div class="col-md-3">
                <div class="action_value" style="display: inline;">
                    <input type="text" name="name" id="name" class="form-control input-sm" placeholder="name" value="" style="display: inline;width: 100%;">
                </div>
            </div>
	        <div class="col-sm-2">
	            <button style="width: 40%;" type="button" id="search" class="btn btn-primary btn-sm btn-flat" onclick="getData();">Search</button>
                <button style="width: 40%;" type="button" id="reset" class="btn btn-default btn-sm btn-flat">Reset</button>
	        </div>
	        <div class="col-sm-2 pull-right">
	        	<button type="button" class="btn btn-sm btn-success pull-right add_resource" data-url="{{route('learn4.create')}}">
	            	<i class="fa fa-plus"></i> Add New Post
	            </button>
	        </div>
        </form>
    </div>

   <!-- list  --> 
   <div class="row">
        <div class="col-md-12" id="search_data">
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12" id="resource_modal_div">
    	</div>
    </div>
</div>

<!-- script part -->
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
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
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
        /*$(document).on('click', '.upload_image',function(event){
            event.preventDefault();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html"
            }).done(function(data){
                $("#resource_modal_div").empty().html(data);
                $('#upload_resource_modal').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                console.log('No response from server');
            });
        });*/

    $('#search_form #reset').on('click', function(e){
        $('#search_form #name').val('');
        getData(1);
    });
});
$(document).on('click', '.delete_resource',function(event){
		event.preventDefault();
		var x = confirm("Are you sure you want to delete?");
		if (x){
			$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: "{{route('learn4.delete')}}",
					data: {
							id: $(this).attr('data-id'),
					},
					headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (response) {
							console.log(response);
							getData()
					}
			});
		}
		return false;
});
function getData(page = 1){
    $('#search').prop('disabled', true);
	$.ajax({
        url: "{{route('learn4')}}?" +$("#search_form").serialize(),
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
@stop