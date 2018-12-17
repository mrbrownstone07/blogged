@php
                        $noti_count = 0;
                        foreach ($notifications as $noti) {
                            if($noti->notification_status == 0){
                                $noti_count++;
                            }
                        }   
                    @endphp

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ URL::to('img/icons/noti.png')}}" alt="image not found" class="p_icon_wrap">
                            @if ($noti_count > 0)
                                <span class="badge noti_badge badge-pill">{{$noti_count}}</span>                                
                            @endif    
                        </a>

                        <div id="Scrollstyle" class="dropdown-menu scrollable-menu dropdown-menu-right shadow-lg " aria-labelledby="navbarDropdown">
                            
                            <div class="dropdown-header position-fixed col-12" style="background-color:white; margin-top:-10px">
                                    <b> Notifications </b>       
                            </div>
                            
                            
                            
                            <br>
                            @if (count($notifications) > 0)
                                
                                <hr class="divider" style=" margin-top:2px">
                                <small class="dropdown-header line_header"> NEW </small>
                                <hr class="divider">
                                
                                @if($noti_count == 0)
                                    <div class="dropdown-item text-center">
                                        <small> No new notification </small>    
                                    </div>
                                    <hr class="divider" style="">
                                @endif

                                @foreach ($notifications as $noti)
                                    @if ($noti->notification_status == 0)
                                        <a href="/show_notifiaction/{{$noti->notification_id}}/{{$noti->notification_type}}" 
                                                class="dropdown-item unseen_noti_bg">
                                            <div class="dropdown-item">
                                                <div class="row">
                                                    <div class="text-left">
                                                        
                                                        <img src="{{ URL::to('img/user_imgs/' . $noti->profile_pic) }}" 
                                                            alt="image not found" class="rounded-circle" style="width:30px; height:30px">  
                                                        <b> {{'@'.$noti->name}} </b>      
                                                    
                                                        
                                                        @if ($noti->notification_type == 1)
                                                            started following you !
                                                        @endif

                                                        @if($noti->notification_type == 2)
                                                            @php
                                                                $notiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                            SELECT post_reacted
                                                                            FROM react_notifications 
                                                                            WHERE noti_id = '$noti->notification_id')"
                                                                        );
                                                                
                                                            @endphp

                                                            @if (!empty($notiPost[0]->title))
                                                                @php
                                                                    $title = substr($notiPost[0]->title, 0, 10);
                                                                @endphp
                                                                liked your post!  <b> {{$title}} </b>
                                                            @endif
                                                           
                                                            
                                                        @endif

                                                        
                                                        @if ($noti->notification_type == 3)
                                                            @php
                                                                $comNotiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                    SELECT post_commented FROM comment_notifications WHERE
                                                                    comment_noti_id = '$noti->notification_id'
                                                                    
                                                                )");

                                                            @endphp
                                                            @if(!empty($comNotiPost[0]))
                                                                @php
                                                                    $title = substr($comNotiPost[0]->title, 0, 10)
                                                                @endphp
                                                                commented on your post <b> {{$title}} </b>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="text-left">
                                                        @php
                                                            $noti_time = (new Carbon\Carbon($noti->notification_send_at))->diffForHumans();
                                                        @endphp
        
                                                        <small> {{$noti_time}} </small> 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="divider" style="">
                                    @endif
                                @endforeach
                                <hr class="divider">
                                <small class="dropdown-header line_header"> EARLIER </small>
                                
                                <hr class="divider" style="">
                                @php
                                    $i = 0
                                @endphp
                                @foreach ($notifications as $noti)
                                    
                                    @if ($noti->notification_status == 1)
                                        <a href="/show_notifiaction/{{$noti->notification_id}}/{{$noti->notification_type}}" 
                                            class="dropdown-item">
                                            <div class="dropdown-item">
                                                <div class="row">
                                                    
                                                        <div class="text-left">
                                                            
                                                            <img src="{{ URL::to('img/user_imgs/' . $noti->profile_pic) }}" 
                                                                alt="image not found" class="rounded-circle" style="width:30px; height:30px">  
                                                            {{'@'.$noti->name}}     
                                                        
                                                            
                                                            @if ($noti->notification_type == 1)
                                                                started following you!
                                                            @endif

                                                            @if ($noti->notification_type == 2)
                                                                @php
                                                                    $notiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                                SELECT post_reacted
                                                                                FROM react_notifications 
                                                                                WHERE noti_id = '$noti->notification_id')"
                                                                            );
                                                                @endphp
                                                                @if(!empty($comNotiPost[0]))
                                                                    @php
                                                                        $title = substr($comNotiPost[0]->title, 0, 10)
                                                                    @endphp
                                                                    commented on your post <b> {{$title}} </b>
                                                                @endif
                                                            @endif

                                                            @if ($noti->notification_type == 3)
                                                                @php
                                                                    $comNotiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                        SELECT post_commented FROM comment_notifications WHERE
                                                                        comment_noti_id = '$noti->notification_id'
                                                                        
                                                                    )");
                                                                    
                                                                    $title = substr($comNotiPost[0]->title, 1, 10);
                                                                @endphp
                                                                @if(!empty($comNotiPost[0]))
                                                                    @php
                                                                        $title = substr($comNotiPost[0]->title, 0, 10)
                                                                    @endphp
                                                                commented on your post <b> {{$title}} </b>
                                                                @endif
                                                                
                                                            @endif
                                                        </div>
                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="text-left">
                                                        @php
                                                        $noti_time = (new Carbon\Carbon($noti->notification_send_at))->diffForHumans();
                                                        @endphp
                                                        <small> {{$noti_time}} </small> 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        
                                        @php
                                        $i++;  
                                        @endphp

                                        @if ($i == 9)
                                            @break;
                                        @endif
                                        <hr class="divider" style="">
                                    @endif

                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="">
                                            <small class="dropdown-item text-center"> View all notifications</small>
                                        </a> 
                                    </div>
                                </div>    
                            @endif


                        </div>
                    </li>