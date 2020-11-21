<div class="form-group">
    <label for="#">Select Employee Role</label>
    <select class="form-control select2bs4" id="role-select" style="width: 100%;" required name="role">
        <option value="">Choose Role</option>
        @foreach ($roles as $role)
        <option value="{{$role->id}}" @if (isset($user_role) && $user_role==$role->id) selected
            @endif>{{$role->display_name}}
        </option>
        @endforeach
    </select>
</div>

<h5 class="text-justify">Permissions</h5>
<div class="row p-2">
    @foreach ($permissions as $permission)
    <div class="form-check col-md-4 mb-2">
        <input class="form-check-input p-checkbox" name="permissions[]" type="checkbox" value="{{$permission->id}}"
            id="{{$permission->id}}">
        <label class="form-check-label" for="defaultCheck1">
            {{$permission->display_name}}
        </label>
    </div>
    @endforeach

</div>
