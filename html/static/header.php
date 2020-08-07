<?php
    $date  = date('YmdHis');
    $cdate = date('Y-M-d');
    $title = CLIENT_DATA['SOFTWARE']['SYSNAME'].' | '.CLIENT_DATA['COMPANY']['CNAME'].' | '.CLIENT_DATA['COMPANY']['CID'].' | v:'.CLIENT_DATA['SOFTWARE']['VERSION'].'.'.CLIENT_DATA['SOFTWARE']['BUILD'].' | '.$cdate;
?>
<!DOCTYPE html>
<html lang="{lang}" xml:lang="{lang}" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1, user-scalable=0, shrink-to-fit=no" />
    <!-- Info Web -->
    <meta property="og:title" content="<?=$title?>" />
    <meta property="og:description" content="{PageDescription}" />
    <meta name="description" content="{PageDescription}" />
    <meta name="category" content="{PageDescription}" />
    <meta name="author" content="{Author}" />
    <title>
        <?=$title?>
    </title>
    <!-- Icono  de la web -->
    <link rel="shortcut icon" href="favicon.ico?<?=$date?>" />
    <link rel="icon" href="assets/img/logos/favicon.png?<?=$date?>" type="image/png" />
    <link rel="stylesheet" href="assets/css/adds/reset.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/adds/destyle.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/adds/bootstrap.css?<?=$date?>">
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/adds/animate.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/adds/pace.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/c-reset.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/lh-error.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/lh.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/lh-sa.css?<?=$date?>">
    <link rel="stylesheet" href="assets/css/lh-themes.css?<?=$date?>">
</head>