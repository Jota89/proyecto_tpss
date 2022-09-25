@extends('layouts.admin.login')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block "></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h1 text-gray-900 mb-4">{{ __('Login') }}</h1>
                                <h4 class="h4 text-gray-900 mb-4">{{ __('Welcome Back!') }}</h4>
                            </div>
                           
                            @include('auth.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
