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
    <form method = "POST" action="{{route('posts.update',[$user_id,$post->id])}}" >
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
        <button name = "submit" class="btn btn-success">Update</button>
    </form>
@endsection