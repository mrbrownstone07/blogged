<style>
    .dropdown_size{
        width: inherit;
        height: 500px;
    }
</style>
<li class="nav-item dropdown" style="list-style-type: none;">
    <input action="SearchController@index" autocomplete="off" type="text" class="form-control dropdown-toggle rounded" data-toggle="dropdown" id="s" name="s" placeholder="search"></input>
    
    <div id="Scrollstyle" class="drop_size scrollable-menu dropdown-menu scrollable-menu dropdown-menu-right shadow-lg" aria-labelledby="navbarDropdown">
        <div class="dropdown-item" id="name">
        
        </div>      
    </div>
</li>

<script>
    window.onload = function(){
        $('#s').keyup(function(e){
            $value=$(this).val();
            console.log($value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }),
            
            $.ajax({
                method: 'GET',
                url: '{{URL::to('search')}}',
                data: {'search': $value},
                success:function(data){
                    console.log(data);
                    if($value != ''){
                        $('#Scrollstyle').html(data);
                    }else{
                        data = '';
                        $('#Scrollstyle').html(data);
                    }
                        
                }
            })
        });
    }

</script>