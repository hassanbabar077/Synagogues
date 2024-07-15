@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container">
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
        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">

            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type="file" name="profile_picture" id="imageUpload" accept=".png, .jpg, .jpeg" onchange="previewImage(event)" />
                    <label for="imageUpload" class="edit-icon"><i class="fas fa-pencil-alt"></i></label>
                </div>
                <div class="avatar-preview">
                    <img id="imagePreview"
                        src="{{ auth()->user()->profile_picture ? auth()->user()->profile_picture : asset('admin/assets/media/avatars/300-3.jpg') }}"
                        alt="Image Preview">
                </div>
            </div>
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" name="username" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>



            <div class="input-group mb-3">
                <input type="password" class="form-control" name="oldpassword" autocomplete="off"
                    placeholder="{{__('Old Password')}}">

            </div>

            <div class="input-group mb-4">
                <input type="password" class="form-control" name="newPassword" placeholder="{{__('New Password')}}">

            </div>



            <div class="text-center ">
                <button type="submit" class="btn btn-warning btn-sm " style="background-color: #FEBC06;">{{__('Update')}}</button>
            </div>
        </form>
    </div>
    <div>

    </div>
@endsection
<style>
    body {
        background: whitesmoke;
        font-family: 'Open Sans', sans-serif;
    }

    .container {
        max-width: 960px;
        margin: 30px auto;
        padding: 20px;
    }

    h1 {
        font-size: 20px;
        text-align: center;
        margin: 20px 0 20px;
    }

    h1 small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }

    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit label.edit-icon {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        text-align: center;
        line-height: 34px; /* Center icon vertically */
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit label.edit-icon:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit label.edit-icon i {
        font-size: 16px;
        color: #757575;
        display: block; /* Ensure icon behaves like a block element */
        margin-top: 12px; /* Adjust vertical alignment as needed */
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 50%;
        border: 6px solid #F8F8F8;
        overflow: hidden;
    }

    .avatar-upload .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>


<script>

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
