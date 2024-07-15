@extends('admin.layout.main')

@php
    $hideFooter = true;
@endphp

@section('content')
    <div class="container px-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Videos')}}</h4>
                </div>
                @can('permission_create')
                    <div>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#sessionVideos" style="background-color: #FEBC06;">
                           {{__('Add Video')}}
                        </button>
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

                    <strong class="text-danger mt-3">{{ $errors->first('title') }}</strong>
                </div>
                <div>

                    <strong class="text-danger mt-3">{{ $errors->first('video_url') }}</strong>
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
                                <th>{{__('Title')}}</th>
                                <th>{{__('Video URL')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Updated At')}}</th>
                                  @can(['permission_update'])

                                <th>{{__('Update')}}</th>
                                 <th>{{_('Delete')}}</th>

                              @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($session_videos as $session_video)
                        <tr>
                            <td>{{ $session_video->id }}</td>
                            <td>{{ $session_video->title }}</td>
                         <td><a href="{{ $session_video->video_url }}" target="_blank" rel="noopener noreferrer">{{__('Video URL')}}</a></td>

                            <td>{{ $session_video->description }}</td>
                            <td>{{ $session_video->created_at }}</td>
                            <td>{{ $session_video->updated_at }}</td>
                            <td>
                                @can('permission_update')
                                <button class="btn btn-warning btn-sm edit-video-btn" style="background-color: #FEBC06;" type="button" data-id="{{ $session_video->id }}" data-title="{{ $session_video->title }}" data-video="{{ $session_video->video_url }}" data-description="{{ $session_video->description }}" data-bs-toggle="modal" data-bs-target="#editVideoModal">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </button>
                                @endcan
                                </td>
                                <td>
                                @can('permission_delete')
                                <a href="{{ route('session-videos.delete', $session_video->id) }}" onclick="confirmDelete(event)" class="btn btn-dark btn-sm" type="button"  style="background-color: #293038;"><i class="fa-solid fa-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Contact Modal -->
    <div class="modal fade" id="sessionVideos" tabindex="-1" aria-labelledby="addContactModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addContactModelLabel">{{__('Add Video')}}</h1>
                </div>
                <form method="POST" action="{{ route('session-videos.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="{{__('Enter Video Title')}}" required>
                            {{-- <strong class="text-danger">{{ $errors->first('title') }}</strong> --}}
                        </div>
                        <div class="mb-3">
                            <input type="text" name="video_url" class="form-control" placeholder="{{__('Enter Video URL')}}" required>
                            {{-- <strong class="text-danger">{{ $errors->first('video_url') }}</strong> --}}
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="description" placeholder="{{__('Enter Description (if any)')}}" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Video')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Contact Modal -->
    <div class="modal fade" id="editVideoModal" tabindex="-1" aria-labelledby="editVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVideoModalLabel">{{__('Edit Video')}}</h5>
                </div>
                <form id="editVideoForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="videoId">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">{{__('Title')}}</label>
                            <input type="text" class="form-control" id="editTitle" name="title" >
                        </div>
                        <div class="mb-3">
                            <label for="editVideo" class="form-label">{{__('Video URL')}}</label>
                            <input type="text" class="form-control" id="editVideo" name="video_url">
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
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
            if (confirm('{{__('Do you want to delete this Video?')}}')) {
                window.location.href = url;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-video-btn');
            var modal = new bootstrap.Modal(document.getElementById('editVideoModal'));
            var form = document.getElementById('editVideoForm');
            var videoIdInput = document.getElementById('videoId');
            var TitleInput = document.getElementById('editTitle');
            var videoInput = document.getElementById('editVideo');
            var descriptionInput = document.getElementById('editDescription');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var videoId = this.getAttribute('data-id');
                    var editTitle = this.getAttribute('data-title');
                    var editVideo = this.getAttribute('data-video');
                    var description = this.getAttribute('data-description');

                    videoIdInput.value = videoId;
                    TitleInput.value = editTitle;
                    videoInput.value = editVideo;
                    descriptionInput.value = description;

                    form.action = '/session-videos/update/' + videoId;

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
