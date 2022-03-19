 <!--/col-->
<style type="text/css">
  td{color: #fff;}
</style> 
<main class="col main pt-5  mt-3 h-100 overflow-auto">
    <h1 class="display-4 d-none d-sm-block">
    My-App
    </h1>
    <p class="lead d-none d-sm-block">About Us</p>

    <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Holy guacamole!</strong> It's free.. this is an example theme.
    </div>
  
    <a id="features"></a>
    <hr>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sr No.</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th colspan="2" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($user_app as $key => $user)    
      <tr style="background-color: blue">
        <td>{{$key+1}}</td>
        <td>{{$user->firstName}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->mobile}}</td>
        <td>Edit</td>
        <td>delete</td>
      </tr>
    @endforeach  
    </tbody>
  </table>
</main>
  


