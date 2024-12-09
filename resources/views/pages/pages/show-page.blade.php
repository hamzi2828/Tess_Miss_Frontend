{{-- pages-show --}}
@extends('master.master')

<style>
    .form-label {
        font-weight: 500;
        color: #6c757d;
    }

    .card-custom {
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    .page-details {
        font-size: 16px;
        color: #6c757d;
    }

    .page-details strong {
        color: #000;
    }

    .page-description {
        font-size: 15px;
        line-height: 1.6;
        color: #333;
    }
</style>

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-lg p-4 card-custom">
                <!-- Page Title -->
                <h3 class="fw-bold text-center text-primary mb-4">{{ $page->name }}</h3>

                <!-- Page Description -->
                <div class="page-description mt-3" style="font-size: 1rem; line-height: 1.8; color: #555;">
                    {!! $page->description !!}
                </div>

                <!-- Back Button -->
                <div class="d-flex justify-content-center mt-5">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-5">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
