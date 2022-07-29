<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('custom/style.css')}}">

  <title>Login</title>

<body class="main-bg">
@include('sweetalert::alert')
  <div class="login-container text-c animated flipInX">
    <div>
      <h1 class="logo-badge text-whitesmoke"><span><img class="img" src="{{asset('images/logo.png')}}" alt=""></span></h1>
    </div>
    <h4 class="text-whitesmoke">Selamat Datang Di Sistem Informasi Monitoring</h4>
    <div class="container-content">
      <form class="margin-t" action="/login" method="post">
        @csrf
        <div class="form-group">
          <input type="text" name="email" class="form-control" placeholder="email@example.com" required="">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="*****" required="">
        </div>
        <button type="submit" class="form-button button-l margin-b">Login</button>
      </form>
      <p class="margin-t text-whitesmoke"><small> Sistem Informasi Monitoring &copy; 2022</small> </p>
    </div>
  </div>
</body>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>