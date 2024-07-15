@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row mt-4 modal-dialog modal-dialog-centered">
            <div class="modal-header">
                <h5 class="modal-title text-align-left m-4">{{__('Add New Prayer Time')}}</h5>
            </div>
            <div class="col-lg-12 modal-content">
                <div class="modal-body">
                    <form class="p-2" method="POST" action="{{ route('prayer-time.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                         <div class="row mb-3 gx-3">
                           
                      <div class="col">
                        <label for="icon" class="form-label">{{__('Prayer sub Category')}} <span class="text-danger">*</span></label>
                        <select name="prayer_sub_categories_id" id="prayer_sub_categories_id" class="form-select" required >
                            <option value="">{{__('Select')}}</option>
                            @foreach ($PrayerSubCategory as $PrayerSubCategory)
                            <option value="{{$PrayerSubCategory->id  }}">{{ $PrayerSubCategory->title }}</option>
                            @endforeach
                        </select>
                        @error('prayer_sub_categories_id')
                                    <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="name" class="form-label">{{__('Time')}} <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="time" id="time"
                                    class="form-control form-control-lg" placeholder="{{__('Enter Time')}}"  required>
                                @error('time')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!--<div class="row mb-3 gx-3">-->
                            <div class="col">
                                <label for="location" class="form-label">{{__('Location')}}</label>
                                <input type="text" name="location" id="location"
                                    class="form-control form-control-lg" placeholder="{{__('Enter Location')}}" >
                    
                            </div>
                        <!--    <div class="col">-->
                        <!--        <label for="phone" class="form-label">Head Person <span class="text-danger">*</span></label>-->
                        <!--        <input type="text" name="head_person" id="head_person" class="form-control form-control-lg"-->
                        <!--            placeholder="Enter Head Person" required >-->
                        <!--        @error('head_person')-->
                        <!--            <div class="alert text-danger">{{ $message }}</div>-->
                        <!--        @enderror-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="mb-3">-->
                        <!--    <label for="email" class="form-label">Phone <span class="text-danger">*</span></label>-->
                        <!--    <input type="text" name="phone" id="email" class="form-control form-control-lg"-->
                        <!--        placeholder="Enter Phone" >-->
                        <!--    @error('phone')-->
                        <!--        <div class="alert text-danger">{{ $message }}</div>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <div class="row mb-3 gx-3">
                            <div class="col">
                                <label for="city_id" class="form-label">{{__('Synagogues')}} <span class="text-danger">*</span></label>
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
                            <!--<div class="col">-->
                            <!--    <label for="prayer_category_id" class="form-label">Prayer Category <span class="text-danger">*</span></label>-->
                            <!--    <select name="prayer_category_id" id="prayer_category_id" class="form-select" required>-->
                            <!--        <option value="">Select</option>-->
                            <!--        @foreach ($prayerCategories as $category)-->
                            <!--        <option value="{{ $category->id }}">{{ $category->name }}</option>-->
                            <!--        @endforeach-->
                            <!--    </select>-->
                            <!--    @error('prayer_category_id')-->
                            <!--        <div class="alert text-danger">{{ $message }}</div>-->
                            <!--    @enderror-->
                            <!--</div>-->
                        </div>

                        <!--<div class="row mb-3 gx-3">-->
                        <!--    <div class="col">-->
                        <!--        <label for="days_of_session" class="form-label">Links</label>-->
                        <!--        <input type="text" name="links" id="links"-->
                        <!--            class="form-control form-control-lg" placeholder="Enter Link" >-->
                        <!--    </div>-->
                        <!--    <div class="col">-->
                        <!--        <label for="youtube_url" class="form-label">Youtube URL </label>-->
                        <!--        <input type="text" name="youtube_url" id="youtube_url" class="form-control form-control-lg"-->
                        <!--            placeholder="Enter Youtube URL" >-->

                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col mb-3">
                          <label for="logo" class="form-label">{{__('Logo')}} <span class="text-danger">*</span></label>

                            <input type="file" name="image" id="logo" class="form-control form-control-lg"
                                required>
                                 @error('image')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror

                        </div>
                        <div class="mb-3">
                            <label for="discription" class="form-label">{{__('Description')}}</label>
                            <textarea type="text" name="discription" id="discription" class="form-control form-control-lg"
                                placeholder="{{__('Enter Description (if any)')}}" ></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" value="Add User" class="btn btn-warning btn-block btn-sm" style="background-color: #FEBC06;">
                                {{__('Add Prayer Times')}}
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
