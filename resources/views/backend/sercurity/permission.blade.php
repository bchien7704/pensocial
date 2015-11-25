@extends('backend/shared/layout')
@section('content')
    {!! Form::open() !!}


    @if (count($permissionModelView->availablePermissions)==0)

        <label>No permissions defined</label>

    @elseif (count($permissionModelView->availableUserGroup)==0)

        <label>No customer roles available</label>

    @else

        <table class="table table-bordered dataTable no-footer">

            <tr class="headerstyle">
                <th scope="col">
                    <strong>Permission name</strong>
                </th>
                @foreach($permissionModelView->availableUserGroup as $group)

                    <th scope="col">
                        <strong>{!! $group["name"] !!}</strong>
                        {!! Form::checkbox('groupname') !!}
                    </th>

                @endforeach


            </tr>

            @foreach($permissionModelView->availablePermissions as $per)
                {{--{!! $altRow=!$altRow !!}}--}}
                <tr>
                    <td><span>{!! $per["name"]!!}</span></td>
                    @foreach($permissionModelView->availableUserGroup as $gr)
                   <?php $allowed=(array_key_exists($per["system_name"],$permissionModelView->allowed) && $permissionModelView->allowed[$per["system_name"]][$gr["id"]])  ?>
                        <td>
                            <input {!! $allowed ? 'checked' : '' !!} type="checkbox" value="{!! $per["system_name"] !!}"  class="allow_{!! $gr["id"] !!}"  name="allow_{!! $gr["id"] !!}[]">
                        </td>
                    @endforeach
                </tr>
            @endforeach

        </table>
        </br>
        </br>

    @endif

    {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
    {!! Form::close() !!}
@stop