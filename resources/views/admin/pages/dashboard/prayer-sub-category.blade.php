@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp

@section('content')
    <div class="container px-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Prayer Sub Category List')}}</h4>
                </div>
                @can('permission_create')
                    <div>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addCity" style="background-color: #FEBC06;">
                            {{__('Add Sub Category')}}
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
                    <strong class="text-danger mt-3">{{ $errors->first('name') }}</strong>
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
                                <th>{{__('Icon')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Updated At')}}</th>
                                @can('permission_update')
                                    <th>{{__('Update')}}</th>
                                @endcan
                                    @can('permission_delete')
                                    <th>{{__('Delete')}}</th>
                                   
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($PrayerSubCategory as $subCategory)
                                <tr>
                                    <td>{{ $subCategory->id }}</td>
                                    <td>{{ $subCategory->title }}</td>
                                    <td>
                                        <img src="{{ $subCategory->icon }}" class="img-fluid img-thumbnail" style="max-width: 50px; cursor: pointer;" onclick="showImageModal('{{ asset($subCategory->icon) }}')">
                                    </td>
                                    <td>{{ $subCategory->prayercategory->name }}</td>
                                    <td>{{ $subCategory->created_at }}</td>
                                    <td>{{ $subCategory->updated_at }}</td>
                                    @can('permission_update')
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-city-btn"
                                                    type="button"
                                                    data-id="{{ $subCategory->id }}"
                                                    data-title="{{ $subCategory->title }}"
                                                    data-prayercategoryid="{{ $subCategory->prayercategory->id }}"
                                                    data-icon="{{ asset($subCategory->icon) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCityModal" style="background-color: #FEBC06;">
                                                <i class="fa-solid fa-pen text-white"></i>
                                            </button>
                                        </td>
                                    @endcan
                                    @can('permission_delete')
                                        <td>
                                            <a href="{{ route('prayer-sub-category.delete', $subCategory->id) }}"
                                               class="btn btn-dark btn-sm"
                                               type="button"
                                               onclick="confirmDelete(event)"  style="background-color: #293038;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="" class="img-fluid" id="modalImage" style="max-height: 70vh;">
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCity" tabindex="-1" aria-labelledby="addCityModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCityModel">{{__('Add Sub Category')}}</h1>
                </div>
                <form method="POST" action="{{ route('prayer-sub-category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 col-lg-12">
                            <label for="title" class="form-label">{{__('Title')}} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control form-control-lg" placeholder="{{__('Enter Sub Category Title')}}" required>
                             @error('title')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="icon" class="form-label">{{__('Icon')}} <span class="text-danger">*</span></label>
                            <input type="file" name="icon" class="form-control form-control-lg" required>
                             @error('icon')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        
                         <div class="mb-3 col-lg-12">
                        <label for="icon" class="form-label">{{__('Category')}} <span class="text-danger">*</span></label>
                        <select name="prayer_category_id" id="prayer_category_id" class="form-select" required >
                            <option value="">{{__('Select')}}</option>
                            @foreach ($PrayerCategory as $category)
                            <option value="{{$category->id  }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('prayer_category_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Sub Category')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCityModalLabel">{{__('Edit Prayer Sub Category')}}</h5>
                </div>
                <form id="editCityForm" method="POST" action="{{ route('prayer-sub-categories.update', ['id' => ':id']) }}" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="modal-body">
                        <input type="hidden" name="id" id="cityId">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="file" class="form-control" id="TodayTimeicon" name="icon" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                                <label for="TodayTimeicon" class="edit-icon"><i class="fas fa-pencil-alt"></i></label>
                            </div>
                            <div class="avatar-preview">
                                <img id="imagePreview" src="{{ asset('admin/assets/media/avatars/300-3.jpg') }}" alt="Image Preview">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">{{__('Title')}}</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                             @error('title')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prayer_category_id" class="form-label">{{__('Category')}}</label>
                            <select class="form-select" name="prayer_category_id" id="cityCountry" aria-label="Default select example" required>
                                @foreach($PrayerCategory as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                             @error('prayer_category_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
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
            const isConfirmed = confirm('{{__('Do you want to delete this Sub Category?')}}');
            if (isConfirmed) {
                window.location.href = url;
            }
        }

        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-city-btn');
            var modal = new bootstrap.Modal(document.getElementById('editCityModal'));
            var form = document.getElementById('editCityForm');
            var titleInput = document.getElementById('title');
            var categorySelect = document.getElementById('cityCountry');
            var cityIdInput = document.getElementById('cityId');
            var iconInput = document.getElementById('TodayTimeicon');
            var imagePreview = document.getElementById('imagePreview');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var cityId = this.getAttribute('data-id');
                    var title = this.getAttribute('data-title');
                    var prayerCategoryId = this.getAttribute('data-prayercategoryid');
                    var icon = this.getAttribute('data-icon');

                    cityIdInput.value = cityId;
                    titleInput.value = title;

                    // Set the selected category
                    Array.from(categorySelect.options).forEach(function(option) {
                        option.selected = option.value == prayerCategoryId;
                    });

                    // Set the image preview
                    if (icon) {
                        imagePreview.src = icon;
                    } else {
                        imagePreview.src = '{{ asset('admin/assets/media/avatars/300-3.jpg') }}';
                    }

                    form.action = form.action.replace(':id', cityId);

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
