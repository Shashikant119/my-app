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