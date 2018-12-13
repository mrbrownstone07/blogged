<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

</style>


<div id="i" class="card shadow-sm card_marg text-center cotentsection card_margin">
    <div class="card-header">
            informations
            @if (Auth::user()->id == $usrData->id)
                <a href="/editInfo">
                    <img src="{{ URL::to('img/icons/edit.png')}}" alt="image not found" class="icon_wrap">    
                </a>             
            @endif

    </div>

    @if (!empty($data))
        <div class="card-body card_marg" style="">
            <div class="row">
                <div class="col-md-12">
                    {{$data->fname .' '. $data->lname}}
                    <hr>
                </div>
            </div>
                    
        
            <div class="row">
                <div class="col-md-12">
                    {{$usrData->sex}}
                    <hr>
                </div>
            </div>
            
            <div class="row">
                
            </div>      
            <div class="col-md-12" style="">
                <h6 style="font-weight:bolder">Bio</h6>
                {{$data->bio}}
            </div>
            <hr>
            <div class="row">
                    
                <div class="col-md-12">
                    Lives in <span> {{$data->city}}, {{$data->country}} </span> 
                </div>         
            </div>
            <div class="row">
                <div class="col-md-12">
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('M Y');
                    @endphp
                    Joined in {{$date}}
                </div>
            </div>
            
        </div>
                
    @endif
    {{--  <div v-if="isEmpty">
        No Informations Updated
    </div>
    <div class="card-body card_marg" style="">
        <div class="row">
            <div class="col-md-12">
                @{{profileData[0].fname +' '+ profileData[0].lname}} 
                <hr>
            </div>
        </div>
        <div class="row">
            
        </div>      
        <div class="col-md-12" style="">
            @{{profileData[0].bio}}
        </div>
        <hr>
        <div class="row">    
            <div class="col-md-12">
                Lives in <span> @{{profileData[0].city}}, @{{profileData[0].country}} </span> 
            </div>         
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                joined in <small> @{{profileData[0].created_at | joined_on}} </small>    
            </div>
        </div>
        
    </div>  --}}

</div>  

