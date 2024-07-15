@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container px-5">
        <div class="row ">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Today Times')}}</h4>
                </div>
                @can(['permission_create'])
                    <div>
                      
                        <button type="button" class="btn text-white btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addCity" style="background-color: #FEBC06;">
                            {{__('Add Time')}}</button>
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
                    <strong class="text-danger mt-3">{{ $errors->first('icon') }}</strong>
                </div>
                <div>
                    <strong class="text-danger mt-3">{{ $errors->first('time') }}</strong>
                </div>
                <div>
                    <strong class="text-danger mt-3">{{ $errors->first('event_type') }}</strong>
                </div>
            </div>
        </div
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Icon')}}</th>
                                <th>{{__('Time')}}</th>
                                <th>{{__('Event Type')}}</th>
                                <th>{{__('Created At')}}</th>
                                @can(['permission_update'])
                                    <th>{{__('Update')}}</th>
                                     <th>{{__('Delete')}}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todaytime as $todaytime)
                                <tr>
                                    <td>{{ $todaytime->id }}</td>
                                    <td>
                                        <img src="{{ asset($todaytime->icon) }}" class="img-fluid img-thumbnail" style="max-width: 60px; cursor: pointer;"
                                        onclick="showImageModal('{{ asset($todaytime->icon) }}')">
                                    </td>
                                    <td>{{ $todaytime->time }}</td>
                                    <td>{{ $todaytime->event_type }}</td>
                                    <td>{{ $todaytime->created_at }}</td>

                                    @can(['permission_update'])
                                        <td>
                                            @can(['permission_update'])
                                                <button class="btn  btn-sm btn-warning edit-city-btn" type="button"
                                                    data-id="{{ $todaytime->id }}" data-icon="{{ $todaytime->icon }}"
                                                    data-time="{{ $todaytime->time }}"
                                                    data-event_type="{{ $todaytime->event_type }}" data-bs-toggle="modal" style="background-color: #FEBC06;">
                                                    <i class="fa-solid fa-pen text-white"></i>
                                                </button>
                                                
                                            @endcan
                                        </td>
                                        <td>
                                            @can('permission_delete')
                                                <a href="{{ route('todaytime.delete', $todaytime->id) }}"
                                                    onclick="confirmDelete(event)" class="btn btn-dark btn-sm" type="button"
                                                    data-toggle="modal" style="background-color: #293038;"><i class="fa-solid fa-trash"></i></a>
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



    <div class="modal fade" id="addCity" tabindex="-1" aria-labelledby="addCityModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCityModel">{{__('Add Today Time')}}</h1>
                </div>
                <form class="" method="POST" action="{{ route('todaytime.store') }}" enctype="multipart/form-data">

                    <div class="modal-body">
                        @csrf
                        <div class="mb-3 col-lg-12">

                            <input type="file" name="icon" class="form-control form-control-lg"
                                placeholder="Enter Icon" required >

                        </div>
                        <div class="mb-3 col-lg-12">

                            <input type="time" name="time" class="form-control form-control-lg"
                                placeholder="Enter Time"required >

                        </div>

                        <div class="mt-4">

                            <input type="text" name="event_type" class="form-control form-control-lg"
                                placeholder="{{__('Enter Event Type')}}" required >

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn text-white btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Time')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="" class="img-fluid" id="modalImage" style="max-height: 70vh;">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCityModalLabel">{{__('Edit Today Time')}}</h5>
                </div>
                <form id="editCityForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="TodayTimeId">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" class="form-control" id="TodayTimeicon" name="icon"
                                accept=".png, .jpg, .jpeg" onchange="previewImage(event)" />
                            <label for="TodayTimeicon" class="edit-icon"><i class="fas fa-pencil-alt"></i></label>
                        </div>
                        <div class="avatar-preview">
                            <img id="imagePreview" src="{{ asset('admin/assets/media/avatars/300-3.jpg') }}"
                                alt="Image Preview">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="TodayTime" name="time" >
                        </div>
                        <div class="mb-3">
                            <label for="TodayTimeEventType" class="form-label">{{__('Event Type')}}</label>
                            <input type="text" class="form-control" id="TodayTimeEventType" name="event_type"
                                required disabled>
                        </div>
                        <!-- Avatar upload as shown above -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn text-white btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const url = event.currentTarget.getAttribute('href');
            const isConfirmed = confirm('{{__('Do you want to delete this Time?')}}');

            if (isConfirmed) {
                window.location.href = url;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-city-btn');
            var modalElement = document.getElementById('editCityModal');
            var modal = new bootstrap.Modal(modalElement);
            var form = document.getElementById('editCityForm');
            var TodayTimeIdInput = document.getElementById('TodayTimeId');
            var TodayTimeiconInput = document.getElementById('TodayTimeicon');
            var TodayTimeInput = document.getElementById('TodayTime');
            var TodayTimeEventTypeInput = document.getElementById('TodayTimeEventType');
            var imagePreview = document.getElementById('imagePreview');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var TodayTimeId = this.getAttribute('data-id');
                    var TodayTimeicon = this.getAttribute('data-icon');
                    var TodayTime = this.getAttribute('data-time');
                    var TodayTimeEventType = this.getAttribute('data-event_type');

                    TodayTimeIdInput.value = TodayTimeId;
                    TodayTimeInput.value = TodayTime;
                    TodayTimeEventTypeInput.value = TodayTimeEventType;

                    if (TodayTimeicon) {
                        imagePreview.src = TodayTimeicon;
                    } else {
                        imagePreview.src = '{{ asset('admin/assets/media/avatars/300-3.jpg') }}';
                    }

                    form.action = '/todaytime/update/' + TodayTimeId;
                    modal.show();
                });
            });
        });
   
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        function showImageModal(imageSrc) {
            $('#modalImage').attr('src', imageSrc);
            $('#imageModal').modal('show');
        }
        
        
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
    <style>
     .alert {
        position: relative;
       
        display: none; /* Hidden by default */
    }
</style>
@endsection

