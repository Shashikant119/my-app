 <!--/col-->
<main class="col main pt-5 mt-3 h-100 overflow-auto">
    <a id="more"></a>
    <hr>
    <div class="mb-8">
        @if($errors->any())
           {!! implode('', $errors->all('<div style="color:red;">:message</div>')) !!}
        @endif
        <div class="col-md-6 text-center">
         <div class="card-deck">
            <div class="card card-inverse card-success text-center">
                <div class="card-body">
                    <blockquote class="card-blockquote">
                        <p>It's really good news that the new Bootstrap 4 now has support for CSS 3 flexbox.</p>
                        <footer>Makes flexible layouts <cite title="Source Title">Faster</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!--/row-->
</main>
<!-- Modal -->
<!-- psot page model -->
<div class="modal fade" id="myAlert" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
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
                   <textarea type="text" id="post" rows="4" name="post" class="form-control" placeholder="Post...."></textarea> 
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
                if (response.status == 'OK') {
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