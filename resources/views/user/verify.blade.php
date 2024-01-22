
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verfiy</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card">
                <div class="card-header">Verify Account</div>
                <div class="card-body">
                <p>Your account is not verified. Please verify your account. You may resend 
                    the verification email.
    
                    <a href="{{route('resend.email')}}">Resend veification email</a>
    
                </p>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>