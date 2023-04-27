<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/fontawesome/css/all.min.css')?>" >
     <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/fontawesome/css/fontawesome.css')?>" >
    <link href="<?= baseUrlTemplate('login/assets/css/style.css') ?>" rel="stylesheet" type='text/css'>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="card-title">Hello Again!</h1>
            <small class="card-subtitle">Enter your credentials and get access</small>
            <form class="card-form" action="<?= baseUrl('isUserLogin')?>" method="POST">
                <label for="email">Email</label>
                <div class="card-input-container email">
                    <input type="text" placeholder="Enter your username" name="email">
                </div>
                <label for="password">Password</label>
                <div class="card-input-container password">
                    <input type="password" placeholder="Enter your password" name="password">
                </div>
                <button class="card-button">Sign In</button>
                <small class="card-forgot-password">Forgot your passwrod ? <a>Reset Password</a></small>
            </form>
        </div>
    </div>
</body>

</html>