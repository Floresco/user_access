@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            @if(sizeof($profils) > 0)
                <table
                    class="table table-striped table-bordered table-hover table-responsive-lg is-search-table  align-middle"
                    id="datatable-search" style="width: 100%">
                    <thead>
                    <tr>
                        <th>{{trans('messages.nameProfil')}}</th>
                        <th>{{trans('messages.descriptionProfil')}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profils as $profil)
                        <tr>
                            <td>{{$profil->name}}</td>
                            <td class="nowrap text-nowrap">{{$profil->description}}</td>
                            <th scope="row" style="width: 1%;">
                                <a href="{{route('profil.update',['profil'=>$profil->id])}}" title="{{trans('messages.updatebutton')}}"><i
                                        class="bx bx-edit-alt text-info position-relative text-md"></i></a>
                            </th>

                            <th scope="row" style="width: 1%;">
                                @if($profil->etat == 1)
                                    <a href="javascript:void(0)" title="{{trans('messages.desactive')}}"><i
                                            class="bx bx-check-double text-success position-relative text-md"></i></a>
                                @else
                                    <a href="javascript:void(0)" title="{{trans('messages.active')}}"><i
                                            class="bx bx-check-double text-warning position-relative text-md"></i></a>
                                @endif

                            </th>

                            <th scope="row" style="width: 1%;">
                                <a href="javascript:void(0)" title="{{trans('messages.delete')}}"><i
                                        class="bx bx-trash text-danger position-relative text-md"></i></a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {!! \App\Helpers\Utils::emptyContent() !!}
            @endif
        </div>
    </div>
@endsection
