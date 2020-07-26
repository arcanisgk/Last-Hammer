<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?=$code?> Error | Error Control Software</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="/assets/img/logos/favicon.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/adds/reset.css">
    <link rel="stylesheet" href="/assets/css/adds/destyle.css">
    <!-- CSS Inspinia Core -->
    <link rel="stylesheet" href="/assets/css/adds/bootstrap.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/adds/animate.css">
    <link rel="stylesheet" href="/assets/css/error.css">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 10%;">
            <div class="offset-lg-3 col-lg-6">
                <div class="middle-box text-center animated fadeInDown">
                    <h1 class="text-danger">
                        <?=$code?>
                    </h1>
                    <h3 class="font-bold">
                        <?=$errortext?>
                    </h3>
                    <div class="error-desc">
                        We are sorry, but the page or file you are looking for has a Status of:
                        <?=$errortext?>.<br> Try to verify the URL / Web address, to see if there are errors, if the problem persists, contact the support staff of the application.
                    </div><br>
                    <button type="button" class="btn btn-info" id="return">Refresh to Home</button>
                    <div class="error-desc">
                        <br>
                        <strong class="fo-copy">
                            <i class="fas fa-registered"></i>
                            Developed by:
                            <a href="#" class="text-decoration-none">Icaros Net S.A </a>
                            and Powered by:
                            <a href="#" class="text-decoration-none">Last Hammer </a>
                            <i class="fas fa-copyright"></i>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script defer src="/assets/js/adds/jquery.min.js"></script>
    <script defer src="/assets/js/adds/popper.min.js"></script>
    <script defer src="/assets/js/adds/bootstrap.js"></script>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        function refresh() {
            document.location.href = "/";
        }
        $("#return").on("click", refresh);
    });
    </script>
</body>

</html>