<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Admin Templates & Dashboard UI Kits">
    <meta name="author" content="Bootstrap Gallery" />


    <!-- Title -->
    <title>Restaurant management system</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="../../../fonts/style.css">
<style>
     .footer {
            position: fixed;
            bottom: 0;
            right: 0;
            padding: 10px;
            background-color: rgb(59, 86, 68); /* Adjust opacity as needed */
            color: white;
            border-top-left-radius: 10px;
        }
</style>
</head>

<body style="background-color: rgb(59, 86, 68)">

    <div class="text-center" style="margin-top: 90px">
        <img src="th1.jpg" alt="" style="height: 120px; width:200px; border-radius:5%">
    </div>
    <div class="text-center" style="margin-top: 40px">
        <h4 style="color: white">Restaurant Table Management System</h4>
    </div>
    <div class="row" style="margin-left: 20px;margin-right:10px;margin-top: 70px">
        @foreach ($users as $user)
            @if ($user->getRoleNames()->contains('Waiter'))
                <div class="col-md-2">
                    <div class="card text-center " style="padding: 5%;border-radius:5%;  ">
                        <a href="/login" style="color:black; text-decoration:none;">
                            <i class="icon-user " style="font-size: 50px"></i>
                            <h3 class="text-center">{{ $user->name }}</h3>
                        </a>

                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="footer">
        Powered By <img src="SkyLinkLogo.png" alt="" style="height: 60px; width: 160px;">
    </div>
    <div>

    </div>


    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/moment.js"></script>



    <script src="../../vendor/slimscroll/slimscroll.min.js"></script>
    <script src="../../vendor/slimscroll/custom-scrollbar.js"></script>


</body>

</html>
