<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Sign In </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container " style="margin: 15%;">
      @if($errors->any())
        <div class ="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form style = "display:inline;" action= "{{route('login.check')}}">
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-1 col-form-label"><b>Username</b></label>
          <div class="col-sm-5">
            <input type="text" name ="username"class="form-control" id="inputEmail3" value="{{old('username')}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-1 col-form-label"><b>Password</b></label>
          <div class="col-sm-5">
            <input type="password" name="password"class="form-control" id="inputPassword3" value="{{old('password')}}">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
      </form>
      <a class="btn btn-secondary" >Sign in</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>