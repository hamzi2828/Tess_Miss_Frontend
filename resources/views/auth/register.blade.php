

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

    <div class="authentication-wrapper authentication-cover">
      <!-- Logo -->
      <a href="/" class="menu-linkapp-brand auth-cover-brand">
        <img style="width: 200px; margin-top: 10px"  src="https://projects.multibizdev.com/tess_kyc/assets/img/tess_logo.png" alt="">
      </a>
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-8 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="../../assets/img/illustrations/auth-register-illustration-light.png"
              alt="auth-register-cover"
              class="my-5 auth-illustration"
              data-app-light-img="illustrations/auth-register-illustration-light.png"
              data-app-dark-img="illustrations/auth-register-illustration-dark.png" />

            <img
              src="../../assets/img/illustrations/bg-shape-image-light.png"
              alt="auth-register-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Register -->
        <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
          <div class="w-px-400 mx-auto mt-12 pt-5">
            <h4 class="mb-1">Welcome to Tess 🚀</h4>

            <form id="formAuthentication" class="mb-6" action="{{ route('users.store') }}" method="POST">
              @csrf  <!-- This is necessary for POST requests in Laravel -->
          
              <div class="mb-6">
                  <label for="userFullname" class="form-label">Merchant Name</label>
                  <input
                      type="text"
                      class="form-control @error('userFullname') is-invalid @enderror"
                      id="userFullname"
                      name="userFullname"
                      placeholder="Enter your merchant name"
                      value="{{ old('userFullname') }}"
                      autofocus
                  />
                  @error('userFullname')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-6">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-phone2" class="input-group-text">
                    <i data-feather="phone" class="icon text-primary"></i>
                  </span>
                  <input
                    type="number"
                    class="form-control @error('phone') is-invalid @enderror phone-number-mask"
                    id="phone"
                    name="phone"
                    placeholder="Enter your phone number"
                    value="{{ old('phone') }}"
                    autofocus
                  />
                </div>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

          
              <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input
                      type="text"
                      class="form-control @error('userEmail') is-invalid @enderror"
                      id="userEmail"
                      name="userEmail"
                      placeholder="Enter your userEmail"
                      value="{{ old('userEmail') }}"
                  />
                  @error('userEmail')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                      <input
                          type="password"
                          id="password"
                          class="form-control @error('password') is-invalid @enderror"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password_confirmation">Confirm Password</label>
                  <div class="input-group input-group-merge">
                      <input
                          type="password"
                          id="password_confirmation"
                          class="form-control @error('password_confirmation') is-invalid @enderror"
                          name="password_confirmation"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password_confirmation"
                      />
                      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
          
              <div class="mb-6 mt-8">
                  <div class="form-check mb-8 ms-2">
                      <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms-conditions" name="terms" {{ old('terms') ? 'checked' : '' }} required />
                      <label class="form-check-label" for="terms-conditions">
                          I agree to
                          <a href="javascript:void(0);">privacy policy & terms</a>
                      </label>
                      @error('terms')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  @error('terms')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          
              <button class="btn btn-primary d-grid w-100">Sign up</button>
          </form>
          

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{ route('login') }}">
                <span>Sign in instead</span>
              </a>
            </p>

  
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>

    <!-- / Content -->


    @include('layouts.footer')

</body>
</html>
