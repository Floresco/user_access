<table class="table table-striped table-bordered table-hover table-responsive-lg is-search-table nowrap align-middle" id="datatable-search" style="width: 100%">
    <thead>
    <tr>
        <th scope="col" style="width: 10px;">
            <div class="form-check">
                <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
            </div>
        </th>
        <th>{{trans('messages.name')}}</th>
        <th>{{trans('messages.description')}}</th>
        <th>Actions</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($profils as $profil)
        <tr>
            <th scope="row">
                <div class="form-check">
                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                </div>
            </th>
            <td>{{$profil->name}}</td>
            <td>{{$profil->description}}</td>
            <td>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li>
                            <a class="dropdown-item remove-item-btn">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
            <td>
                <a href="#" title="{{trans('messages.update')}}"><i class="bx bx-edit-alt text-info position-relative text-md"></i></a>
                &nbsp;
                <a href="javascript:void(0)"><i class="bx bx-check-double text-warning position-relative text-md"></i></a>
                &nbsp;
                <a href="javascript:void(0)"><i class="bx bx-trash text-danger position-relative text-md"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
