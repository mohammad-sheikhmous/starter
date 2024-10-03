@extends('layout.app')

@section('title') Create @endsection

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
    <form method = "POST" action="{{route('posts.store',$user_id)}}" >
        @csrf 
        <!-- @method('GET') -->
        <input type="hidden" value="{{$user_id}}" name="user_id">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title"id="exampleFormControlInput1" value="{{old('title')}}" placeholder="type a title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name = "description"id="exampleFormControlTextarea1" rows="3">{{old('description')}}</textarea>
        </div>
        <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
            <input type="text" name = "name"class="form-control" id="exampleFormControlInput1" placeholder="type a name">
            <select name="post_creator" id="exampleFormControlInput1" class = "form-control">
                
            </select>
        </div>  -->
        <button name = "submit" class="btn btn-success">Submit</button>
    </form>
@endsection