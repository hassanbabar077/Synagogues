@extends('admin.layout.main')

@section('content')

<div class="container">
    <div class="row mt-4 modal-dialog modal-dialog-centered">
        <div class="modal-header">
            <h5 class="modal-title text-align-left m-4">{{__('Add New Synagogue')}}</h5>
        </div>
        <div class="col-lg-12 modal-content">
            <div class="modal-body">
                <form class="p-2" method="POST" action="{{route('synagogues.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <label for="name" class="form-label">{{__('Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control form-control-lg" placeholder="{{__('Enter Synagogue Name')}}" required >
                            @error('name')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('Email')}} </label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="{{__('Enter Email')}}" >
                    
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{__('Address')}} <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control form-control-lg" placeholder="{{__('Enter Address')}}" required>
                        @error('address')
                        <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <label for="contact_person" class="form-label">{{__('Contact Person')}}</label>
                            <input type="text" name="contact_person" id="contact_person" class="form-control form-control-lg" placeholder="{{__('Enter Contact Person')}}" >

                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">{{__('Phone')}}</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-lg" placeholder="{{__('Enter Phone')}}" >

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="city_id" class="form-label">{{__('City')}} <span class="text-danger">*</span></label>
                        <select name="city_id" id="city_id" class="form-select" required >
                            <option value="">{{__('Select')}}</option>
                            @foreach ($city as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="logo" class="form-label">{{__('Logo')}} <span class="text-danger">*</span></label>
                        <input type="file" name="logo" id="logo" class="form-control form-control-lg" required>
                        @error('logo')
                        <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="discription" class="form-label">{{__('Description')}}</label>
                        <textarea type="text" name="discription" id="discription" class="form-control form-control-lg" placeholder="{{__('Enter Description (if any)')}}"></textarea>

                    </div>
                    <div class="mb-3">
                        <button type="submit" value="Add User" class="btn text-white btn-warning btn-block btn-sm" style="background-color: #FEBC06;">
                            {{__('Add Synagogue')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@php
$hideFooter = true;
@endphp
@endsection
