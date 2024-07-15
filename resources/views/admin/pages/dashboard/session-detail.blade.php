@extends('admin.layout.main')

@section('content')
    <div class="container px-5">
        <div class="row ">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Torah Lesson Details')}}</h4>
                </div>
             
                    <div>
                        <a href="{{ route('session-details.create') }}" class="btn text-white btn-warning btn-sm" type="button"
                            data-toggle="modal" style="background-color: #FEBC06;">{{__('Add New Lesson')}}</a>
                    </div>
            

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div id="showAlert"></div>
                @if (session('success'))
                    <div class="alert alert-success mt-3 p-3" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if ($errors->has('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>{{ $errors->first('error') }}</strong>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Logo')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Synagogues')}}</th>
                                <th>{{__('Torah Category')}}</th>
                                <th>{{__('Session Time')}}</th>
                                <th>{{__('Instructor')}}</th>
                                <th>{{__('Address')}}</th>
                                 <th>{{__('Phone')}}</th>
                                <th>{{__('Days of Session')}}</th>
                                <th>{{__('Description')}} </th>
                               
                                @can(['permission_update'])
                                    <th>{{__('Update')}}</th>
                                @endcan    
                                     @can(['permission_delete'])
                                    
                                     <th>{{__('Delete')}}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($session_details as $session_detail)
                                <tr>
                                    <td>{{ $session_detail->id }}</td>
                                    <td>
                                        <img src="{{ asset($session_detail->session_image) }}"
                                            class="img-fluid img-thumbnail" style="max-width: 50px; cursor: pointer;"
                                            onclick="showImageModal('{{ asset($session_detail->session_image) }}')">
                                    </td>
                                    <td>{{ $session_detail->session_name }}</td>
                                    <td>{{ $session_detail->synagogue->name }}</td>
                                    <td>{{ $session_detail->category->lesson_category }}</td>
                                    <td>{{ $session_detail->session_time }}</td>
                                    <td>{{ $session_detail->instructor }}</td>
                                    <td>{{ $session_detail->address }}</td>
                                     <td>{{ $session_detail->phone ??'N/A'}}</td>
                                    <td>{{ $session_detail->days_of_session }}</td>
                                    <td>{{ $session_detail->discription }}</td>
                        

                                    @can(['permission_update'])
                                        <td>


                                            <a href="{{ route('session-details.edit', $session_detail->id) }}"
                                                class="btn btn-sm btn-warning" type="button" data-toggle="modal" style="background-color: #FEBC06;"><i
                                                    class="fa-solid fa-pen text-white"></i></a>
                                         </td>
                                    @endcan     
                                    @can(['permission_delete'])
                                         <td>
                                            
                                                <a href="{{ route('session-details.delete', $session_detail->id) }}"
                                                    class="btn btn-dark btn-sm" type="button" onclick="confirmDelete(event)"  style="background-color: #293038;">
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


    <!-- Modal for Image -->
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

    @php
        $hideFooter = true;
    @endphp
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const url = event.currentTarget.getAttribute('href');
            const isConfirmed = confirm('{{__('Do you want to delete this Session?')}}');

            if (isConfirmed) {
                window.location.href = url;
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
@endsection
