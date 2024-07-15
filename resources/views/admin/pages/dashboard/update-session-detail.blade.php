@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row mt-4 modal-dialog modal-dialog-centered">
            <div class="modal-header">
                <h5 class="modal-title text-align-left m-4">{{__('Update Session')}}</h5>
            </div>
            <div class="col-lg-12 modal-content">
                <div class="modal-body">
                    <form class="p-2" method="POST" action="{{ route('session-details.update' , $session_details->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="name" class="form-label">{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="session_name" id="name" value="{{ $session_details->session_name }}"
                                    class="form-control form-control-lg" placeholder="{{__('Enter Session Name')}}" >
                                @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="contact_person" class="form-label">{{__('Session Time')}} <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="session_time" id="contact_person" value="{{ date('Y-m-d\TH:i:s', strtotime($session_details->session_time)) }}"
                                    class="form-control form-control-lg" placeholder="{{__('Enter Time')}}" >
                                @error('session_time')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">{{__('Instructor')}} <span class="text-danger">*</span></label>
                                <input type="text" name="instructor" value="{{ $session_details->instructor }}" id="instructor" class="form-control form-control-lg"
                                    placeholder="{{__('Enter Instructor')}}" >
                                @error('instructor')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="col">
                                <label for="instructor" class="form-label">{{__('Phone')}} </label>
                                <input type="text" name="phone_number" id="instructor" class="form-control form-control-lg" placeholder="{{__('Enter Phone')}}" >
                                @error('phone')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{__('Address')}}</label>
                            <input type="text" name="address" value="{{ $session_details->address }}" id="email" class="form-control form-control-lg"
                                placeholder="{{__('Enter Address')}}" >
                            @error('address')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="synagogue_id" class="form-label">{{__('Synagogues')}} <span class="text-danger">*</span></label>
                                <select name="synagogue_id" id="synagogue_id" class="form-select" required>
                                    <option value="">{{__('Select')}}</option>
                                    @foreach ($synagogues as $synagogue)
                                        <option value="{{ $synagogue->id }}" {{ $synagogue->id == $session_details->synagogue_id ? 'selected' : '' }}>
                                            {{ $synagogue->name ?? ''}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="city_id" class="form-label">{{__('Torah Category')}} <span class="text-danger">*</span></label>
                                <select name="category_id" id="city_id" class="form-select" required>
                                    <option value="">{{__('Select')}}</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $session_details->category_id ? 'selected' : '' }}>
                                        {{ $category->lesson_category ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    <!-- Description -->
           
                     <div class="mb-3 bg-secondary">
                        <label for="days" class="form-label">{{__('Days')}} <span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Monday" id="monday" {{ in_array('Monday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="monday">{{__('Monday')}}</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Tuesday" id="tuesday" {{ in_array('Tuesday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="tuesday">{{__('Tuesday')}}</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Wednesday" id="wednesday" {{ in_array('Wednesday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="wednesday">{{__('Wednesday')}}</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Thursday" id="thursday" {{ in_array('Thursday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="thursday">{{__('Thursday')}}</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Friday" id="friday" {{ in_array('Friday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="friday">{{__('Friday')}}</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Saturday" id="saturday" {{ in_array('Saturday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="saturday">{{__('Saturday')}}</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Sunday" id="sunday" {{ in_array('Sunday', $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="sunday">{{__('Sunday')}}</label>
                            </div>
                        </div>
                        @error('days')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">{{__('Description')}}</label>
                <textarea name="discription" id="description" class="form-control form-control-lg" placeholder="{{__('Enter Description (if any)')}}">{{ $session_details->discription }}</textarea>
                @error('description')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
                        <!--<div class="row mb-3 gx-3">-->
                            
                        <!--    <div class="col">-->
                        <!--        <label for="youtube_url" class="form-label">Youtube URL </label>-->
                        <!--        <input type="text" name="youtube_url" value="{{ $session_details->youtube_url }}" id="youtube_url" class="form-control form-control-lg"-->
                        <!--            placeholder="Enter Youtube URL" >-->

                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col mb-3">
                            <label for="logo" class="form-label">{{__('Logo')}}</label>
                            <input type="file" name="session_image" value="{{ $session_details->session_image }}" id="logo" class="form-control form-control-lg"
                                >

                        </div>
                        <div class="mb-3">
                            <button type="submit" value="Add User" class="btn text-white btn-warning btn-block btn-sm" style="background-color: #FEBC06;">
                                {{__('Update Session')}}
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
