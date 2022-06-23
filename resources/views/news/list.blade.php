<style>
.total-records, ul.pagination{
    margin: 5px 0;
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
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Title</th>
                <th>P_Image</th>
                <th>Status</th>
                <th>ACT</th>
            </tr>
        </thead>
        <tbody>
          @isset($records)
            @foreach ($records as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->title}}</td>
                <td>
                  @if($value->path)
                    <div class="pimages">
                        <img src="{{url('/')}}/news/{{$value->path}}" alt="{{$value->title}}" width="50px" height="40px">
                    </div>
                  @else
                    <span>No Slider Available</span>
                  @endif
                </td>
                <td>
                  @if ($value->status == 1)
                    <span class="label label-success">Active</span>
                  @else
                    <span class="label label-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <button type="button" class="btn btn-xs btn-warning edit_resource" data-url="{{route('news.create', ['id'=>$value->id])}}"><i class="fa fa-pencil"></i> Edit</button>
                  {{--<button type="button" class="btn btn-xs btn-danger delete_record" data-id="{{$value->id}}"><i class="fa fa-trash"></i> Remove</button>--}}
                </td>
              </tr>
            @endforeach
          @endisset
        </tbody>
    </table>
</div>
