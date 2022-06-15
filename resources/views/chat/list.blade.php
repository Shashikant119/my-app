<div class="col-lg-12">
    <div class="card chat-app">
        <div id="plist" class="people-list">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            <ul class="list-unstyled chat-list mt-2 mb-0">
                @isset($user_list)
                @foreach($user_list as $keys => $value)
                <li class="clearfix">
                    @if(!empty(@$value->profile))
                    <img src="{{$value->profile}}" alt="avatar">
                    @else
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                    @endif
                    <div class="about">
                        <div class="name">{{@$value->name}}</div>
                        @if(Auth::id() == $value->id)
                         <div class="status"> <i class="fa fa-circle online"></i> online </div>
                        @else
                        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>  
                        @endif                                          
                    </div>
                </li>
                @endforeach
                @endisset
            </ul>
        </div>
        <div class="chat">
            <div class="chat-header clearfix">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                            <img src="{{$user_profile}}" alt="avatar">
                        </a>
                        <div class="chat-about">
                            <h6 class="m-b-0">{{$user_name}}</h6>
                            <small>Last seen: 2 hours ago</small>
                        </div>
                    </div>
                    <div class="col-lg-6 hidden-sm text-right">
                        <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                        <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                        <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                        <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                    </div>
                </div>
            </div>
            <div class="chat-history">
                <ul class="m-b-0">
                    @foreach($message as $keys => $value)
                    @if(Auth::id() == $value->user_id)
                    <li class="clearfix">
                        <div class="message-data text-right">
                            <span class="message-data-time">{{date("jS F, Y",strtotime($value->created_at))}}</span>
                            <img src="{{$value->profile}}" alt="avatar">
                        </div>
                        <div class="message other-message float-right">{!! $value->messages !!}</div>
                    </li>
                    @else
                    <li class="clearfix">
                        <div class="message-data">
                            <span class="message-data-time">{{$value->name}}</span>
                        </div>
                    <div class="message my-message">{!! $value->messages !!}</div><br>
                    <span>{{date("jS F, Y",strtotime($value->created_at))}}</span></li>  
                    @endif
                    @endforeach                             
                </ul>
            </div>
            <div class="input-group mb-0">
                <input type="text" class="form-sms" id="sms" placeholder="Enter text here...">  
                <input type="submit" name="submit" value="Send" class="btn-btn-primary btn-send">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
//send sms processs
$(document).on("click", ".btn-send", function(event){
    event.preventDefault();
    var sms = $('#sms').val();
     $.ajax({
       url: "{{route('chat.save')}}",
        type: 'POST',
        dataType: 'JSON',
        data: {
            "_token": "{{ csrf_token() }}",
            sms:sms,
        },
        success: function (response) {
            if (response.status == 'success') {
                window.location.reload();
                console.log('okay');
            }else{
                console.log('Error');
            }
        } 
    });
});
</script>