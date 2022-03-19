 <!--/col-->
<main class="col main pt-5 mt-3 h-100 overflow-auto">
    <a id="more"></a>
    <hr>
    <h2 class="sub-header mt-5">Use card decks for equal height rows of cards</h2>
    <div class="mb-3">
        @if($errors->any())
           {!! implode('', $errors->all('<div style="color:red;">:message</div>')) !!}
        @endif
        <div class="card-deck">
            <div class="card card-inverse card-success text-center">
                <div class="card-body">
                    <blockquote class="card-blockquote">
                        <p>It's really good news that the new Bootstrap 4 now has support for CSS 3 flexbox.</p>
                        <footer>Makes flexible layouts <cite title="Source Title">Faster</cite></footer>
                    </blockquote>
                </div>
            </div>
            <div class="card card-inverse card-danger text-center">
                <div class="card-body">
                    <blockquote class="card-blockquote">
                        <p>The Bootstrap 3.x element that was called "Panel" before, is now called a "Card".</p>
                        <footer>All of this makes more <cite title="Source Title">Sense</cite></footer>
                    </blockquote>
                </div>
            </div>
            <div class="card card-inverse card-warning text-center">
                <div class="card-body">
                    <blockquote class="card-blockquote">
                        <p>There are also some interesting new text classes for uppercase and capitalize.</p>
                        <footer>These handy utilities make it <cite title="Source Title">Easy</cite></footer>
                    </blockquote>
                </div>
            </div>
            <div class="card card-inverse card-info text-center">
                <div class="card-body">
                    <blockquote class="card-blockquote">
                        <p>If you want to use cool icons in Bootstrap 4, you'll have to find your own such as Font Awesome or Ionicons.</p>
                        <footer>The Glyphicons are not <cite title="Source Title">Included</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
</main>
<!-- Modal -->
<!-- Register page model -->
<div class="modal fade" id="myAlert" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/')}}/save" enctype="multipart/form-data">@csrf
                   <input type="text" name="firstName" placeholder="Enter first Name">
                   <input type="text" name="middleName" placeholder="Enter middle Name">
                   <input type="text" name="lastName" placeholder="Enter last Name">
                   <input type="text" name="mobile" placeholder="Enter Mobile Number">
                   <input type="email" name="email" placeholder="Enter Email Id">
                   <input type="text" name="passwordHash" placeholder="Enter password ">
                   <label>Profile Upload Here: </label>
                   <input type="file" class="form-control" name="profile"><br>
                   <textarea type="text" name="intro" class="form-control" placeholder="Introduce Your self...."></textarea> 
                   <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </form>   
            </div>
        </div>
    </div>
</div>
<!-- login page model -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>This is a dashboard layout for Bootstrap 4. This is an example of the Modal component which you can use to show content.
                Any content can be placed inside the modal and it can use the Bootstrap grid classes.</p>
                <p>
                    <a href="https://www.codeply.com/go/KrUO8QpyXP" target="_ext">Grab the code at Codeply</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-outline" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>