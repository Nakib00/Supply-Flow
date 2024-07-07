@include('include.head')

<body class="bg-gradient-primary">

    <div class="container">
        {{--  include aliet  --}}
        @include('include.alirt')
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center bg-login-image">
                                <img src="{{ asset('assets/img/loginlogo.png') }}" style="height: 350px" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-1">Welcome Back!</h1>
                                        <h4 class="h4 text-gray-900 mb-4">SupplyFlow</h4>
                                        <h6 class=" text-gray-900 mb-2">Retailer Login</h6>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('retailer.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" id="exampleInputPassword" placeholder="Password"
                                                required>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                        <a href="{{ route('login_admin') }}"
                                            class="btn btn-facebook btn-user btn-block">
                                            <i class="fas fa-industry fa-fw"></i> Admin
                                        </a>
                                        <a href="{{ route('login_manufactuer') }}"
                                            class="btn btn-facebook btn-user btn-block">
                                            <i class="fas fa-shopping-bag fa-fw"></i> Manufactuer
                                        </a>
                                    </form>

                                    <hr>
                                    {{--  <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>  --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
