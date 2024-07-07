@include('include.head')

<body id="page-top">

    {{--  <!-- Page Wrapper -->  --}}
    <div id="wrapper">



        {{--  <!-- Content Wrapper -->  --}}
            @yield('content')
        {{--  <!-- End of Content Wrapper -->  --}}

    </div>
    {{--  <!-- End of Page Wrapper -->  --}}


    @include('include.footer')

</body>

</html>
