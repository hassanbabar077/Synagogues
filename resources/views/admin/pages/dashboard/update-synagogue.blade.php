@extends('admin.layout.main')

@section('content')

<div class="container">
    <div class="row mt-4 modal-dialog modal-dialog-centered">
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
        <div class="modal-header">
            <h5 class="modal-title m-4">{{__('Update Synagogue')}}</h5>
        </div>
        <div class="col-lg-12 modal-content">
            <div class="modal-body">
                <form class="p-2" method="POST" action="{{route('synagogues.update', $synagogue->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <label for="name" class="form-label">{{__('Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{$synagogue->name}}" class="form-control form-control-lg" placeholder="Enter Synagogue Name"  required>
                            @error('name')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                        <label for="logo" class="form-label">{{__('Logo')}} </label>
                            <input type="file" name="logo" id="logo" value="{{$synagogue->logo}}" class="form-control form-control-lg" placeholder="Enter logo" >
                            @error('logo')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <label for="contact_person" class="form-label">{{__('Contact Person')}}</label>
                            <input type="text" name="contact_person" id="contact_person" value="{{$synagogue->contact_person}}" class="form-control form-control-lg" placeholder="Enter Contact Person" >

                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">{{__('Phone')}}</label>
                            <input type="text" name="phone" id="phone" value="{{$synagogue->phone}}" class="form-control form-control-lg" placeholder="Enter Phone" >

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input type="email" name="email" id="email" value="{{$synagogue->email}}" class="form-control form-control-lg" placeholder="Enter Email" >
                      
                    </div>
                    <div class="mb-3">
                       <label for="address" class="form-label">{{__('Address')}} <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" value="{{$synagogue->address}}" class="form-control form-control-lg" placeholder="Enter Address" required >
                        @error('address')
                        <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city_id" class="form-label">{{__('City')}} <span class="text-danger">*</span></label>
                        <select name="city_id" id="city_id" class="form-select"  required>
                            <option value="">{{__('Select')}}</option>
                            @foreach ($city as $city)
                            <option value="{{ $city->id }}" {{ $city->id == $synagogue->city_id ? 'selected' : '' }}>
                                {{ $city->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label for="discription" class="form-label">{{__('Description')}} </label>
                        <textarea type="textarea" name="discription"  placeholder="Description (if any)" value="" id="discription" class="form-control form-control-lg" >{{ $synagogue->discription }}</textarea>

                    </div>
                    <div class="mb-3">
                        <button type="submit" value="Update" class="btn text-white btn-warning btn-block btn-sm" style="background-color: #FEBC06;">
                            {{__('Update')}}
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
