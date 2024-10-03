@extends('layout.app')

@section('title') Index @endsection

@section('content')
    <div class = "text-center">
        <a href = "{{route('posts.create',$user_id)}}" class="btn btn-success">Create</a>
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
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->user ? $post->user->name : 'not found'}}</td>
                <td>{{$post->created_at->format('Y-M-d')}}</td>
                <td>
                <a href="{{route('posts.show',[$user_id,$post['id']])}}" class="btn btn-info">View</a>
                @if($user_id==$post['user_id'])
                <a href="{{route('posts.edit',[$user_id,$post['id']])}}"  class="btn btn-primary">Edit</a>
                <form style = "display:inline;" action="{{route('posts.destroy',[$user_id,$post->id])}}" 
                method = "POST" onsubmit ="return confirm('Are you sure you want to delete this item?');">
                  @csrf 
                  @method('DELETE')
                  <button type = "submit" class="btn btn-danger">Delete</button>
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