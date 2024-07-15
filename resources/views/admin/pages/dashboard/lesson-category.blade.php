@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container px-5 ">
        <div class="row ">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Torah Lesson Category List')}}</h4>
                </div>
                @can('permission_create')
                    <div>
                        <button type="button" class="btn text-white btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addCategory" style="background-color: #FEBC06;">
                            {{__('Add Category')}}</button>
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
                    <strong class="text-danger mt-3">{{ $errors->first('lesson_category') }}</strong>
                </div>
                <div>
                    <strong class="text-danger mt-3">{{ $errors->first('icon') }}</strong>
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
                                <th>{{__('Icon')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Created At')}}</th>
                                @can('permission_update')
                                    <th>{{__('Update')}}</th>
                                     @endcan
                                     @can('permission_delete')
                                    <th>{{__('Delete')}}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lesson_categories as $lesson_category)
                                <tr>
                                    <td>{{ $lesson_category->id }}</td>
                                    <td>
                                        <img src="{{ asset($lesson_category->icon) }}" class="img-fluid img-thumbnail"
                                            style="max-width: 50px; cursor: pointer;"
                                            onclick="showImageModal('{{ asset($lesson_category->icon) }}')">
                                    </td>
                                    <td>{{ $lesson_category->lesson_category }}</td>
                                    <td>{{ $lesson_category->description }}</td>
                                    <td>{{ $lesson_category->created_at }}</td>

                                    @can('permission_update')
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-category-btn" type="button"
                                                data-id="{{ $lesson_category->id }}"
                                                data-lesson_category="{{ $lesson_category->lesson_category }}"
                                                data-icon="{{ asset($lesson_category->icon) }}"
                                                data-description="{{ $lesson_category->description }}"
                                                data-bs-toggle="modal" style="background-color: #FEBC06;">
                                                <i class="fa-solid fa-pen text-white"></i>
                                            </button>
                                             </td>
                                        @endcan     
                                              @can('permission_delete')
                                             <td>
                                                 
                                           
                                                <a href="{{ route('lesson-category.delete', $lesson_category->id) }}"
                                                    onclick="confirmDelete(event)" class="btn btn-dark btn-sm" type="button"  style="background-color: #293038;">
                                                    <i class="fa-solid fa-trash"></i></a>
                                            
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

    <!-- Image Modal -->
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
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCategoryModel">{{__('Add Category')}}</h1>
                </div>
                <form method="POST" action="{{ route('lesson-category.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3 col-lg-12">
                              <label for="address" class="form-label">{{__('Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="lesson_category" class="form-control form-control-lg" placeholder="{{__('Enter Category')}}"  required>
                        </div>
                        <div class="mb-3 col-lg-12">
                             <label for="address" class="form-label">{{__('Icon')}} <span class="text-danger">*</span></label>

                            <input type="file" name="icon" class="form-control form-control-lg" placeholder="Enter icon" required>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <textarea class="form-control" name="description" placeholder="{{__(' ')}} {{__('Enter Description (if any)')}}" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn text-white btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Category')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">{{__('Edit Category')}}</h5>
                </div>
                <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" class="form-control" id="categoryIcon" name="icon" accept=".png, .jpg, .jpeg" onchange="previewImage(event)" />
                            <label for="categoryIcon" class="edit-icon"><i class="fas fa-pencil-alt"></i></label>
                        </div>
                        <div class="avatar-preview">
                            <img id="imagePreview" src="{{ asset('admin/assets/media/avatars/300-3.jpg') }}" alt="Image Preview">
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="categoryId">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">{{__('Category')}}</label>
                            <input type="text" class="form-control" id="categoryName" name="lesson_category" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
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
            const isConfirmed = confirm('{{__('Do you want to delete this Category?')}}');
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
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-category-btn');
            var modalElement = document.getElementById('editCategoryModal');
            var modal = new bootstrap.Modal(modalElement);
            var form = document.getElementById('editCategoryForm');
            var categoryIdInput = document.getElementById('categoryId');
            var categoryNameInput = document.getElementById('categoryName');
            var descriptionInput = document.getElementById('description');
            var imagePreview = document.getElementById('imagePreview');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var categoryId = this.getAttribute('data-id');
                    var categoryName = this.getAttribute('data-lesson_category');
                    var categoryIcon = this.getAttribute('data-icon');
                    var description = this.getAttribute('data-description');

                    categoryIdInput.value = categoryId;
                    categoryNameInput.value = categoryName;
                    descriptionInput.value = description;

                    // Set image preview
                    if (categoryIcon) {
                        imagePreview.src = categoryIcon;
                    } else {
                        imagePreview.src = '{{ asset('admin/assets/media/avatars/300-3.jpg') }}';
                    }

                    form.action = '/torah-lesson-category/update/' + categoryId;
                    modal.show();
                });
            });
        });

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
@endsection
