
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User management interface</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('css/main_css.css') }}">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class = 'container'>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link"href="{{ route('User.index')}}">User List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="{{ route('Groups.index')}}">Group List</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

  <div class="container">
@yield('content')
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/js"></script>
</body>
</html>