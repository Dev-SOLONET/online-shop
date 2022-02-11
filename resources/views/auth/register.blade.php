@extends('layouts.multikart')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Buat Akun Baru</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Masukan Data Anda</h3>
                <div class="theme-card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="theme-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="email">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Anda"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email Anda" required>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="review">No Hp</label>
                                <input type="number" class="form-control" id="telp"
                                placeholder="Masukan Nomor Hp Anda" name="telp" required>
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="review">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Masukan password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="review">Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                    placeholder="Masukan ulang password" required>
                            </div>
                            <button type="submit" class="btn btn-solid w-auto">Buat Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection