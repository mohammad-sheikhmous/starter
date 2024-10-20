@extends('layout.app')

@section('title') Index @endsection

@section('content')

    @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
      </div>
    @endif
    <div class="alert alert-success" style="display:none;" id="success_msg" role="alert">
      the item deleted successfully    
    </div>
    <div class = "text-center">
        <a href = "{{route('posts.create',$user_id)}}" class="btn btn-success">Create</a>
        <a href = "{{route('ajax.posts.create',$user_id)}}" class="btn btn-success">Ajax-Create</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Posted by</th>
          <th scope="col">Created at </th>
          <th scope="col">Actions </th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @foreach($posts as $post)
            <tr class="postRow{{$post['id']}}">
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->user ? $post->user->name : 'not found'}}</td>
                <td>{{$post->created_at->format('Y-M-d')}}</td>
                <td>
                <a href="{{route('posts.show',[$user_id,$post['id']])}}" class="btn btn-info">View</a>
                @if($user_id==$post['user_id'])
                <a href="{{route('posts.edit',[$user_id,$post['id']])}}"  class="btn btn-primary">Edit</a>
                <a href="{{route('ajax.posts.edit',[$user_id,$post['id']])}}"  class="btn btn-primary">Ajax-Edit</a>
                <form style = "display:inline;" action="{{route('posts.destroy',[$user_id,$post->id])}}" 
                method = "POST" onsubmit ="return confirm('Are you sure you want to delete this item?');">
                  @csrf 
                  @method('DELETE')
                  <button type = "submit" class="btn btn-danger">Delete</button>
                </form>
                <form style = "display:inline;" action="{{route('ajax.posts.destroy',$user_id)}}" id="blog_id"
                method = "post" onsubmit ="return confirm('Are you sure you want to delete this item?');">
                  @csrf 
                  @method('DELETE')
                  <input type="text" value="{{$post['id']}}" name="post_id" style="display:none;">
                  <button type ="" class="delete_btn btn btn-danger">Ajax-Delete</button>
                </form> 
                @endif
                <!--why did we use the button and form, because we want to send the data to delete verb, 
                therefore when we want to send the data to post, put and delete we will send them by the form  -->
                </td>
            </tr>
        @endforeach
        <!-- <script>
                  // JavaScript function to confirm deletion
                  function confirmDelete() {
                    return confirm('Are you sure you want to delete this item?');
                  }
        </script> -->
      </tbody>
    </table>
    {{ __('messages.contact') }}
    @lang('messages.about')
@endsection
@section('scripts')
  <script>
    $(document).on('click','.delete_btn',function(e){
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
          $('.postRow'+data.id).remove();
        },
        error: function(reject){}
      });
    })
  </script>
@endsection
