@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('Managers List')}}</h4>
                </div>
                @can(['permission_create'])
                    <div>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addManager" style="background-color: #FEBC06;">
                            {{__('Add Manager')}}</button>
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
                <div>

                    <strong class="text-danger mt-3">{{ $errors->first('email') }}</strong>
                </div>
                <div>

                    <strong class="text-danger mt-3">{{ $errors->first('password') }}</strong>
                </div>
                 <div>

                    <strong class="text-danger mt-3">{{ $errors->first('synagogue') }}</strong>
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
                                <th>{{__('Name')}}</th>
                                <th>{{__('Synagogues')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Created At')}}</th>
                                @can(['permission_update'])
                                    <!--<th>Update</th>-->
                                    <th>{{__('Delete')}}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($managers as $manger)
                                <tr>
                                    <td>{{ $manger->id }}</td>
                                    <td>{{ $manger->name }}</td>
                                    <td> @if ($manger->manager && $manger->manager->synagogue)
                                    {{ $manger->manager->synagogue->name }}
                          @else
                                    N/A <!-- Handle case where synagogue is null -->
                          @endif</td>
                                    <td>{{ $manger->email }}</td>
                                    <td>{{ $manger->created_at }}</td>
                            
                                    @can(['permission_update'])
                                        <!--<td >-->
                                        <!--    @can(['permission_update'])-->
                                        <!--        <button class="btn btn-primary btn-sm edit-city-btn " type="button"-->
                                        <!--            data-id="{{ $manger->id }}" data-name="{{ $manger->name }}"-->
                                        <!--            data-country="{{ $manger->country }}" data-bs-toggle="modal">-->
                                        <!--            <i class="fa-solid fa-pen"></i>-->
                                        <!--        </button>-->
                                        <!--    @endcan-->
                                        <!--     </td>-->
                                              <td >
                                            @can('permission_delete')
                                                <a href="{{ route('synagogues.manager.delete', $manger->id) }}" onclick="confirmDelete(event)"
                                                    class="btn btn-dark btn-sm" type="button" data-toggle="modal"  style="background-color: #293038;"><i
                                                        class="fa-solid fa-trash"></i></a>
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



    <div class="modal fade" id="addManager" tabindex="-1" aria-labelledby="addManagerModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addManagerModel">{{__('Add Manager')}}</h1>
                </div>
                <form class="" method="POST" action="{{ route('synagogues.manager.store') }}">

                    <div class="modal-body">
                        @csrf

                        <div class="mb-3 col-lg-12">
                            <label for="name" class="form-label">{{__('Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-lg"
                                placeholder="{{__('Enter Name')}}" required>

                        </div>

                        <div class="mt-4">
                                      <label for="name" class="form-label">{{__('Email')}} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control form-control-lg"
                                placeholder="{{__('Enter Email')}}" required>

                        </div>
                          <div class="mt-4">
                                <label for="name" class="form-label">{{__('Password')}} <span class="text-danger">*</span></label>
                            <input type="text" name="password" class="form-control form-control-lg"
                                placeholder="{{__('Enter Password')}}" required>

                        </div>
                         <div class="mt-4">
                            <label for="name" class="form-label">{{__('Synagogues')}} <span class="text-danger">*</span></label>
                            <select class="form-select" name="synagogue" aria-label="Default select example" required>
                                <option selected disabled>{{__('Select Synagogue')}}</option>
                                @foreach($synagogues as $synagogue)
                                <option value="{{$synagogue->id}}">{{$synagogue->name}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-warning btn-sm" style="background-color: #FEBC06;">{{__('Add Manager')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCityModalLabel">Edit Manager</h5>
                </div>
                <form id="editCityForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="cityId">
                        <div class="mb-3">
                            <label for="cityName" class="form-label">City Name</label>
                            <input type="text" class="form-control" id="cityName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="cityCountry" class="form-label">Country</label>
                            <input type="text" class="form-control" id="cityCountry" name="country" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const url = event.currentTarget.getAttribute('href');
            const isConfirmed = confirm('{{__('Do you want to delete this Manager?')}}');

            if (isConfirmed) {
                window.location.href = url;
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-city-btn');
            var modal = new bootstrap.Modal(document.getElementById('editCityModal'));
            var form = document.getElementById('editCityForm');
            var cityNameInput = document.getElementById('cityName');
            var cityCountryInput = document.getElementById('cityCountry');
            var cityIdInput = document.getElementById('cityId');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var cityId = this.getAttribute('data-id');
                    var cityName = this.getAttribute('data-name');
                    var cityCountry = this.getAttribute('data-country');

                    cityIdInput.value = cityId;
                    cityNameInput.value = cityName;
                    cityCountryInput.value = cityCountry;

                    form.action = '/cities/update/' + cityId;

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
