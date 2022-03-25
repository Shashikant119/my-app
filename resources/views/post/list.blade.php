 <style type="text/css">
     .post{border: 1px solid;border-radius: 10px;padding: 10px;}
 </style>
 <!--/col-->
<main class="col main pt-5 mt-3 h-100 overflow-auto">
    <a id="more"></a>
    <hr>
    <div class="mb-8">
        @if($errors->any())
           {!! implode('', $errors->all('<div style="color:red;">:message</div>')) !!}
        @endif
    </div>

    <div class="container">
      <div class="row">
        @isset($post)
        @foreach($post as $key => $value)
        <div class="col-sm-4">
          <div class="post">
            <h3><a href="{{url('/')}}/post/{{$value->slug}}">{{ucwords(substr(@$value->title,0 ,40))}}</a></h3>
            <p>{!! substr(@$value->content,0, 100) !!}</p>
            <p class="text-right" style="margin-bottom: 0px;"><a href="{{url('/')}}/post/edit/{{$value->id}}">Edit</a></p>
          </div>
        </div>
        @endforeach
        @endisset
      </div>
    </div>
    <!--/row-->
</main>
<!-- Modal -->
<!-- psot page model -->
<div class="modal fade" id="myAlert" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-left: -153px;width: 800px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                   <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                   <textarea class="form-control" id="post" rows="4" name="post"></textarea> 
                   {{--<textarea class="post form-control" id="messageArea" rows="4" name="post"></textarea> --}}
                   <input value="Submit" class="btn btn-primary add-btn">
                </form>   
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
    });
	$(document).on('click','.add-btn', function(){
        var title = $('#title').val().trim();
        var post = $('#post').val().trim();
        $.ajax({
           url: "{{route('post.save')}}",
            type: 'POST',
            dataType: 'JSON',
            data: {
            	"_token": "{{ csrf_token() }}",
            	title:title,
            	post:post
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
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- ckeditor -->
<script type="text/javascript" src="{{url('/')}}/assets/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
 CKEDITOR.replace( 'messageArea',
 {
  customConfig : 'config.js',
  toolbar : 'simple'
  });
</script> 
</script>