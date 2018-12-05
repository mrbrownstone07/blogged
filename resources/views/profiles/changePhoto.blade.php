




<form action="/uploadPhoto" method="post" enctype="multipart/form-data">
  {{method_field('patch')}}
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="file" name="pic" class="form-control-file"/>
  <br>
  <input type="submit" class="btn btn-outline-success" name="btn" id="img_submit"/>
</form>