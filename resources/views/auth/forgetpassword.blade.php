

<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>@yield('title', 'Admin')</title>
    <meta name="description" content="" />

    @include('layouts.head')

</head>
<style>
  .authentication-wrapper {
    display: flex;
    flex-basis: 100%;
    min-height: 100vh;
    width: 100%;
  }
  .authentication-wrapper .authentication-inner {
    width: 100%;
  }
  .authentication-wrapper.authentication-basic {
    align-items: center;
    justify-content: center;
  }
  .authentication-wrapper.authentication-basic .card-body {
    padding: 3rem;
  }
  @media (max-width: 575.98px) {
    .authentication-wrapper.authentication-basic .card-body {
      padding: 2rem;
    }
  }
  .authentication-wrapper.authentication-cover {
    align-items: flex-start;
  }
  .authentication-wrapper.authentication-cover .authentication-inner {
    height: 100%;
    margin: auto 0;
  }
  @media (max-width: 991.98px) {
    .authentication-wrapper.authentication-cover .authentication-inner {
      height: 100vh;
    }
  }
  .authentication-wrapper.authentication-cover .authentication-inner .auth-cover-bg {
    width: 100%;
    height: 100vh;
    position: relative;
  }
  .authentication-wrapper.authentication-cover .authentication-inner .auth-cover-bg .auth-illustration {
    max-height: 65%;
    max-width: 65%;
    z-index: 1;
  }
  .authentication-wrapper.authentication-cover .authentication-inner .platform-bg {
    position: absolute;
    width: 100%;
    bottom: 0%;
    left: 0%;
    height: 35%;
  }
  .authentication-wrapper.authentication-cover .authentication-inner .auth-multisteps-bg-height {
    height: 100vh;
  }
  .authentication-wrapper.authentication-cover .authentication-inner .auth-multisteps-bg-height > img:first-child {
    z-index: 1;
  }
  .authentication-wrapper.authentication-basic .authentication-inner {
    max-width: 460px;
    position: relative;
  }
  .authentication-wrapper.authentication-basic .authentication-inner:before {
    width: 238px;
    height: 233px;
    content: " ";
    position: absolute;
    top: -35px;
    left: -45px;
    background-image: url("data:image/svg+xml,%3Csvg width='239' height='234' viewBox='0 0 239 234' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='88.5605' y='0.700195' width='149' height='149' rx='19.5' stroke='%237367F0' stroke-opacity='0.16'/%3E%3Crect x='0.621094' y='33.761' width='200' height='200' rx='10' fill='%237367F0' fill-opacity='0.08'/%3E%3C/svg%3E%0A");
  }
  @media (max-width: 575.98px) {
    .authentication-wrapper.authentication-basic .authentication-inner:before {
      display: none;
    }
  }
  .authentication-wrapper.authentication-basic .authentication-inner:after {
    width: 180px;
    height: 180px;
    content: " ";
    position: absolute;
    z-index: -1;
    bottom: -30px;
    right: -56px;
    background-image: url("data:image/svg+xml,%3Csvg width='181' height='181' viewBox='0 0 181 181' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect x='1.30469' y='1.44312' width='178' height='178' rx='19' stroke='%237367F0' stroke-opacity='0.16' stroke-width='2' stroke-dasharray='8 8'/%3E%3Crect x='22.8047' y='22.9431' width='135' height='135' rx='10' fill='%237367F0' fill-opacity='0.08'/%3E%3C/svg%3E");
  }
  @media (max-width: 575.98px) {
    .authentication-wrapper.authentication-basic .authentication-inner:after {
      display: none;
    }
  }
  .authentication-wrapper .auth-input-wrapper .auth-input {
    max-width: 50px;
    padding-left: 0.4rem;
    padding-right: 0.4rem;
    font-size: 150%;
  }

  @media (max-height: 636px) {
    .auth-multisteps-bg-height {
      height: 100% !important;
    }
  }
  @media (max-width: 575.98px) {
    .authentication-wrapper .auth-input-wrapper .auth-input {
      font-size: 1.125rem;
    }
  }
  #twoStepsForm .fv-plugins-bootstrap5-row-invalid .form-control {
    border-color: #ff4c51;
    border-width: 2px;
  }

  @media (max-width: 575.98px) {
    .numeral-mask-wrapper .numeral-mask {
      padding: 0 !important;
    }
    .numeral-mask {
      margin-inline: 1px !important;
    }
  }
  .light-style .authentication-wrapper .authentication-bg {
    background-color: #fff;
  }
  .light-style .auth-cover-bg-color {
    background-color: #f8f7fa;
  }

  .dark-style .authentication-wrapper .authentication-bg {
    background-color: #2f3349;
  }
  .dark-style .auth-cover-bg-color {
    background-color: #25293c;
  }

</style>

<body>


    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="index.html" class="app-brand auth-cover-brand">
          <span class="app-brand-logo demo">
            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                fill="#7367F0" />
              <path
                opacity="0.06"
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                fill="#161616" />
              <path
                opacity="0.06"
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                fill="#161616" />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                fill="#7367F0" />
            </svg>
          </span>
          <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
          <!-- /Left Text -->
          <div class="d-none d-lg-flex col-lg-8 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
              <img
                src="../../assets/img/illustrations/auth-forgot-password-illustration-light.png"
                alt="auth-forgot-password-cover"
                class="my-5 auth-illustration d-lg-block d-none"
                data-app-light-img="illustrations/auth-forgot-password-illustration-light.png"
                data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png" />
  
              <img
                src="../../assets/img/illustrations/bg-shape-image-light.png"
                alt="auth-forgot-password-cover"
                class="platform-bg"
                data-app-light-img="illustrations/bg-shape-image-light.png"
                data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
          </div>
          <!-- /Left Text -->
  
          <!-- Forgot Password -->
          <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
            <div class="w-px-400 mx-auto mt-12 mt-5">
              <h4 class="mb-1">Forgot Password? 🔒</h4>
              <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>

              @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
      
              <form id="formAuthentication" class="mb-6" action="{{ route('send.reset.link') }}" method="POST">
                @csrf
                <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="{{ old('email') }}" />
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
              </form>
              <div class="text-center">
                <a href="/" class="d-flex align-items-center justify-content-center">
                  <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>  
 
    <!-- / Content --> 

    @include('layouts.footer')

</body>
</html>