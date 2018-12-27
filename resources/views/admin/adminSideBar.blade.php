<style>
        .bar_set{
            position: relative;
            overflow-y: hidden;
            overflow-x: hidden;
        }
    
        .bar_set:hover{
            overflow-y: scroll;
        }
        #Scrollstyle::-webkit-scrollbar-track{
            background-color: #FFFFFF;
        }
    
        #Scrollstyle::-webkit-scrollbar{
            width: 8px;
            background-color: rgba(106, 97, 97, 0.55);
        }
    
        #Scrollstyle::-webkit-scrollbar-thumb{
            background-color: #555;
        }
    
        .Fixed{
            position: fixed;
            width: 23%;
        }
    
        .link_fix{
            text-decoration: none;
            color:black;
        }
    
        .link_fix:hover{
            text-decoration: none;
            color:grey;        
        }
    </style>
    
<div  class="card Fixed shadow-sm bg-dark text-white" style=" height: 87%">
    <div class="card-header text-center">
       <a href="/admin_log_in_request"> Admin Panel </a> 
    </div>

    <div class="card-body text-center">
        <div class="row">
            <div class="col-md-12">
                <a href="/showAllPosts"> Posts </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="/showAllUsers"> Users </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="/showAllRooms"> Rooms </a>
            </div>
        </div>
    </div>
</div>