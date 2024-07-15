@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container px-10 mt-4">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2" >{{__('About List')}}</h4>
                </div>
                @can(['permission_create'])
                    <div>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addAbout" style="background-color: #FEBC06;">
                           {{__('Add About')}}</button>
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
                                <th>{{__('Content')}}</th>
                                <th>{{__('Subtitle')}}</th>
                                <th>{{__('Link')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Update')}}</th>
                                 <th>{{__('Delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($app_about as $about)
                                <tr>
                                    <td>{{ $about->id }}</td>
                                    <td>{{ $about->title }}</td>
                                    <td>{{ $about->content }}</td>
                                    <td>{{ $about->subtitle }}</td>
                     <td><a href="{{ $about->link }}" target="_blank" rel="noopener noreferrer">{{__('URL')}}</a></td>

                                    <td>{{ $about->description }}</td>
                                    @can(['permission_update', 'permission_delete'])
                                        <td>
                                            @can(['permission_update'])
                                                <button class="btn btn-warning btn-sm edit-about-btn" type="button"
                                                    data-id="{{ $about->id }}" data-title="{{ $about->title }}"
                                                    data-content="{{ $about->content }}" data-subtitle="{{ $about->subtitle }}"
                                                    data-link="{{ $about->link }}"
                                                    data-description = "{{ $about->description }}"
                                                    data-bs-toggle="modal" data-bs-target="#editAboutModal" style="background-color: #FEBC06;">
                                                    <i class="fa-solid fa-pen text-white"></i>
                                                </button>
                                            @endcan
                                         </td>
                                        <td>
                                            @can('permission_delete')
                                                <a href="{{ route('about.delete', $about->id) }}"
                                                    onclick="confirmDelete(event)" class="btn btn-dark btn-sm" type="button"  style="background-color: #293038;">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
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

    <div class="modal fade" id="addAbout" tabindex="-1" aria-labelledby="addAboutModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addAboutModel">{{__('Add About')}}</h1>
                </div>
                <form class="" method="POST" action="{{ route('about.store') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3 col-lg-12">
                            <input type="text" name="title" class="form-control form-control-lg"
                                placeholder="{{__('Enter Title')}}" required >

                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="content" placeholder="{{__(' ')}} {{__('Enter Content')}} " rows="3"></textarea>

                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="subtitle" placeholder="{{__(' ')}} {{__('Enter Subtitle')}} " rows="3"></textarea>

                        </div>
                        <div class="mb-3 col-lg-12">
                            <input type="text" name="link" class="form-control form-control-lg"
                                placeholder="{{__('Enter Link')}}" >

                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="description" placeholder="{{__(' ')}} {{__('Enter Description (if any)')}}" rows="3"></textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add About')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->

    <div class="modal fade" id="editAboutModal" tabindex="-1" aria-labelledby="editAboutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAboutModalLabel">{{__('Edit About')}}</h5>
                </div>
                <form id="editAboutForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="aboutId">
                        <div class="mb-3">
                            <label for="aboutTitle" class="form-label">{{__('Title')}}</label>
                            <input type="text" class="form-control" id="aboutTitle" name="title"  required>
                        </div>
                        <div class="mb-3">
                            <label for="aboutContent" class="form-label">{{__('Content')}}</label>
                            <textarea class="form-control" id="aboutContent" name="content" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="aboutSubtitle" class="form-label">{{__('Subtitle')}}</label>
                            <textarea class="form-control" id="aboutSubtitle" name="subtitle" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="aboutLink" class="form-label">{{__('Link')}}</label>
                            <input type="text" class="form-control" id="aboutLink" name="link" >
                        </div>
                        <div class="mb-3">
                            <label for="aboutDescription" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="aboutDescription" name="description" rows="3"></textarea>
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
            const isConfirmed = confirm('{{__('Do you want to delete this About content?')}}');

            if (isConfirmed) {
                window.location.href = url;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-about-btn');
            var modal = new bootstrap.Modal(document.getElementById('editAboutModal'));
            var form = document.getElementById('editAboutForm');
            var aboutIdInput = document.getElementById('aboutId');
            var aboutTitleInput = document.getElementById('aboutTitle');
            var aboutContentInput = document.getElementById('aboutContent');
            var aboutSubtitleInput = document.getElementById('aboutSubtitle');
            var aboutDescriptionInput = document.getElementById('aboutDescription');
            var aboutLinkInput = document.getElementById('aboutLink');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var aboutId = this.getAttribute('data-id');
                    var aboutTitle = this.getAttribute('data-title');
                    var aboutContent = this.getAttribute('data-content');
                    var aboutSubtitle = this.getAttribute('data-subtitle');
                    var aboutDescription = this.getAttribute('data-description');
                    var aboutLink = this.getAttribute('data-link');

                    aboutIdInput.value = aboutId;
                    aboutTitleInput.value = aboutTitle;
                    aboutContentInput.value = aboutContent;
                    aboutSubtitleInput.value = aboutSubtitle;
                    aboutDescriptionInput.value = aboutDescription;
                    aboutLinkInput.value = aboutLink;

                    form.action = '/about/update/' + aboutId;

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
