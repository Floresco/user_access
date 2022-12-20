@extends('layout.app')
@php
    $required = \App\Helpers\Utils::required();
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12 mt-lg-0 mt-4">
                <x-alert/>
                <div class="card">
                    <div class="card-body pt-0" id="page_content1"></div>
                    <div class="card-body pt-0" id="page_content2">
                        <form id="contact-form" onsubmit="return submit_form()" method="POST" autocomplete="off"
                              action="{{ $model != null ? route('user.update',['user' => $model->id]) : route('user.store')}}">
                            @csrf
                            <div class="row">
                                @if($model != null)
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="key" value="{{$model->id}}">
                                @endif
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="user_profil_id">{{trans('messages.user_profil')}}</label>
                                        <select
                                            name="user_profil_id"
                                            id="user_profil_id"
                                            data-placeholder="{{trans('messages.choose')}}"
                                            class="form-control select2"
                                        >
                                            @foreach($profils as $profil)
                                                <option
                                                    value="{{$profil->id}}"
                                                >
                                                    {{$profil->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group is-valid">
                                        <label class="form-label" for="name">Dénomination Profil <span
                                                style="color:red">**</span>
                                            :</label>

                                        <input type="text" id="name" class="form-control"
                                               name="name" required="required" aria-required="true"
                                               value="{{$model != null ? $model->name : old('name')}}">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                {!! \App\Helpers\Utils::submit_btn() !!}
                                @if($model && $model->name)
                                    {!! \App\Helpers\Utils::back_btn('profil.index') !!}
                                @else
                                    {!! \App\Helpers\Utils::reset_btn() !!}
                                @endif()

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

        @endsection
        @push('js')
            <script type="application/javascript">
                function submit_form() {
                    const img = '</br></br><center><img  src="{!! asset('assets/images/loader.gif') !!}"  style="width:200px;border-radius: 5px;border:1px solid #DADADA" /></center></br></br>';
                    $('#page_content2').hide();
                    $('#page_content1').html(img);

                    return true;
                }

                window.onload = function () {

                    $(document).ready(function () {

                    })
                }
            </script>
    @endpush
