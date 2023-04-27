<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/fontawesome/css/all.min.css')?>" >
     <link rel="stylesheet" href="<?= baseUrlTemplate('login/assets/css/fontawesome/css/fontawesome.css')?>" >
     <link href="<?= baseUrlTemplate('login/assets/css/style.css')?>" rel="stylesheet">
     <title>Register</title>
</head>
<body>
<div class="container">
  <div class="card">
        <h1 class="card-title"><i class="fa-solid fa-user-tie fa-2xl"></i></h1>
        <small class="card-subtitle">Upload Your Profile</small>
        <form class="card-form" action="<?= baseUrl('login')?>" method="post" enctype="multipart/form-data" >
            <input type="file" class="card-button" name="profile" >
            <div class="card-input-container phone">
                <input type="text" name="phone" placeholder="Your Phone">
            </div>
            <div class="card-input-container name">
                <input type="text" name="firstName" placeholder="Your firstName">
            </div>
            <div class="card-input-container name">
                <input type="text" name="lastName" placeholder="Your lastName">
            </div>
            <input type="hidden" class="card-button" name="email" value="<?= $email ?>">
            <input type="hidden" class="card-button" name="password" value="<?= $password ?>">
            <input type="hidden" class="card-button" name="re_password"value="<?= $re_password ?>">
            <input type="submit" class="card-button" value="Upload" name="submit">
            <small class="card-forgot-password">You have signed in? <a>login</a></small>
        </form>
    </div>
</div>
</body>
</html>