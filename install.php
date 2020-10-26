<?php
$date  = date('YmdHis');
$title = 'Last-Hammer';
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1, user-scalable=0, shrink-to-fit=no"/>
    <title>
        <?php echo $title; ?>
    </title>
    <!-- Icono  de la web -->
    <link rel="shortcut icon" href="favicon.ico?<?php echo $date; ?>"/>
    <link rel="icon" href="asset/img/logo/favicon.png?<?php echo $date; ?>" type="image/png"/>
    <link rel="stylesheet" href="asset/css/adds/reset.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/css/adds/destyle.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/css/adds/bootstrap.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/font/fontawesome/css/all.min.css?<?php echo $date; ?>">
    <link rel="stylesheet" href="asset/css/lh.css?<?php echo $date; ?>">
</head>

<body>
<div class="container">
    hello world
</div>
<!-- JS Files -->
<script defer src="asset/js/adds/jquery.min.js?<?php echo $date; ?>"></script>
<script defer src="asset/js/adds/popper.min.js?<?php echo $date; ?>"></script>
<script defer src="asset/js/adds/bootstrap.js?<?php echo $date; ?>"></script>
<!-- Return Home Script -->
<script type="text/javascript">
    /*document.addEventListener("DOMContentLoaded", function () {
        function refresh() {
            document.location.href = "/";
        }

        document.getElementById("return").addEventListener("click", function () {
            refresh();
        });
    });*/
</script>
</body>

</html>
