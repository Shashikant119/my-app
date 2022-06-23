<style>
.modal-md{width: 40%;}
.modal-header{padding: 5px 15px;}
.file {
    visibility: hidden;
    position: absolute;
}
</style>
<div class="modal bs-example-modal-sm" id="edit_resource_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger" style="font-size: 30px;">&times;</span></button>
                <h4 class="modal-title" style="font-weight: 600;color: #0cf;">Edit product Page</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url'=>route('news.update'), 'method'=>'post', 'id'=>'update_resource_form', 'class'=>'form-horizontal', 'onsubmit'=>'return false;')) }}
                    <input type="hidden" name="id" value="{{$record->id}}">
                    <div class="form-group">
                        {{ Form::label('title', 'Title', array('class'=>'col-sm-3')) }}
                        <div class="col-md-9">
                            {{ Form::text('title', $record->title, array('id'=>'title', 'class'=>'form-control', 'placeholder'=>'Title')) }}
                            <p id="title-error" class="hide" style="color: red;"></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('url', 'URL', array('class'=>'col-sm-3')) }}
                        <div class="col-md-9">
                            {{ Form::text('url',$record->url, array('id'=>'url', 'class'=>'form-control', 'placeholder'=>'URL')) }}
                            <p id="url-error" class="hide" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('status', 'Status', array('class'=>'col-sm-3')) }}
                        <div class="col-sm-3">
                        {{ Form::select('status', array('0'=>'Inactive', '1'=>'Active'), $record->status, array('id'=>'status', 'class'=>'form-control input-sm')) }}
                        <p id="status-error" class="hide" style="color: red;"></p>
                        </div>
                    </div>

                    <div class="form-group">
                      {{ Form::label('image', 'Image', array('class'=>'col-sm-3')) }}
                      <div class="col-md-9">
                        <input type="file" name="file" id="file" class="file">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-image"></i></span>
                          <input type="text" class="form-control input-md" disabled placeholder="Select File">
                          <span class="input-group-addon" id="browse-button" style="cursor: pointer;"><i class="fa fa-upload"></i> Browse</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-3 pimages-div">
                          <div class="pimages">
                              <img src="{{url('/')}}/news/{{$record->path}}" alt="IMG" @if(@$record->type == 1) width="180px" @else width="100px" @endif  height="100px">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            {{ Form::button('Update', array('id'=>'save_resource_btn', 'class'=> 'btn btn-primary', 'style'=>'width: 100%;border-radius: 3px;')) }}
                        </div>
                        <div class="col-md-10">
                            <p id="save_resource-error" class="hide" style="color: red;"></p>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(document).on('click', '#browse-button', function() {
        var file = $(this).parents().eq(1).find('#file');
        file.trigger('click');
    });
    $(document).on("change", "#file", function() {
        var thisEle = $(this);
        var file_path = thisEle.val();
        var file_name = file_path.split('\\').pop();
        thisEle.parent().find('.form-control').val(file_name);

        var file_ext = file_name.split('.').pop();
        file_ext = file_ext.trim();

        var allowedExtensions = new Array("jpg", "png", "webp","gif");
        if (allowedExtensions.includes(file_ext)) {
            $("#file-error").html('Valid File! Click on Upload button to upload.').css({
                'color': 'green'
            });
        } else {
            thisEle.val('');
            $("#file-error").html('Only .webp, .jpg and .png file is allowed!!').css({
                'color': 'red'
            });
        }
    });

    $(document).on('click', "#save_resource_btn", function(event) {
        event.preventDefault();

        $("#save_resource-error").text('');

        var formEle = $('#update_resource_form');
        if(formEle.find("#title").val() == ''){
            $('#title-error').removeClass('hide').html('Please enter title!!').css({"color":"red"});
            return false;
        }
        $('#title-error').addClass('hide').html('');

        if(formEle.find("#url").val() == ''){
            $('#url-error').removeClass('hide').html('Please enter url!!').css({"color":"red"});
            return false;
        }
        $('#url-error').addClass('hide').html('');

        if(formEle.find("#type").val() == ''){
            $('#type-error').removeClass('hide').html('Please select banner type!!').css({"color":"red"});
            return false;
        }
        $('#type-error').addClass('hide').html('');

        // if (formEle.find("#file").val() == '') {
        //     formEle.find("#file-error").html('Please select file!').css({
        //         'color': 'red'
        //     });
        //     return false;
        // }
        // formEle.find("#file-error").html('');

        var thisButton = $(this);
        if (thisButton.data('requestRunning')) {
            return;
        }
        thisButton.data('requestRunning', true);
        thisButton.prop("disabled", true);

        $("#save_resource-error").text('');

        var url = formEle.attr('action');
        var formData = new FormData(formEle.get(0));
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            url: url,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data) {
            if (data.status == 'OK') {
                $("#save_resource-error").removeClass('hide').text(data.message).css({
                    "color": "green"
                });
                setTimeout(function() {
                    $("#edit_resource_modal .close").click();
                    $("#resource_modal_div").empty();
                    window.location.reload();
                }, 2000);
            } else {
                $("#save_resource-error").removeClass('hide').text(data.message).css({
                    "color": "#FF5733"
                });
                $("#title-error").removeClass('hide').text(data.errors.title).css({
                    "color": "#FF5733"
                });
            }
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            $("#save_resource-error").removeClass('hide').text('Error Occured!!').css({
                "color": "#FF5733"
            });
        }).always(function() {
            thisButton.data('requestRunning', false);
            thisButton.prop("disabled", false);
        });
    });

});
</script>
