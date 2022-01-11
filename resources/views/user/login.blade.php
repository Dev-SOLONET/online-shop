@extends('layouts.multikart')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Halaman Login</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Login</h3>
                <div class="theme-card">
                    <form class="theme-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password"
                                required="">
                        </div>
                        <button type="submit" class="btn btn-solid">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 right-login">
                <h3>Pelanggan Baru</h3>
                <div class="theme-card authentication-right">
                    <h6 class="title-font">Daftar Akun</h6>
                    <p>Pendaftaran cepat dan mudah. Hal ini memungkinkan Anda untuk dapat memesan dari toko kami. Untuk mulai berbelanja klik daftar.</p><a href="{{ route('auth.register')}}"
                        class="btn btn-solid">Daftar Akun Baru</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection