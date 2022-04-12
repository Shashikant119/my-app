@extends('header.header')
<style type="text/css">
  tr td{color: #000;font-family: bold;}
  button.multiselect.dropdown-toggle.btn.btn-default {
    margin-left: -14px;}
  .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
    z-index: -1;
    padding: 9px;}
</style>

@include('notification.index')
@section('content')
 <div class="card-body container">
    <form method="post" action="{{route('multi.save')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="1">
        <div class="container" style="margin-right:-20px;">
         <select id="framework" name="cat[]" multiple class="form-control" >
          <?php $langs =  json_decode($language[0]->language); 
          ?>
          @isset($langs)
          @foreach($langs as $keys => $values)
          <option value="Codeigniter">{{$values}}</option>
          @endforeach
          @endisset
         </select>
        </div> 
          
        <div class="text-center" style="margin-top: -33px;margin-right: 260px;">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>


<table class="table table-bordered">
  <thead>
    <tr>
      <th>Sr No.</th>
      <th>Username</th>
      <th>Language</th>
    </tr>
  </thead>
   <tbody>
    @foreach($data as $keys => $values)
    <?php $da = json_decode($values->cat); ?>
    <tr>
      <td>{{$keys+1}}</td>
      <td>Super Admin</td>
      <td>
        <select class="form-control">
           <option>Select</option>
           @foreach($da as $keys => $value)
             <option>{{$value}}</option>
           @endforeach
        </select>   
      </td>
    </tr>
    @endforeach
      </tbody>
</table>
</div>


<script type="text/javascript"> 
//multiple select    
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Framework And Language',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
});

$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
});
//validation
</script>  
@endsection   