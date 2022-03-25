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
        <form>
           <input type="text" name="title" id="title" class="form-control" value="{{$editdata->title}}">
           <input type="hidden" name="id" id="id" value="{{$editdata->id}}">
           <textarea class="form-control" id="post" rows="4" name="post">{{$editdata->content}}</textarea> 
           <input value="Submit" class="btn btn-primary add-btn">
        </form>   
    </div>
    <!--/row-->
</main>
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  $(document).on('click','.add-btn', function(){
        var title = $('#title').val().trim();
        var post = $('#post').val().trim();
        var id = $('#id').val();
        $.ajax({
           url: "{{route('post.store')}}",
            type: 'POST',
            dataType: 'JSON',
            data: {
              "_token": "{{ csrf_token() }}",
              title:title,
              id:id,
              post:post
            },
            success: function (response) {
                if (response.status == 'success') {
                    Swal.fire({
                       position: 'top-end',
                       title: response.message,
                       icon: "success",
                       confirmButtonText: "Okay",
                       timer: 2000
                    });
                    setTimeout(function () {
                       window.location.href = "/post/index"; 
                    }, 2000);
                  
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
