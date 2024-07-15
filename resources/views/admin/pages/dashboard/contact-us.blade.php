@extends('admin.layout.main')

@php
$hideFooter = true;
@endphp

@section('content')

<div class="container px-5 ">
    <div class="row ">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="table pt-2">{{__('Contact Us')}}</h4>
            </div>
            @can('permission_create')
            <div>
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ContactUs" style="background-color: #FEBC06;">
                   {{__('Add Contact')}}
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

                <strong class="text-danger mt-3">{{ $errors->first('phone_number') }}</strong>
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
                            <th>{{__('Phone Number')}}</th>
                            <th>{{__('Created At')}}</th>
                            <th>{{__('Updated At')}}</th>
                            @can(['permission_update'])
                           <th>{{__('Update')}}</th>
                            <th>{{__('Delete')}}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact_us)
                        <tr>
                            <td>{{ $contact_us->id }}</td>
                            <td>{{ $contact_us->phone_number }}</td>
                            <td>{{ $contact_us->created_at }}</td>
                            <td>{{ $contact_us->updated_at }}</td>
                            <td>
                                @can('permission_update')
                                <button class="btn btn-warning btn-sm edit-contact-btn" style="background-color: #FEBC06;" type="button" data-id="{{ $contact_us->id }}" data-phone="{{ $contact_us->phone_number }}"  data-bs-toggle="modal" data-bs-target="#editContactModal">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                @endcan
                                </td>
                                <td>
                                @can('permission_delete')
                                <a href="{{ route('contact-us.delete', $contact_us->id) }}" onclick="confirmDelete(event)" class="btn btn-dark btn-sm" type="button"  style="background-color: #293038;"><i class="fa-solid fa-trash"></i></a>
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
<div class="modal fade" id="ContactUs" tabindex="-1" aria-labelledby="addContactModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addContactModelLabel">{{__('Add Contact')}}</h1>
            </div>
            <form method="POST" action="{{ route('contact-us.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" name="phone_number" class="form-control" placeholder="{{__('Enter Phone')}}"  required>

                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Contact')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Contact Modal -->
<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel">{{__('Edit Contact')}}</h5>
            </div>
            <form id="editContactForm" method="POST" action="{{ route('contact-us.update', ['id' => $contact_us->id]) }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="contactId">
                    <div class="mb-3">
                        <label for="editPhoneNumber" class="form-label">{{__('Phone Number')}}</label>
                        <input type="text" class="form-control" id="editPhoneNumber" name="phone_number" >
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
        if (confirm('{{__('Do you want to delete this contact?')}}')) {
            window.location.href = url;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
    const editContactModal = document.getElementById('editContactModal');
    editContactModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const contactId = button.getAttribute('data-id');
        const phoneNumber = button.getAttribute('data-phone');

        // Update the form action
        const form = editContactModal.querySelector('#editContactForm');
        form.action = `/contact-us/update/${contactId}`;

        // Update form fields
        document.getElementById('contactId').value = contactId;
        document.getElementById('editPhoneNumber').value = phoneNumber;
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
