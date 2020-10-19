
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Error 404 </title>
    <link rel="icon" type="image/x-icon" href="{{ url('public') }}/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ url('public') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public') }}/assets/css/pages/error/style-400.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>
<body class="error404 text-center">
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">500</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-4 mt-1">Internal Server Error!</p>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-5">Go Back</a>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ url('public') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{ url('public') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ url('public') }}/bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>
