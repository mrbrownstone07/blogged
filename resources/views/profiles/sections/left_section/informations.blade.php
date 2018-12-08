<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

</style>

<div class="card card_marg container content_Section text-center cotentsection card_margin">
    <div class="card-title">
        informations
        <a href="/editInfo">
            <img src="{{ URL::to('img/icons/edit.png')}}" alt="image not found" class="icon_wrap">    
        </a>
        <hr>        
    </div>
    @if (!empty($data))
        <div class="card-body card_marg" style="margin-top: -30px;">
            <div class="row">
                <div class="col-md-12">
                    @php
                        
                    @endphp
                    {{$data->fname .' '. $data->lname}}
                    <hr>
                </div>
            </div>
            <div class="row">
                
            </div>      
            <div class="col-md-12" style="">
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

</div>