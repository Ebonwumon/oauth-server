<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="University of Alberta Login">

    <title>@yield('title', 'Log in to UAlberta')</title>

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!--<link rel="stylesheet" href="/css/pure386.css"/> -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/forms.css">

</head>
<body>
<nav class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="#">UAlberta Login</a>

        <ul>
            <li class="pure-menu-selected"><a href="http://ualberta.ca">Home</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="wrap">
    <div class="content-wrapper">
        @yield('content')
    </div>
    <div class="footer l-box is-centered">
        &copy; IST Supersecret Ninja Project Team
    </div>
</div>
</body>
</html>