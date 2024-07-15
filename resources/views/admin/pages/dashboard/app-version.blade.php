@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container px-10 mt-4">
        <div class="row mt-4">
        <div class="d-flex">
    <strong class=" rounded p-2 btn btn-secondary btn-sm">{{__('Note')}}:</strong>
    <p  class="mt-2"> &nbsp{{__('Only one version is required. For the new version, update this one.')}}</p>
</div>


            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Version List')}}</h4>
                </div>
                @can(['permission_create'])
                    <div>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addVersion" style="background-color: #FEBC06;">
                            {{__('Add Version')}}</button>
                    </div>
                @endcan
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div id="showAlert"></div>
                @if (session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if ($errors->has('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>{{ $errors->first('error') }}</strong>
                    </div>
                @endif
                <div>

                    <strong class="text-danger mt-3">{{ $errors->first('version') }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Version')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Updated At')}}</th>
                                <th>{{__('Update')}}</th>
                                <th>{{__('Delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($versions as $version)
                                <tr>
                                    <td>{{ $version->id }}</td>
                                    <td>{{ $version->version }}</td>
                                    <td>{{ $version->description }}</td>
                                    <td>{{ $version->created_at }}</td>
                                    <td>{{ $version->updated_at }}</td>

                                    @can(['permission_update'])
                                        <td>
                                            @can(['permission_update'])
                                                <button class="btn btn-warning btn-sm edit-app-version-btn" type="button"
                                                    data-id="{{ $version->id }}" data-version="{{ $version->version }}"
                                                    data-description="{{ $version->description }}"
                                                    data-bs-toggle="modal" data-bs-target="#editAppVersionModal" style="background-color: #FEBC06;">
                                                    <i class="fa-solid fa-pen text-white"></i>
                                                </button>
                                            @endcan
                                            </td>
                                            <td>
                                            @can('permission_delete')
                                                <a href="{{ route('version.delete', $version->id) }}"
                                                    onclick="confirmDelete(event)" class="btn btn-dark btn-sm" type="button"
                                                    data-toggle="modal"  style="background-color: #293038;"><i class="fa-solid fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addVersion" tabindex="-1" aria-labelledby="addVersionModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addVersionModel">{{__('Add Version')}}</h1>
                </div>
                <form class="" method="POST" action="{{ route('version.store') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3 col-lg-12">
                            <input type="text" name="version" class="form-control form-control-lg"
                                placeholder="{{__('Enter Version')}}"  required>

                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="description" placeholder="{{__('Enter Description (if any)')}}" rows="3"></textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Version')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="editAppVersionModal" tabindex="-1" aria-labelledby="editAppVersionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAppVersionModalLabel">{{__('Edit Version')}}</h5>
                </div>
                <form id="editAppVersionForm" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="versionId">
                        <div class="mb-3">
                            <label for="versionName" class="form-label">{{__('Version')}}</label>
                            <input type="text" class="form-control" id="versionName" name="version" required >
                        </div>
                        <div class="mb-3">
                            <label for="versionDescription" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="versionDescription" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const url = event.currentTarget.getAttribute('href');
            const isConfirmed = confirm('{{__('Do you want to delete this App version?')}}');

            if (isConfirmed) {
                window.location.href = url;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-app-version-btn');
            var modal = new bootstrap.Modal(document.getElementById('editAppVersionModal'));
            var form = document.getElementById('editAppVersionForm');
            var versionIdInput = document.getElementById('versionId');
            var versionNameInput = document.getElementById('versionName');
            var descriptionInput = document.getElementById('versionDescription');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var versionId = this.getAttribute('data-id');
                    var versionName = this.getAttribute('data-version');
                    var versionDescription = this.getAttribute('data-description');

                    versionIdInput.value = versionId;
                    versionNameInput.value = versionName;
                    descriptionInput.value = versionDescription;

                    form.action = '/version/update/' + versionId;

                    modal.show();
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
        const alertElement = document.querySelector('.alert');
        if (alertElement) {
            alertElement.style.display = 'block'; // Show the alert
            setTimeout(() => {
                alertElement.classList.add('fade-out'); // Add fade-out class
                setTimeout(() => {
                    alertElement.remove(); // Remove alert after fade-out
                }, 500); // Wait for fade-out to complete
            }, 3000); // Show for 3 seconds
        }
    });
    </script>
@endsection
