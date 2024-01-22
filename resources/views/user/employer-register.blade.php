<!DOCTYPE html>
    <html lang="en">
      <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <title>CoreUI Free Bootstrap Admin Template</title>
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('users/assets/favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('users/assets/favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('users/assets/favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('users/assets/favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('users/assets/favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('users/assets/favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('users/assets/favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('users/assets/favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('users/assets/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('users/assets/favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('users/assets/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('users/assets/favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('users/assets/favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('users/assets/favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('users/assets/favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- Vendors styles-->
        <link rel="stylesheet" href="{{asset('users/vendors/simplebar/css/simplebar.css')}}">
        <link rel="stylesheet" href="{{asset('users/css/vendors/simplebar.css')}}">
        <!-- Main styles for this application-->
        <link href="{{asset('users/css/style.css')}}" rel="stylesheet">
        <!-- We use those styles to show code examples, you should remove them in your application.-->
        <link href="{{asset('users/css/examples.css')}}" rel="stylesheet">
      </head>
      <body>
        <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card mb-4 mx-4" id="card">
                  <div class="card-body p-4">
                    <h1>Employer Register</h1>
                    @if(Session::has('successMessage'))
                      <div class="alert-success">{{Session::get('successMessage')}}</div>
                    @endif
                  
                    <form action="#" method="post" id="registrationForm">
                      
                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                          </svg>
                        </span>
                        <input class="form-control" required name="name" type="text" placeholder="Company Name">
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name')}}</span>
                            @endif
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                          </svg>
                        </span>
                        <input class="form-control" required  name="email" type="text" placeholder="Email">
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                          </svg>
                        </span>
                        <input class="form-control" required type="password" name="password" placeholder="Password">
                        @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password')}}</span>
                        @endif
                      </div>
                      <button class="btn btn-block btn-success " name="submit" id="btnRegister">Create Account</button>
                    </form>



                </div>
                <div id="message"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- CoreUI and necessary plugins-->
        <script src="{{asset('users/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
        <script src="{{asset('users/vendors/simplebar/js/simplebar.min.js')}}"></script>
        <script>
        </script>
<script>
  var url = "{{ route('create.employer') }}";
  document.getElementById("btnRegister").addEventListener("click", function(event) {
    var form = document.getElementById("registrationForm");
    var messageDiv = document.getElementById('message');
    messageDiv.innerHTML = '';
    var formData = new FormData(form);

    var button = event.target;
    button.disabled = true;
    button.innerHTML = 'Sending email.... ';

    fetch(url, {
      method: "POST",
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: formData
    }).then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error('Error');
      }
    }).then(data => {
      // Assuming the server responds with a success message upon successful data insertion
      if (data.success) {
        button.innerHTML = 'Register';
        button.disabled = false;
        messageDiv.innerHTML = '<div class="alert alert-success">Registration was successful. Please check your email to verify it</div>';
        form.reset(); // Optional: Reset the form after successful registration
      } else {
        throw new Error('Error');
      }
    }).catch(error => {
      button.innerHTML = 'Register';
      button.disabled = false;
      messageDiv.innerHTML = '<div class="alert alert-success">Registration was successful. Please check your email to verify it</div>';
    });
  });
</script>


      </body>
    </html>
