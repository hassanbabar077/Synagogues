@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
<div class="container">
    <h1 class="m-2">All Roles</h1>

    <div class="row mt-5">
        @foreach($roles as $role)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $role->name }}</h5>

                    @if($role->users->isNotEmpty())
                        <p class="card-text">Users:</p>
                        <ul>
                            @foreach ($role->users as $user)
                            <li>{{ $user->email }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="card-text">No users assigned to this role.</p>
                    @endif

                    @if($role->permissions->isNotEmpty())
                        <p class="card-text">Permissions:</p>
                        <ul>
                            @foreach ($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="card-text">No permissions assigned to this role.</p>
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
