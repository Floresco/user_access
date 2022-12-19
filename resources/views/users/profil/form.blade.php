@extends('layout.app')
@php
    $required = \App\Helpers\Utils::required();
    $all_module = '';

@endphp
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12 mt-lg-0 mt-4">
                <x-alert/>
                <div class="card">
                    <div class="card-body pt-0" id="page_content1"></div>
                    <div class="card-body pt-0" id="page_content2">
                        <form id="contact-form" onsubmit="return submit_form()" method="post"
                              action="{{route('profil.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group is-valid">
                                        <label class="form-label">Dénomination Profil <span style="color:red">**</span>
                                            :</label>

                                        <input type="text" id="userprofil-name" class="form-control"
                                               name="name" required="required" aria-required="true" value="{{$model != null ? $model->name : old('name')}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{trans('messages.descriptionProfil')}} :</label>
                                        <textarea
                                            name="description"
                                            rows="4"
                                            class="form-control"
                                            >
                                            {{$model != null ? $model->description : old('description')}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-5">
                                <div class="col-12">
                                    <div class="input-group input-group-outline is-valid">
                                        @if (sizeof($access_rights) > 0)
                                            @php
                                                $link_cocher = '<a href="#" onclick="checkall_info(1);return false">' .
                                                    trans('messages.check_all') . '</a>';
                                                $link_decocher = '<a href="#" onclick="checkall_info(0);return false">' .
                                                    trans('messages.uncheck_all') . '</a>';
                                            @endphp
                                            <label>{!! trans('messages.global_privileg') . " ( " . $link_cocher . " / " . $link_decocher . " )"; !!} </label>
                                            <table class="table table-bordered table-striped" id="module_page">
                                                <tr>
                                                    <th style="width:60%">{{trans('messages.m_module')}}</th>
                                                    <th>{{trans('messages.m_create')}}</th>
                                                    <th>{{trans('messages.m_read')}}</th>
                                                    <th>{{trans('messages.m_delete')}}</th>
                                                    <th>{{trans('messages.m_update')}}</th>
                                                    <th>{{trans('messages.m_all')}}</th>
                                                </tr>
                                                @foreach($access_rights as $access_right)
                                                    @php
                                                        $id_right = $access_right->id;
                                                        $all_module == ''
                                                        ? $all_module = $id_right
                                                        : $all_module .= '_'. $id_right
                                                    @endphp
                                                    <tr>
                                                        <td>{{trans('messages.'.$access_right->wording)}}</td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   id="{{$id_right . '_CREATE'}}"
                                                                   name="{{ $id_right . '_CREATE' }}" value="1"
                                                                   onchange="uncheckall_line('{{$id_right}}')"/>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   id="{{ $id_right . '_LIST' }}"
                                                                   name="{{ $id_right . '_LIST' }}" value="1"
                                                                   onchange="uncheckall_line('{{$id_right}}')"/>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   id="{{ $id_right . '_DELETE' }}"
                                                                   name="{{ $id_right . '_DELETE' }}" value="1"
                                                                   onchange="uncheckall_line('{{$id_right}}')"/>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   id="{{ $id_right . '_UPDATE' }}"
                                                                   name="{{ $id_right . '_UPDATE' }}" value="1"
                                                                   onchange="uncheckall_line('{{$id_right}}')"/>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" id="{{ $id_right . '_ALL' }}"
                                                                   onchange="checkall_line('{{$id_right}}')">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <input type="hidden" name="all_module" id="all_module"
                                                       value="{{$all_module}}">
                                            </table>

                                        @endif

                                    </div>
                                </div>
                            </div>
                            {!! \App\Helpers\Utils::submit_btn() !!}
                            <?php if (isset($_GET['key'])): ?>
                            {!! \App\Helpers\Utils::back_btn('profils.index') !!}
                            <?php else: ?>
                            {!! \App\Helpers\Utils::reset_btn() !!}
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

            </div>

        </div>

{{--        @if(sizeof($user_module) > 0 || (Session::get('user_module') && sizeof()))--}}
{{--            TODO ON reprend ici--}}
        @endif

        @endsection

        @push('js')
            <script type="application/javascript">
                function submit_form() {
                    const img = '</br></br><center><img  src="{!! asset('assets/images/loader.gif') !!}"  style="width:200px;border-radius: 5px;border:1px solid #DADADA" /></center></br></br>';
                    $('#page_content2').hide();
                    $('#page_content1').html(img);

                    return true;
                }


                function checkall_line(id) {
                    const new_status = document.getElementById(id + '_ALL').checked;

                    document.getElementById(id + '_UPDATE').checked = new_status;
                    document.getElementById(id + '_CREATE').checked = new_status;
                    document.getElementById(id + '_DELETE').checked = new_status;
                    document.getElementById(id + '_LIST').checked = new_status;

                    handle_btn_status()
                }

                function uncheckall_line(id) {

                    const pupdate = document.getElementById(id + '_UPDATE').checked;
                    const pcreate = document.getElementById(id + '_CREATE').checked;
                    const pdelete = document.getElementById(id + '_DELETE').checked;
                    const plist = document.getElementById(id + '_LIST').checked;

                    if (pupdate === true && pcreate === true && pdelete === true && plist === true) {
                        document.getElementById(id + '_ALL').checked = true;
                    } else {
                        document.getElementById(id + '_ALL').checked = false;
                    }

                    handle_btn_status()

                }

                function checkone(id) {
                    document.getElementById(id).checked = true;
                }

                function checkall_info(status) {
                    let new_status;
                    if (status === 1) {
                        new_status = true;
                    }
                    if (status === 0) {
                        new_status = false;
                    }

                    const all_element = document.getElementById('module_page').getElementsByTagName('input');

                    for (let i = 0; i < all_element.length; i++) {
                        if (all_element[i].type === 'checkbox') {
                            all_element[i].checked = new_status;
                        }
                    }

                    handle_btn_status()
                }

                function handle_btn_status() {
                    const item_selected = $('#module_page input:checked').length;

                    if (item_selected < 1) {
                        $('#updatebutton').removeClass('btn-success').addClass('btn-primary').prop('disabled', true);
                    } else {
                        $('#updatebutton').removeClass('btn-primary').addClass('btn-success').prop('disabled', false)
                    }
                }

                window.onload = function () {

                    $(document).ready(function () {
                        handle_btn_status()
                    })
                }
            </script>
    @endpush
