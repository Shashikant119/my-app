<table class="table table-bordered">
  <thead>
    <tr>
      <th>Sr No.</th>
      <th>Country Name / Total States</th>
      <th>States Name / Total City</th>
      <th>Cities</th>
    </tr>
  </thead>
   <tbody>
    <tr>
      <td>#</td>
      <td style="width:30%;">
         <select class="form-control form-select form-select-lg mb-3" id="country" onchange="getCountry()">
           <option selected disabled>Select country</option>
             @foreach($country as $keys => $val)
                <option value="{{$val->country_id}}">{{$val->name}} / {{$val->total}}</option>
             @endforeach
        </select>  
      </td>
      <td style="width:30%;"> 
        <select class="form-control form-select form-select-lg mb-3" id="state" onchange="myStates()"> </select>   
      </td>
      <td style="width:30%;">
      <select class="form-control form-select form-select-lg mb-3" id="city"> </select> 
      </td>
    </tr>
      </tbody>
</table>