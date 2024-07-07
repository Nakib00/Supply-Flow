@extends('layout.main')
@section('content')
    {{--  <!-- Sidebar -->  --}}
    @include('manufacturer.sidebar')
    {{--  <!-- End of Sidebar -->  --}}
    <div id="content-wrapper" class="d-flex flex-column">

        {{--  <!-- Main Content -->  --}}
        <div id="content">
            {{--  <!-- Topbar -->  --}}
            @include('manufacturer.topbar')
            {{--  <!-- End of Topbar -->  --}}

            {{--  <!-- Begin Page Content -->  --}}
            <div class="container-fluid">
                {{--  include aliet  --}}
                @include('include.alirt')
                {{--  Content start here  --}}
                @yield('manufacturer')
            </div>
            {{--  <!-- /.container-fluid -->  --}}

        </div>
        {{--  <!-- End of Main Content -->  --}}

        {{--  <!-- Footer -->  --}}
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; SupplyFlow 2024</span>
                </div>
            </div>
        </footer>
        {{--  <!-- End of Footer -->  --}}

    </div>
@endsection
