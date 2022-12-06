@extends('admin.layouts.master')
@section('title', 'Edit User')
@section('maincontent')

    @component('components.breadcumb', ['thirdactive' => 'active'])
        @slot('heading')
            {{ __('Home') }}
        @endslot

        @slot('menu1')
            {{ __('Admin') }}
        @endslot

        @slot('menu2')
            {{ __(' Edit User') }}
        @endslot

        @slot('button')
            <div class="col-md-4 col-lg-4">
                <a href="{{ route('user.index') }}" class="float-right btn btn-primary-rgba mr-2"><i
                        class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
            </div>
        @endslot
    @endcomponent
    <div class="contentbar">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span></button></p>
                    @endforeach
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="box-title">{{ __('adminstaticword.Edit') }} {{ __('adminstaticword.User') }}</h5>
                    </div>
                    <div class="card-body ml-2">
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="lname">
                                            {{ __('adminstaticword.ArabicName') }}:
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ $user->lname }}" required name="lname" type="text"
                                            class="form-control"
                                            placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.ArabicName') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="user_name">
                                            {{ __('adminstaticword.UserName') }}:
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ $user->user_name }}" required name="user_name" type="text"
                                            class="form-control"
                                            placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.UserName') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile"> {{ __('adminstaticword.Mobile') }}:</label>
                                        <input value="{{ $user->mobile }}" type="text" name="mobile"
                                            placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Mobile') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">{{ __('adminstaticword.Email') }}:<sup
                                                class="text-danger">*</sup> </label>
                                        <input value="{{ $user->email }}" required type="email" name="email"
                                            placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Email') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{ __('adminstaticword.Address') }}: </label>
                                        <textarea name="address" class="form-control" rows="1" placeholder="{{ __('adminstaticword.Enter') }} adderss"
                                            value="">{{ $user->address }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-dark" for="dob">{{ __('adminstaticword.DateofBirth') }}:
                                        </label>
                                        <input value="{{ $user->dob }}" type="text" id="default-date"
                                            class="datepicker-here form-control" name="dob" placeholder="dd/mm/yyyy"
                                            aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="feather icon-calendar"></i></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-dark">{{ __('adminstaticword.Level of English') }}: <span
                                                class="text-danger">*</span></label>

                                        <select required="" name="english_level" id="english_level"
                                            class="form-control select2">
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>
                                            <option {{ $user->english_level == 'Beginner' ? 'selected' : '' }}
                                                value="Beginner">{{ __('adminstaticword.Beginner') }}</option>
                                            <option {{ $user->english_level == 'Intermediate' ? 'selected' : '' }}
                                                value="Intermediate">{{ __('adminstaticword.Intermediate') }}</option>
                                            <option {{ $user->english_level == 'Advanced' ? 'selected' : '' }}
                                                value="Advanced">{{ __('adminstaticword.Advanced') }}</option>
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="update-password">
                                                    <label for="box1">
                                                        {{ __('adminstaticword.UpdatePassword') }}:</label>
                                                    <input type="checkbox" id="myCheck" name="update_pass"
                                                        class="custom_toggle" onclick="myFunction()">
                                                </div>
                                            </div>
                                        </div>


                                        <div style="display: none" id="update-password">
                                            <div class="form-group">
                                                <label>{{ __('adminstaticword.Password') }}</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Password') }}">
                                            </div>


                                            <div class="form-group">
                                                <label>{{ __('adminstaticword.ConfirmPassword') }}</label>
                                                <input type="password" name="confirmpassword" class="form-control"
                                                    placeholder="{{ __('adminstaticword.ConfirmPassword') }}">
                                            </div>

                                        </div>

                                    </div>


                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="fname">
                                            {{ __('adminstaticword.EnglishName') }}:
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ $user->fname }}" autofocus required name="fname"
                                            type="text" class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.EnglishName') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="role">{{ __('adminstaticword.SelectRole') }}:</label>
                                        @if (Auth::User()->role == 'admin')
                                            <select class="form-control select2 role1" name="role">
                                                <option value="">{{ __('Please select role') }}</option>
                                                @foreach ($roles as $role)
                                                    <option
                                                        {{ $user->getRoleNames()->contains($role->name) ? 'selected' : '' }}
                                                        value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (Auth::User()->role == 'instructor')
                                            <select class="form-control select2 role1" name="role">
                                                <option {{ $user->role == 'user' ? 'selected' : '' }} value="user">
                                                    {{ __('adminstaticword.User') }}
                                                </option>
                                                <option {{ $user->role == 'instructor' ? 'selected' : '' }}
                                                    value="instructor">
                                                    {{ __('adminstaticword.Instructor') }}</option>
                                            </select>
                                        @endif
                                    </div>


                                    <div style="display: none;" id="rolebox1">
                                        <div class="form-group">
                                            <label
                                                for="exampleInputDetails">{{ __('adminstaticword.disabled?') }}:</label>
                                            <input {{ $user->disabled != null ? 'checked' : '' }} type="checkbox"
                                                class="custom_toggle" id="disabled_check1" name="disabled_check" />

                                            <label class="tgl-btn" data-tg-off="0" data-tg-on="1"
                                                for="disabled_check1"></label>
                                            <br>

                                            <div id="disabledbox1" style="display: none;">
                                                <div class="form-group">
                                                    <label class="text-dark" for="disabled">
                                                        {{ __('adminstaticword.Please specify') }}:<sup
                                                            class="text-danger">*</sup>
                                                    </label>
                                                    <input value="{{ $user->disabled }}" name="disabled" type="text"
                                                        class="form-control"
                                                        placeholder="{{ __('adminstaticword.Please specify') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-dark"
                                                for="exampleInputDetails">{{ __('adminstaticword.Why do you want to join Khalilk Initiative?') }}:</label>
                                            <textarea value="{{ $user->Reason_for_joining }}" name="Reason_for_joining" rows="1" class="form-control"
                                                placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} 
                                              {{ __('adminstaticword.Why do you want to join Khalilk Initiative?') }} "></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label
                                                class="text-dark">{{ __('adminstaticword.What Role do you aspire to play in Khalilk Initiative?') }}:
                                                <span class="text-danger">*</span></label>

                                            <select required="" name="type" id="type"
                                                class="form-control select2">
                                                <option value="none" selected disabled hidden>
                                                    {{ __('adminstaticword.SelectanOption') }}
                                                </option>
                                                <option {{ $user->type == 'General English teacher' ? 'selected' : '' }}
                                                    value="General English teacher">
                                                    {{ __('adminstaticword.General English teacher') }}
                                                </option>
                                                <option {{ $user->type == 'La3younak' ? 'selected' : '' }}
                                                    value="La3younak">
                                                    {{ __('adminstaticword.Volunteer for La3younak') }}
                                                </option>
                                                <option {{ $user->type == 'Health Education' ? 'selected' : '' }}
                                                    value="Health Education">
                                                    {{ __('adminstaticword.Health Education') }}
                                                </option>
                                                <option {{ $user->type == 'Photographer' ? 'selected' : '' }}
                                                    value="Photographer">
                                                    {{ __('adminstaticword.Photographer') }}
                                                </option>
                                                <option {{ $user->type == 'IT Support' ? 'selected' : '' }}
                                                    value="IT Support">
                                                    {{ __('adminstaticword.IT Support') }}
                                                </option>
                                                <option {{ $user->type == 'Marketing' ? 'selected' : '' }}
                                                    value="Marketing">
                                                    {{ __('adminstaticword.Marketing') }}
                                                </option>
                                                <option value="others">{{ __('adminstaticword.Others') }}</option>
                                            </select>
                                        </div>
                                        <div id="other_type" style="display: none;">
                                            <div class="form-group">
                                                <label class="text-dark" for="other_type">
                                                    {{ __('adminstaticword.Please specify') }}:<sup
                                                        class="text-danger">*</sup>
                                                </label>
                                                <input value="{{ $user->type }}" name="other_type" type="text"
                                                    class="form-control"
                                                    placeholder="{{ __('adminstaticword.Please specify') }}" />
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <div class="form-group">
                                        <label for="city_id">{{ __('adminstaticword.Country') }}:</label>
                                        <select id="country_id" class="form-control select2" name="country_id">
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>

                                            @foreach ($countries as $coun)
                                                <option value="{{ $coun->country_id }}"
                                                    {{ $user->country_id == $coun->country_id ? 'selected' : '' }}>
                                                    {{ $coun->nicename }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_id">{{ __('adminstaticword.State') }}:</label>
                                        <select id="upload_id" class="form-control select2" name="state_id">
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>
                                            @foreach ($states as $s)
                                                <option value="{{ $s->state_id }}"
                                                    {{ $user->state_id == $s->state_id ? 'selected' : '' }}>
                                                    {{ $s->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_id">{{ __('adminstaticword.City') }}:</label>
                                        <select id="grand" class="form-control select2" name="city_id">
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>
                                            @foreach ($cities as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ $user->city_id == $c->id ? 'selected' : '' }}>{{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="pin_code">{{ __('adminstaticword.Pincode') }}:</label>
                                        <input value="{{ $user->pin_code }}"
                                            placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Pincode') }}"
                                            type="text" name="pin_code" class="form-control">
                                    </div> --}}


                                    <div class="form-group">
                                        <label class="text-dark">{{ __('adminstaticword.Latest Obtained Degree') }}:
                                            <span class="text-danger">*</span></label>

                                        <select required="" name="latest_obtained_degree" id="latest_obtained_degree"
                                            class="form-control select2">
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>
                                            <option {{ $user->latest_obtained_degree == 'Ph.D' ? 'selected' : '' }}
                                                value="Ph.D">{{ __('adminstaticword.Ph.D') }}</option>
                                            <option {{ $user->latest_obtained_degree == 'MA' ? 'selected' : '' }}
                                                value="MA">{{ __('adminstaticword.MA') }}</option>
                                            <option {{ $user->latest_obtained_degree == 'BA' ? 'selected' : '' }}
                                                value="BA">{{ __('adminstaticword.BA') }}</option>
                                            <option
                                                {{ $user->latest_obtained_degree == 'Baccalaureate' ? 'selected' : '' }}
                                                value="Baccalaureate">{{ __('adminstaticword.Baccalaureate') }}</option>
                                            <option
                                                {{ $user->latest_obtained_degree == 'Elementary school' ? 'selected' : '' }}
                                                value="Elementary school">{{ __('adminstaticword.Elementary school') }}
                                            </option>
                                        </select>
                                        <br>
                                        <div id="degreebox" style="display: none;">
                                            <label
                                                for="exampleInputDetails">{{ __('adminstaticword.Degree completed') }}:</label>
                                            <input type="checkbox" class="custom_toggle" id="degree_completed"
                                                name="degree_completed"
                                                {{ $user->degree_completed == '1' ? 'checked' : '' }} />
                                            <label class="tgl-btn" data-tg-off="0" data-tg-on="1"
                                                for="degree_completed"></label>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-dark" for="study">
                                                {{ __('adminstaticword.Field of Study') }}:<sup
                                                    class="text-danger">*</sup>
                                            </label>
                                            <input value="{{ $user->study }}" required name="study" type="text"
                                                class="form-control"
                                                placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Field of Study') }}" />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="text-dark" for="profession">
                                            {{ __('adminstaticword.What is your current profession?') }}:<sup
                                                class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ $user->profession }}" required name="profession"
                                            type="text" class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.What is your current profession?') }}" />
                                    </div>

                                    {{-- <div class="form-group"> --}}

                                    <div class="form-group">

                                        <label for="exampleInputDetails">{{ __('adminstaticword.Blind') }}:</label>
                                        <input type="checkbox" class="custom_toggle cb113" name="blind"
                                            {{ $user->blind == '1' ? 'checked' : '' }} />

                                        <label class="tgl-btn" data-tg-off="0" data-tg-on="1" for="cb113"></label>

                                        <br>

                                        <div style="display: none;" id="blindbox1">
                                            <div class="form-group">
                                                <label
                                                    class="text-dark">{{ __('adminstaticword.Are you registered in one of the following Association?') }}:
                                                    <span class="text-danger">*</span></label>

                                                <select required="" name="association" id="association1"
                                                    class="form-control select2">
                                                    <option value="none" selected disabled hidden>
                                                        {{ __('adminstaticword.SelectanOption') }}
                                                    </option>
                                                    <option
                                                        {{ $user->association == 'Al Weam Society for Blind Females' ? 'selected' : '' }}
                                                        value="Al_Weam_Society_for_Blind_Females">
                                                        {{ __('adminstaticword.Al Weam Society for Blind Females') }}
                                                    </option>
                                                    <option {{ $user->association == 'Blind Society' ? 'selected' : '' }}
                                                        value="Blind_Society">{{ __('adminstaticword.BlindSociety') }}
                                                    </option>
                                                    <option
                                                        {{ $user->association != 'Blind Society' && $user->association != 'Al Weam Society for Blind Females' ? 'selected' : '' }}
                                                        value="others">{{ __('adminstaticword.Others') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="bundlebox1" style="display: none;">
                                            <div class="form-group">
                                                <label class="text-dark" for="other_association">
                                                    {{ __('adminstaticword.Please specify') }}:<sup
                                                        class="text-danger">*</sup>
                                                </label>
                                                <input value="{{ old('other_association') }}" name="other_association"
                                                    type="text" class="form-control"
                                                    placeholder="{{ __('adminstaticword.Please specify') }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                                        <small class="text-muted"><i class="fa fa-question-circle"></i>
                                            {{ __('adminstaticword.Recommendedsize') }} (410 x 410px)</small>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                    name="user_img" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label"
                                                    for="inputGroupFile01">{{ __('Choose file') }}</label>
                                            </div>
                                        </div>
                                        @if ($user->user_img != null || $user->user_img != '')
                                            <div class="edit-user-img">
                                                <img src="{{ url('/images/user_img/' . $user->user_img) }}"
                                                    alt="User Image" class="img-responsive image_size">
                                            </div>
                                        @else
                                            <div class="edit-user-img">
                                                <img src="{{ asset('images/default/user.jpg') }}" alt="User Image"
                                                    class="img-responsive img-circle">
                                            </div>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="detail">{{ __('adminstaticword.Detail') }}:<sup
                                        class="text-danger">*</sup></label>
                                <textarea id="detail" name="detail" class="form-control" rows="5"
                                    placeholder="{{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Detail') }}" value="">{{ $user->detail }}</textarea>
                            </div>
                    </div>

                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="fb_url">
                                    {{ __('adminstaticword.FacebookUrl') }}:
                                </label>
                                <input autofocus name="fb_url" value="{{ $user->fb_url }}" type="text"
                                    class="form-control" placeholder="Facebook.com/" />
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube_url">
                                    {{ __('adminstaticword.YoutubeUrl') }}:
                                </label>
                                <input autofocus name="youtube_url" value="{{ $user->youtube_url }}" type="text"
                                    class="form-control" placeholder="youtube.com/" />

                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">

                            <div class="form-group">
                                <label for="twitter_url">
                                    {{ __('adminstaticword.TwitterUrl') }}:
                                </label>
                                <input autofocus name="twitter_url" value="{{ $user->twitter_url }}" type="text"
                                    class="form-control" placeholder="Twitter.com/" />
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">

                            <div class="form-group">
                                <label for="linkedin_url">
                                    {{ __('adminstaticword.LinkedInUrl') }}:
                                </label>
                                <input autofocus name="linkedin_url" value="{{ $user->linkedin_url }}" type="text"
                                    class="form-control" placeholder="Linkedin.com/" />
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputDetails">{{ __('adminstaticword.Verified') }}:<sup
                                        class="redstar text-danger">*</sup></label><br>
                                <input id="verified" type="checkbox" class="custom_toggle" name="verified"
                                    {{ $user->email_verified_at != null ? 'checked' : '' }} />


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:<sup
                                        class="text-danger">*</sup></label><br>
                                <input type="checkbox" class="custom_toggle" name="status"
                                    {{ $user->status == '1' ? 'checked' : '' }} />

                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="reset" class="btn btn-danger-rgba"><i class="fa fa-ban"></i>
                            {{ __('Reset') }}</button>
                        <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                            {{ __('Update') }}</button>
                    </div>

                    <div class="clear-both"></div>

                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')


    <script>
        (function($) {
            "use strict";


            $(function() {
                $("#dob,#doa").datepicker({
                    changeYear: true,
                    yearRange: "-100:+0",
                    dateFormat: 'yy/mm/dd',
                });
            });




            $('#married_status').change(function() {

                if ($(this).val() == 'Married') {
                    $('#doaboxxx').show();
                } else {
                    $('#doaboxxx').hide();
                }
            });

            $(function() {
                var urlLike =
                    '{{ url('
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              country / dropdown ') }}';
                $('#country_id').change(function() {
                    var up = $('#upload_id').empty();
                    var cat_id = $(this).val();
                    if (cat_id) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: urlLike,
                            data: {
                                catId: cat_id
                            },
                            success: function(data) {
                                console.log(data);
                                up.append('<option value="0">Please Choose</option>');
                                $.each(data, function(id, title) {
                                    up.append($('<option>', {
                                        value: id,
                                        text: title
                                    }));
                                });
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest);
                            }
                        });
                    }
                });
            });


            $(function() {
                var urlLike =
                    '{{ url('
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      country / gcity ') }}';
                $('#upload_id').change(function() {
                    var up = $('#grand').empty();
                    var cat_id = $(this).val();
                    if (cat_id) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            type: "GET",
                            url: urlLike,
                            data: {
                                catId: cat_id
                            },
                            success: function(data) {
                                console.log(data);
                                up.append(
                                    '<option value="0">Please Choose</option>'
                                );
                                $.each(data, function(id, title) {
                                    up.append($('<option>', {
                                        value: id,
                                        text: title
                                    }));
                                });
                            },
                            error: function(XMLHttpRequest, textStatus,
                                errorThrown) {
                                console.log(XMLHttpRequest);
                            }
                        });
                    }
                });
            });

        })(jQuery);
    </script>
    <script>
        (function($) {
            "use strict";
            $(function() {
                $('#myCheck').change(function() {
                    if ($('#myCheck').is(':checked')) {
                        $('#update-password').show('fast');
                    } else {
                        $('#update-password').hide('fast');
                    }
                });


                $('#latest_obtained_degree').on('change', function() {
                    console.log("khedr1");
                    var opt = $(this).val();
                    if (opt != 'none') {
                        $('#degreebox').show();
                    } else
                        $('#degreebox').hide();
                });

                $('.cb113').on('change', function() {
                    // console.log("khedr1");

                    if ($('.cb113').is(':checked')) {
                        // console.log('zena');


                        $('#association1').on('change', function() {
                            var opt = $(this).val();

                            if (opt == 'others') {
                                $('#bundlebox1').show();
                            } else
                                $('#bundlebox1').hide();
                        });

                        $('#blindbox1').show('fast');
                        $('#priceMain').prop('required', 'required');
                    } else {
                        $('#bundlebox1').hide();

                        $('#blindbox1').hide('fast');

                        $('#priceMain').removeAttr('required');
                    }

                });


            });

        })(jQuery);
    </script>
    <script>
        (function($) {
            "use strict";

            $('.role1').on('change', (function() {
                console.log("khedr1");
                var opt = $(this).val();

                if (opt == 'Volunteer') {
                    $('#rolebox1').show();

                    $('#disabled_check1').on('change', function() {

                        if ($('#disabled_check1').is(':checked')) {
                            $('#disabledbox1').show();
                        } else
                            $('#disabledbox1').hide();
                    });

                    $('#type').on('change', function() {
                        var opt = $(this).val();

                        if (opt == 'others') {
                            $('#other_type').show();
                        } else
                            $('#other_type').hide();
                    });
                } else {
                    $('#disabledbox1').hide();

                    $('#rolebox1').hide('fast');

                    $('#priceMain').removeAttr('required');
                }

            }));


        })(jQuery);
    </script>


@endsection
