<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') </title>
    <link rel="icon" type="image/x-icon" href="{{ url('public') }}/assets/img/favicon.ico" />
    <link href="{{ url('public') }}/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ url('public') }}/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ url('public') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public') }}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('css-custom')
    <link href="{{ url('public') }}/assets/css/elements/custom-pagination.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public') }}/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ url('public') }}/assets/css/elements/alert.css">
    <!--  END CUSTOM STYLE FILE  -->
    <link href="{{ url('public') }}/assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('partial.navbar')
    <!--  END NAVBAR  -->
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->
        @include('partial.sidebar');
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('main')
            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All
                        rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT PART  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ url('public') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{ url('public') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ url('public') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('public') }}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('public') }}/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ url('public') }}/plugins/highlight/highlight.pack.js"></script>
    <script src="{{ url('public') }}/assets/js/custom.js"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ url('public') }}/assets/js/scrollspyNav.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    @yield('js-custom')
    <script src="{{ url('public') }}/assets/js/index.js"></script>
    {{-- submit form get limit page --}}
    <script>
        $('#limitPage').change(function(e) {
            //   e.preventDefault();
            $('#searchSubmit').click();
        });
        $(document).ready(function() {
            $('#province_id').change(function() {
                var countryID = $(this).val();
                let _url = "{{ url('/admin/getDistricts') }}/" + countryID;
                // let _url = "../getDistricts/" + countryID;
                console.log(_url);
                // "admin/getDistricts/" + countryID
                if (countryID) {
                    $.ajax({
                        type: "GET",
                        url: _url,
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                $("#district_id").empty();
                                $("#district_id").append('<option>Select</option>');
                                $.each(response, function(key, value) {
                                    $("#district_id").append('<option value="' +
                                        value['code'] + '">' + value[
                                            'fullname'] + '</option>');
                                });

                            } else {
                                $("#district_id").empty();
                            }
                        }
                    });
                } else {
                    $("#district_id").empty();
                }
            });
        });

    </script>
</body>

</html>
