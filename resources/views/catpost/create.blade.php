<style>
.modal-md{width: 40%;}
.modal-header{padding: 5px 15px;}
</style>
<div class="modal bs-example-modal-sm" id="add_resource_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger" style="font-size: 30px;">&times;</span></button>
                <h4 class="modal-title" style="font-weight: 600;color: #0cf;">Add New Post</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>route('learn4.store'), 'method'=>'post', 'id'=>'create_resource_form', 'class'=>'form-horizontal', 'onsubmit'=>'return false;')) }}
                <input type="hidden" name="id" @isset($concern->id) value="{{$concern->id}}" @endisset>
                <div class="row">
                  <div class="col-md-12">
                    {{-- <div class="form-group"> --}}
                      <label>Name</label>
                      <input type="text" name="name" @isset($concern->name) value="{{$concern->name}}" @endisset class="form-control" placeholder="Enter Name">
                      <p id="name-error" class="hide" style="color: red;"></p>
                    {{-- </div> --}}
                  </div>
                  <div class="col-md-12">
                    <label>Meta title</label>
                    <textarea name="meta_title" class="form-control" rows="2" placeholder="Meta Title">@isset($concern->meta_title){!!$concern->meta_title!!}@endisset</textarea>
                    <p id="meta_title-error" class="hide" style="color: red;"></p>
                  </div>
                  <div class="col-md-12">
                    <label>Meta Keyword</label>
                    <textarea name="meta_keyword" class="form-control" rows="2" placeholder="Meta Keyword">@isset($concern->meta_keyword){!!$concern->meta_keyword!!}@endisset</textarea>
                    <p id="meta_keyword-error" class="hide" style="color: red;"></p>
                  </div>
                  <div class="col-md-12">
                    <label>Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2" placeholder="Meta Description">@isset($concern->meta_description){!!$concern->meta_description!!}@endisset</textarea>
                    <p id="meta_description-error" class="hide" style="color: red;"></p>
                  </div>
                  <div class="col-md-12">
                    <label>H1 Tag</label>
                    <input type="text" name="h1tag" @isset($concern->h1tag) value="{{$concern->h1tag}}" @endisset class="form-control" placeholder="Enter H! Tag">
                    <p id="h1tag-error" class="hide" style="color: red;"></p>
                  </div>

                  <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Meta Description">@isset($concern->description){!!$concern->description!!}@endisset</textarea>
                    <p id="description-error" class="hide" style="color: red;"></p>
                  </div>

                  <div class="col-md-12">
                    <div class="row" style="margin-top:5px">
                        <div class="col-md-2">
                            {{ Form::button('Save', array('id'=>'save_resource_btn', 'class'=> 'btn btn-primary', 'style'=>'width: 100%;border-radius: 3px;')) }}
                        </div>
                        <div class="col-md-10">
                            <p id="save_resource-error" class="hide" style="color: red;"></p>
                        </div>
                    </div>
                  </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(document).on('click', "#save_resource_btn", function(event){
        event.preventDefault();

        var formEle = $('#create_resource_form');

        if(formEle.find("#name").val() == ''){
            $('#name-error').removeClass('hide').html('Please enter name!!').css({"color":"red"});
            return false;
        }
        $('#name-error').addClass('hide').html('');

        if(formEle.find("#title").val() == ''){
            $('#title-error').removeClass('hide').html('Please enter title!!').css({"color":"red"});
            return false;
        }
        $('#title-error').addClass('hide').html('');

        if(formEle.find("#description").val() == ''){
            $('#description-error').removeClass('hide').html('Please Enter Description!!').css({"color":"red"});
            return false;
        }
        $('#description-error').addClass('hide').html('');

        var thisButton = $(this);
        if ( thisButton.data('requestRunning') ) {
            return;
        }
        thisButton.data('requestRunning', true);
        thisButton.prop("disabled", true);

        $("#save_resource-error").text('');

        var url = formEle.attr('action');
        var formData = formEle.serialize();

        $.ajax({
          type: 'POST',
          dataType: 'JSON',
          data: formData,
          url: url,
        }).done(function(data){
          if(data.status == 'success'){
            $("#save_resource-error").removeClass('hide').text(data.message).css({"color":"green"});
            setTimeout(function() {
              $("#add_resource_modal .close").click();
              $("#resource_modal_div").empty();
              window.location.reload();
            }, 3000);
          }else{
            $("#save_resource-error").removeClass('hide').text(data.message).css({"color":"#FF5733"});
          }
        }).fail(function(jqXHR, ajaxOptions, thrownError){
          $("#save_resource-error").removeClass('hide').text('Error Occured!!').css({"color":"#FF5733"});
        }).always(function() {
          thisButton.data('requestRunning', false);
          thisButton.prop("disabled", false);
        });
    });
});
</script>
