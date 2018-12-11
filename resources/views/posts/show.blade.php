@extends('layouts.profile_master')

@section('mid_section')
    {{--  <div class="jumbotron">
        <
    </div>  --}}
    @if (count($post) === 1)
        @foreach ($post as $item)
            
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$item->title}}</h4>
                        @php
                            $t= (new Carbon\Carbon( $item->time))->diffForHumans();
                        @endphp
                        <small class="card-title">posted: {{ $t}}</small>
                        <hr>
                        <div class="card-text">
                            {{$item->body}}
                        </div>
                    </div>
                </div>
          
        @endforeach       
    @else
        <p> Post could not be found! </p>
    @endif

@endsection
{{--  <script language="JavaScript" type="text/javascript">
    setTimeout("location.href = '/posts/{{$item->post_id}}'",10000); // milliseconds, so 10 seconds = 10000ms
</script>  --}}