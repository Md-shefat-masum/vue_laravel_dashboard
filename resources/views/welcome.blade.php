<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO META -->
    <link rel="shortcut icon" type="image/x-icon" href="https://md-shefat-masum.github.io/dashboard_ui/fabicon.jpg">
    <meta name="robots" content="index, follow">
    <!-- <meta http-equiv="refresh" content="5"> -->

    <meta name="logo" content="https://md-shefat-masum.github.io/dashboard_ui/assets/images/logo.png">
    <meta name="Classification" content="Website">
    <meta name="identifier-URL" content="https://md-shefat-masum.github.io/dashboard_ui/">
    <meta name="directory" content="submission">
    <meta name="category" content="Internet">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="target" content="all">
    <meta name="HandheldFriendly" content="True">
    <meta name="author" content="">
    <meta name="developer" content="">
    <meta name="developer-email" content="">
    <meta name="developer-company" content="">
    <meta name="copyright" content="https://md-shefat-masum.github.io/dashboard_ui/">
    <meta name="price" content="Call for price - ">

    <meta name="keywords" content="UI website, Dashboard UI, responsive website">
    <meta name="description" content="this is a Dashboard UI website">

    <meta property="og:title" content="Dashboard UI" />
    <meta property="og:site_name" content="Dashboard UI" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="https://md-shefat-masum.github.io/dashboard_ui/" />
    <meta property="og:image" content="https://md-shefat-masum.github.io/dashboard_ui/mockup/1.jpg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />

    <meta name="twitter:title" content="Dashboard UI">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="https://md-shefat-masum.github.io/dashboard_ui/mockup/1.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="fabicon" type="image/png" sizes="16x16" href="https://techparkit.org/favicon.png">

    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="/contents/dashboard/assets/styles/app.css">
    <script src="/contents/dashboard/assets/js/sweat_alert.js"></script>

    @vite(['resources/css/app.css', 'resources/js/dashboard/app.js'])
</head>

<body>
    <div id="app">
        <dashboard></dashboard>
    </div>
</body>

</html>
