@extends('layout.app')

@section('title') Show @endsection

@section('content')

<div class="card">
  <div class="card-header">
    Post Information
  </div>
  <div class="card-body">
    <h5 class="card-title">Title : {{$post->title}}</h5>
    <p class="card-text">Description : {{$post->description}} </p>
  </div>
  
</div>

<div class="card" style="margin-top:4px;">
  <div class="card-header">
    Post Creator Information
  </div>
  <div class="card-body">
    <h5 class="card-title">Name : {{$post->user ? $post->user->name : 'not found'}}</h5>
    <p class="card-text">Email : {{$post->user ? $post->user->email : 'not found'}}</p>
    <p class="card-text">Created At : {{$post->created_at}}</p>
  </div>
</div>
<div class="card" style = "margin : 15px 20% ;">
  <form class="card-body" action="{{route('comments.store',[$user_id,$post->id])}}" method="post">
    @csrf
    <h5 class="card-title">Write a comment</h5>
    <div class="form-floating mb-2">
      <textarea class="form-control" name ="content_of_comment"placeholder="Leave a comment here" id="floatingTextarea"></textarea>
      <label for="floatingTextarea">Type</label>
    </div>
    <button class="btn btn-info" type="submit">Add</button>
    @if($errors->any())
      <div class ="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
              @endforeach
        </ul>
      </div>
    @endif
  </form>
</div>
@foreach($comments as $comment)
  <div class="card" style = "margin : 15px 20% ;">
    <div class="card-header">
      Comment
    </div> 
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>{{$comment->content}}</p>
        <footer class="blockquote-footer">{{$comment->user->name}}</footer>
        @if($comment->user_id == $user_id)
          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Edit
          </button>
          <form class="dropdown-menu p-3" method="POST" action="{{route('comments.update',$comment->id)}}" >
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="floatingTextarea">Type</label>
              <textarea class="form-control" name ="edited_content"placeholder="edited comment" id="floatingTextarea"></textarea>
            </div>
            <button class="btn btn-info" type="submit">Edit</button>
          </form>
          <form style = "display:inline;" action="{{route('comments.destroy',$comment['id'])}}" 
            method = "POST" onsubmit ="return confirm('Are you sure you want to delete this comment?');">
            @csrf 
            @method('DELETE')
            <button type = "submit" class="btn btn-danger">Delete</button>
          </form> 
        @endif
      </blockquote>
    </div>
    
  </div>
@endforeach
@endsection