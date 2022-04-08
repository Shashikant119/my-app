<style>
.total-records, ul.pagination{
    margin: 5px 0;
}
</style>
<div class="row">
    <div class="col-md-4">
        @if($concerns->total() > 0)
            <div class="total-records">Showing {{$record_starts}} to {{$record_ends}} of Total Records: {!! $concerns->total() !!}</div>
        @else
            <div class="total-records">Total Records: {!! $concerns->total() !!}</div>
        @endif
    </div>

    <div class="col-md-8">
        <div style="float:right;">
            {!!str_replace('pagination','pagination
            pagination-sm',str_replace('/?','?',$concerns->appends(Request::except('page'))->render()))!!}
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="success">
                <th>#</th>
                <th>Name</th>
                <th>Meta Title</th>
                <th>Meta Keyword</th>
                <th>Meta Description</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($concerns as $row)
            <tr id="row_{{$row->id}}">
                <td>{{$loop->index + 1}}</td>
                <td>{{$row->name}}</td>
                <td style="width:25%">{{$row->meta_title}}</td>
                <td style="width:30%">{{$row->meta_keyword}}</td>
                <td style="width:30%">{{$row->meta_description}}</td>
                {{-- <td>{{$row->is_active == 1 ? 'Active' : 'Inactive'}}</td> --}}
                <td style="width:10%">
                    <button type="button" class="btn btn-xs btn-warning add_resource" data-url="{{route('learn4.create', ['id'=>$row->id])}}"><i class="fa fa-pencil"></i> Edit</button>
                    <button type="button" class="btn btn-xs btn-danger delete_resource" data-id="{{$row->id}}"><i class="fa fa-trash"></i> Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
