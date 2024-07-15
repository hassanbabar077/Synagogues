@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row mt-4 modal-dialog modal-dialog-centered">
            <div class="modal-header">
                <h5 class="modal-title text-align-left m-4">{{__('Add New Torah Detail')}}</h5>
            </div>
            <div class="col-lg-12 modal-content">
                <div class="modal-body">
                    <form class="p-2" method="POST" action="{{ route('session-details.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="name" class="form-label">{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="session_name" id="name" class="form-control form-control-lg" placeholder="{{__('Enter Session Name')}}" required>
                                @error('name')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="session_time" class="form-label">{{__('Session Time')}} <span class="text-danger">*</span></label>
                                <input type="time" name="session_time" id="session_time" class="form-control form-control-lg" placeholder="{{__('Enter Time')}}" required>
                                @error('session_time')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="instructor" class="form-label">{{__('Instructor')}} <span class="text-danger">*</span></label>
                                <input type="text" name="instructor" id="instructor" class="form-control form-control-lg" placeholder="{{__('Enter Instructor')}}" required>
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
                        
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="synagogue_id" class="form-label">{{__('Synagogues')}} <span class="text-danger">*</span></label>
                                <select name="synagogue_id" id="synagogue_id" class="form-select" required>
                                    <option value="">{{__('Select')}}</option>
                                    @foreach ($synagogues as $synagogue)
                                    <option value="{{ $synagogue->id }}">{{ $synagogue->name }}</option>
                                    @endforeach
                                </select>
                                @error('synagogue_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                            <div class="mb-3">
                            <label for="address" class="form-label">{{__('Address')}} </label>
                            <input type="text" name="address" id="address" class="form-control form-control-lg" placeholder="{{__('Enter Address')}}" >
                            @error('address')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                           </div>
                           
                            <div class="col">
                                <label for="category_id" class="form-label">{{__('Torah Category')}} <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">{{__('Select')}}</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->lesson_category }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3  bg-secondry ">
                            <label for="days" class="form-label">{{__('Days')}} <span class="text-danger">*</span></label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Monday" id="monday">
                                    <label class="form-check-label text-dark" for="monday">{{__('Monday')}}</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Tuesday" id="tuesday">
                                    <label class="form-check-label text-dark" for="tuesday">{{__('Tuesday')}}</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Wednesday" id="wednesday">
                                    <label class="form-check-label text-dark" for="wednesday">{{__('Wednesday')}}</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Thursday" id="thursday">
                                    <label class="form-check-label text-dark" for="thursday">{{__('Thursday')}}</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input " type="checkbox" name="days[]" value="Friday" id="friday">
                                    <label class="form-check-label text-dark" for="friday">{{__('Friday')}}</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input " type="checkbox" name="days[]" value="Saturday" id="saturday">
                                    <label class="form-check-label text-dark" for="saturday">{{__('Saturday')}}</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input " type="checkbox" name="days[]" value="Sunday" id="sunday">
                                    <label class="form-check-label text-dark" for="sunday">{{__('Sunday')}}</label>
                                </div>
                            </div>
                             @error('days')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="col mb-3">
                            <label for="logo" class="form-label">{{__('Logo')}}</label>
                            <input type="file" name="session_image" id="logo" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="discription" class="form-label">{{__('Description')}}</label>
                            <textarea type="text" name="discription" id="discription" class="form-control form-control-lg" placeholder="{{__('Enter Description (if any)')}}"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" value="Add User" class="btn text-white btn-warning btn-block btn-sm" style="background-color: #FEBC06;">
                                {{__('Add Session')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @php
        $hideFooter = true;
    @endphp
@endsection

<style>
    .form-check {
        display: inline-block;
        margin-right: 10px;
    }
</style>
