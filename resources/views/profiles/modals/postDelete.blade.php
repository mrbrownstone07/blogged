@if (count($posts) > 0)
<div class="modal" id="deletePost">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title">Delete post?</p> 
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
              
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="p" id="hidden_value" value=""/>
                    <div class="row">
                        <div class="container">
                            <p class="text-left"> 
                                Are you sure you want to delete this post? 
                                <br> You can edit it if you just need to change something. 
                            </p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">No, Cancel</button>                         
                        </div>
                        <div class="col-md-1">                         
                            {!! Form::open(['action' => ['PostsController@destroy', $p->post_id], 'method' => 'POST', 'class' => '']) !!}

                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::submit('Yes, Delete', ['class' => 'btn btn-outline-danger']) !!}
    
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endif