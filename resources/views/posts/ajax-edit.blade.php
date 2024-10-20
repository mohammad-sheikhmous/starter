@extends('layout.app')

@section('title') Edit @endsection

@section('content')
    @if($errors->any())
        <div class ="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="alert alert-success" style="display:none;" id="success_msg" role="alert">
      the item deleted successfully    
    </div>
    <form method = "POST" id ="blog_id" action="{{route('ajax.posts.update',[$user_id,$post->id])}}" >
        @csrf 
        @method('PUT')
        <!-- @method('GET') -->
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title"id="exampleFormControlInput1"  placeholder="type a title" value = "{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name = "description"id="exampleFormControlTextarea1" rows="3">{{$post->description}}</textarea>
        </div>
        <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
            // <input type="text" class="form-control"  placeholder="type a name">  //
            <select name="post_creator" id="exampleFormControlInput1" class="form-control" name = "name">
                
            </select>
        </div> -->
        <button id="update_btn" class="btn btn-success">Update</button>
    </form>
@endsection
@section('scripts')
  <script>
    $(document).on('click','#update_btn',function(e){
      e.preventDefault();
      var formData = new FormData($('#blog_id')[0]);
      $.ajax({
        url: $('#blog_id').attr('action'),
        method: $('#blog_id').attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data){
          if(data.status==true){
            $('#success_msg').show();
          }
        },
        error: function(reject){}
      });
    })
  </script>
@endsection
