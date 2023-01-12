@extends('auth.layout.app')

@section('content')
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pt-4">
                        <div class="">
                            <img src="{{asset('assets/images/error.svg')}}" alt=""
                                 class="error-basic-img move-animation">
                        </div>
                        <div class="mt-n4">
                            <h1 class="display-1 fw-medium">404</h1>
                            <h3 class="text-uppercase">{{trans('messages.404_text')}}</h3>
                            <p class="text-muted mb-4">{{trans('messages.404_hint')}}</p>
                            <a href="{{route('dashboard')}}" class="btn btn-success">
                                <i class="mdi mdi-home me-1"></i>
                                {{trans('messages.back_to_home')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
@endsection

