@extends('header.header')

@section('content')
<div class="container">
	<section>
		<h3 class="text-center">SELECT</h3>
	</section>

	<div class="select" id="data_view">
		
	</div>
</div>

<!-- Script part -->
<script type="text/javascript">
var page = 1;
$(function(){
    getData(page);
    $('[data-toggle="tooltip"]').tooltip();
 
});

function getData(page = 1)
{
	$.ajax({
    url: "{{route('learn2')}}",
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

function getCountry(){

    var countryId = $('#country').val();
    $('#state').html('');
    $.ajax({
        url: '{{ route('learn2.getStates') }}?country_id='+countryId,
        type: 'get',
        success: function (res) {
            $('#state').html('<option value="">Select State</option>');
            $.each(res, function (key, value) {
                $('#state').append('<option value="' + value
                    .state_id + '">' + value.name + ' / ' + value.total + '</option>');
            });
            $('#city').html('<option value="">Select City</option>');
        }
    });
};
function myStates(){
    var stateId = $('#state').val();
    $('#city').html('');
    $.ajax({
        url: '{{ route('learn2.getCities') }}?state_id='+stateId,
        type: 'get',
        success: function (res) {
            $('#city').html('<option value="">Select City</option>');
            $.each(res, function (key, value) {
                $('#city').append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
        }
    });
};
  
</script>
@stop