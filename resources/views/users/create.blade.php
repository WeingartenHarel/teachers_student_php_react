<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- default css file -->

    <!--owl carousel for smothing-->
    <link rel="stylesheet" href="Css/owl.carousel.min.css">
    <link rel="stylesheet" href="Css/owl.theme.default.min.css">

    <!-- font awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- page title -->
    <title>Page Perfect</title>
    <link rel="shortcut icon" href="img/p.png">
    <style>
        label{ 
            color:black;
        }
    </style>
</head>
<body>
    <form method="post" action="{{ route('user.store') }}">
                        
<div class="container">    
<div class="row">
    <h2>Edit Messages</h2>
    <div class="col-md-4">
        <div class="form-group m-4">
            <label>Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter your name" id="name"
                autocomplete="off">
        </div>
    </div>
    @csrf
    <div class="col-md-4">
        
        <div class="form-group m-4">
            <label>Email</label>
            <input name="email" type="email" class="form-control" placeholder="Enter your email"
                id="email" autocomplete="off">
        </div>
    </div>

    <div class="col-md-4">
        
        <div class="form-group m-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        
    <input type="submit" name="submit" class="btn btn-primary">
    </div>

</div>
</div>
</form>
</body>
