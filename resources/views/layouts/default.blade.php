<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            @include('includes.header')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        
                        @yield('content')

                    </div> <!-- container -->

                </div> <!-- content -->

                @include('includes.footer')

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            
            @include('includes.rightsidebar')

        </div>

        <!-- END wrapper -->
        @include('includes.footerscripts')

    </body>
</html>