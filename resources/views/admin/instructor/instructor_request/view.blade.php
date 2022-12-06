@extends('admin.layouts.master')
@if ($show->type == 'General English teacher')
    @section('title', 'View Instructor - Admin')
@else
    @section('title', 'View Volunteer - Admin')
@endif
@section('maincontent')
@component('components.breadcumb', ['fourthactive' => 'active'])
    @slot('heading')
        @if ($show->type == 'General English teacher')
            {{ __('View Instructor') }}
        @else
            {{ __('View Volunteer') }}
        @endif
    @endslot

    @slot('menu1')
        @if ($show->type == 'General English teacher')
            {{ __('Instructor') }}
        @else
            {{ __('Volunteer') }}
        @endif
    @endslot
    @slot('menu2')
        @if ($show->type == 'General English teacher')
            {{ __('all Instructor') }}
        @else
            {{ __('all Volunteer') }}
        @endif
    @endslot
    @slot('menu3')
        @if ($show->type == 'General English teacher')
            {{ __('View Instructor') }}
        @else
            {{ __('View Volunteer') }}
        @endif
    @endslot
@endcomponent
<div class="contentbar">
    <!-- Start row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">{{ __('View Instructor') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group col-md-12">
                        <ul class="instructor">
                            <li>
                                @if ($instructor->image != null)
                                <img src="{{ asset('images/instructor/' . $instructor->image) }}" class="img-circle" />
                                @else
                                <img src="{{ Avatar::create($show->fname)->toBase64() }}"
                                class="dashboard-imgs" alt="">
                                @endif
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.EnglishName') }}:</span>
                                {{ $show->fname }}</li>
                            <li><span class="text-color">{{ __('adminstaticword.ArabicName') }}:</span>
                                {{ $show->lname }} </li>
                            @if ($show->user_name != null)
                                <li><span class="text-color">{{ __('adminstaticword.UserName') }}:</span>
                                    {{ $show->user_name }} </li>
                                <li><span class="text-color">{{ __('adminstaticword.Role') }}:</span>
                                    {{ $show->role }}
                                </li>
                            @else
                                <li><span class="text-color">{{ __('adminstaticword.UserName') }}:</span>
                                    {{ __('adminstaticword.No user name') }} </li>
                                <li><span class="text-color">{{ __('adminstaticword.Role') }}:</span>
                                    {{ __('adminstaticword.NoRole') }}
                                </li>
                            @endif
                            <li><span class="text-color">{{ __('adminstaticword.VolunteerType') }}:</span>
                                {{ $show->type }}
                            </li>
                            @if ($show->blind == 1)
                                <li><span class="text-color">{{ __('adminstaticword.Blind') }}:</span>
                                    Yes
                                </li>
                                <li><span class="text-color">{{ __('adminstaticword.Association') }}:</span>
                                    {{ $show->Association }}
                                </li>
                            @else
                                <li><span class="text-color">{{ __('adminstaticword.Blind') }}:</span>
                                    No
                                </li>
                            @endif
                            @if ($show->disabled == 1)
                                <li><span class="text-color">{{ __('adminstaticword.Disabled') }}:</span>
                                    {{ $show->desabled }}
                                </li>
                            @else
                                <li><span class="text-color">{{ __('adminstaticword.Disabled') }}:</span>
                                    No
                                </li>
                            @endif
                            <li><span class="text-color">{{ __('adminstaticword.Latest Obtained Degree') }}:</span>
                                {{ $show->latest_obtained_degree }} (
                                @if ($show->degree_completed == 1)
                                    {{ __('adminstaticword.Degreeiscompleted') }}
                                @else
                                    {{ __('adminstaticword.Degreeisnotcompleted') }} )
                                @endif
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.Study') }}:</span>
                                {{ $show->study }}
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.Profession') }}:</span>
                                {{ $show->profession }}
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.reason for joining Khalilk') }}:</span>
                                {{ $show->Reason_for_joining }}
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.Phone') }}:</span> {{ $show->mobile }}
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.Email') }}:</span> {{ $show->email }}
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.DateofBirth') }}:</span>
                                {{ $show->dob }}
                            </li>
                            <li><span class="text-color">{{ __('adminstaticword.comment') }}:</span>
                                {{ $show->detail }}</li>
                            @if ($show->type == 'General English teacher')
                                <li><span class="text-color">{{ __('adminstaticword.Resume') }}:</span> <a
                                        href="{{ asset('files/instructor/' . $show->file) }}"
                                        download="{{ $show->file }}">{{ __('adminstaticword.Download') }} <i
                                            class="fa fa-download"></i></a></li>
                                <li><span
                                        class="text-color">{{ __('adminstaticword.interview appointment date') }}:</span>
                                    {{ $show->interview_date }}
                                </li>
                            @endif
                        </ul>
                    </div>

                    <form action="{{ route('requestinstructor.update', $instructor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group col-md-12">
                            <input type="hidden" value="{{ $instructor->user_id }}" name="user_id"
                                class="form-control">
                            @if ($show->type == 'General English teacher')
                                <input type="hidden" value="instructor" name="role" class="form-control">
                            @else
                                <input type="hidden" value="Volunteer" name="role" class="form-control">
                            @endif
                            {{-- <input type="hidden" value="{{ $show->mobile }}" name="mobile" class="form-control"> --}}
                            {{-- <input type="hidden" value="{{ $show->detail }}" name="detail" class="form-control"> --}}
                            {{-- <input type="hidden" value="{{ $show->image }}" name="image" class="form-control"> --}}
                            {{-- sending random password digit to the user --}}
                            {{-- <input type="hidden" value="{{ mt_rand(1, 999999) }}" name="password"
                                    class="form-control"> --}}
                        </div>
                        {{-- 
                            @if ($show->user_name == null)
                                <div class="row ml-3">
                                    <div class="form-group ml-4 col-md-4">
                                        <label class="text-dark" for="user_name">
                                            {{ __('adminstaticword.UserName') }}:<sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ old('user_name') }}" autofocus required name="user_name"
                                            type="text" class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.UserName') }}" />
                                    </div>
                                </div>
                            @endif --}}




                        <div class="row ml-3">
                            <div class="form-group ml-4 col-md-6">
                                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                                <br>
                                <input type="checkbox" name="status" id="status" class="custom_toggle"
                                    {{ $instructor->status == 1 ? 'checked' : '' }} />
                                {{-- <input type="hidden" name="status" value="{{ $show->status }}" id="c33"> --}}
                                <label class="tgl-btn" data-tg-off="0" data-tg-on="1" for="status"></label>
                            </div>
                        </div>






                        <div class="row ml-3">
                            <div class="form-group ml-4  col-md-6">
                                <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i>
                                    {{ __('Reset') }}</button>
                                <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                                    {{ __('Update') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>

@endsection
