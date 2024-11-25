

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
  padding: 2rem;
}
.authentication-wrapper.authentication-cover {
  align-items: flex-start;
}
.authentication-wrapper.authentication-cover .authentication-inner {
  height: 100%;
  margin: auto 0;
}
.authentication-wrapper.authentication-cover .authentication-inner .auth-cover-bg {
  width: 100%;
  margin: 2rem 0 2rem 2rem;
  height: calc(100vh - 4rem);
  border-radius: 1.125rem;
  position: relative;
}
.authentication-wrapper.authentication-cover .authentication-inner .auth-cover-bg .auth-illustration {
  max-height: 65%;
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
  max-width: 400px;
  position: relative;
}
.authentication-wrapper.authentication-basic .authentication-inner:before {
  width: 238px;
  height: 233px;
  content: " ";
  position: absolute;
  top: -55px;
  left: -40px;
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
  border-color: #ea5455;
}

.light-style .authentication-wrapper.authentication-bg {
  background-color: #fff;
}
.light-style .auth-cover-bg-color {
  background-color: #f8f7fa;
}

.dark-style .authentication-wrapper.authentication-bg {
  background-color: #2f3349;
}
.dark-style .auth-cover-bg-color {
  background-color: #25293c;
}

</style>

<body>

    <div class="container-xxl col-lg-6 col-xl-5 ">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner py-6">
            <!-- Login -->
            <div class="card">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-6">
                  <a href="index.html" class="app-brand-link">
                    <a href="/" class="menu-link">
                        <img style="width: 200px; margin-top: 10px"  src="https://projects.multibizdev.com/tess_kyc/assets/img/tess_logo.png" alt="">
                      </a>
                  </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-1">Welcome ! 👋</h4>
                <p class="mb-6">Please sign-in to your account and start the adventure</p>
    
                <!-- Form starts here -->
                <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="POST">
                    @csrf <!-- Add CSRF protection token -->

                    <div class="mb-6">
                        <label for="email" class="form-label">Email or Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email or username"
                            autofocus />
                    </div>
                    <div class="mb-6 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                </form>
                <!-- Form ends here -->
                @if ($errors->any())
                <div style="text-align: center; margin: 20px 0;">
                    <div class="alert alert-danger" style="display: inline-block; width: auto;">
                        @foreach ($errors->all() as $error)
                            <p style="margin: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            
            
                            

              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
    </div>



    @include('layouts.footer')

</body>
</html>
