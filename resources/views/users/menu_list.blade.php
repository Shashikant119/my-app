<style type="text/css">
  #select-menu
  {
    border: none;
  }

</style>
<div class="row">
    <div class="col-md-4">
        @if($records->total() > 0)
            <div class="total-records">Showing {{$record_starts}} to {{$record_ends}} of Total Records: {!! $records->total() !!}</div>
        @else
            <div class="total-records">Total Records: {!! $records->total() !!}</div>
        @endif
    </div>

    <div class="col-md-8">
        <div style="float:right;">
            {!!str_replace('pagination','pagination
            pagination-sm',str_replace('/?','?',$records->appends(Request::except('page'))->render()))!!}
        </div>
    </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
    	<th>Sr No.</th>
      <th>Nenu name</th>
      <th>Parent Id</th>
      <th>Dropdown menu</th>
      <th>Created Date</th>
      <th colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($records as $keys => $menu)
    <tr style="background-color: ;">
      <td>{{$keys+1}}</td>
      <td id="name">{{$menu->menu_title}}</td>
      <td>
        <select>
          @if($menu->parent_id == 0)
          <option id="select-menu">{{$menu->menu_title}}</option>
          @endif
          @foreach($multiplem as $value)

          @if($menu->id == $value->parent_id)
          <option>{{$value->menu_title}}</option>
          @endif
          @endforeach
        </select>
      </td>
      <td id="email">{{$menu->parent_id}}</td>
      <td>{{date("jS F, Y", strtotime($menu->created_at))}}</td>
      <td>
        <button class="btn btn-primary edit_btn" data_all="" data_id="">update</button>
      </td>
      <td>delete</td>
    </tr>
    @endforeach
  </tbody>
</table>