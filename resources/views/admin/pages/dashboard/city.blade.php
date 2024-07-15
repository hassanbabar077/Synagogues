@extends('admin.layout.main')
@php
    $hideFooter = true;
@endphp
@section('content')
    <div class="container px-10 mt-4">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="table pt-2">{{__('City List')}}</h4>
                </div>
                @can(['permission_create'])
                    <div>
                        {{-- <a href="" class="btn btn-primary btn-sm " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" >Add City</a> --}}
                        <button type="button" class="btn btn-sm px-10 text-white btn-warning" data-bs-toggle="modal" data-bs-target="#addCity" style="background-color: #FEBC06;">
                            {{__('Add City')}}</button>
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

                    <strong class="text-danger mt-3">{{ $errors->first('country') }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead >
                            <tr>
                                <th >{{__('ID')}}</th>
                                <th>{{__('City')}}</th>
                                <th>{{__('Country')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Updated At')}}</th>
                                @can(['permission_update'])
                                    <th>{{__('Update')}}</th>
                                 @endcan    
                                @can(['permission_delete'])

                                    <th>{{__('Delete')}}</th>
                                @endcan 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->country }}</td>
                                    <td>{{ $city->created_at }}</td>
                                    <td>{{ $city->updated_at }}</td>
                                     @can(['permission_update'])
                                        <td >
                                           
                                                <button class="btn btn-sm edit-city-btn btn-warning" type="button"
                                                    data-id="{{ $city->id }}" data-name="{{ $city->name }}"
                                                    data-country="{{ $city->country }}" data-bs-toggle="modal" style="background-color: #FEBC06;">
                                                    <i class="fa-solid fa-pen text-white"></i>
                                                </button>
                                         
                                             </td>
                               @endcan                 
                                              @can('permission_delete')
                                              <td >
                                           
                                                <a href="{{ route('cities.delete', $city->id) }}" onclick="confirmDelete(event)"
                                                    class="btn btn-dark btn-sm" type="button" data-toggle="modal" style="background-color: #293038;" ><i
                                                        class="fa-solid fa-trash"></i></a>
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
                    <h1 class="modal-title fs-5" id="addCityModel">{{__('Add City')}}</h1>
                </div>
                <form class="" method="POST" action="{{ route('cities.store') }}">

                    <div class="modal-body">
                        @csrf

                        <div class="mb-3 col-lg-12">

                            <input type="text" name="name" class="form-control form-control-lg"
                                placeholder="{{__('Enter City')}}" required>

                        </div>

                        <div class="mt-4">

                            <input type="text" name="country" class="form-control form-control-lg"
                                placeholder="{{__('Enter Country')}}" required>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-sm btn-warning text-white" style="background-color: #FEBC06;">{{__('Add City')}}</button>
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
                    <h5 class="modal-title" id="editCityModalLabel">{{__('Edit City')}}</h5>
                </div>
                <form id="editCityForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="cityId">
                        <div class="mb-3">
                            <label for="cityName" class="form-label">{{__('City')}}</label>
                            <input type="text" class="form-control" id="cityName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="cityCountry" class="form-label">{{__('Country')}}</label>
                            <input type="text" class="form-control" id="cityCountry" name="country" required>
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
            const isConfirmed = confirm('{{__('Do you want to delete this City?')}}');

            if (isConfirmed) {
                window.location.href = url;
            }
        }
  

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
