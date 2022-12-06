@extends('admin.layouts.master')
@section('title', 'Create a new student')
@section('breadcum')
    @component('components.breadcumb', ['secondaryactive' => 'active'])
        @slot('heading')
            {{ __('Student') }}
        @endslot
        @slot('menu1')
            {{ __('Student') }}
        @endslot
        @slot('button')
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <a href="{{ route('allusers.index') }}" class="float-right btn btn-primary-rgba mr-2"><i
                            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
                </div>
            </div>
        @endslot
    @endcomponent
    <div class="contentbar">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="box-tittle">{{ __('adminstaticword.Add') }} {{ __('Student') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="fname">
                                            {{ __('adminstaticword.EnglishName') }}:<sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ old('fname') }}" autofocus required name="fname" type="text"
                                            class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.EnglishName') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label class="text-dark" for="user_name">
                                            {{ __('adminstaticword.UserName') }}:<sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ old('user_name') }}" autofocus required name="user_name"
                                            type="text" class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.UserName') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="mobile">{{ __('adminstaticword.Mobile') }}: <sup
                                                class="text-danger">*</sup></label>
                                        <input value="{{ old('mobile') }}" required type="text" name="mobile"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Mobile') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark"
                                            for="exampleInputDetails">{{ __('adminstaticword.Address') }}:</label>
                                        <textarea name="address" rows="1" class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} address"></textarea>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="text-dark" for="city_id">{{ __('adminstaticword.Country') }}:
                                        </label>
                                        <select id="country_id" class="form-control select2" name="country_id">
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.Please') }}
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>
                                            @foreach ($countries as $coun)
                                                <option value="{{ $coun->country_id }}">{{ $coun->nicename }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="state_id">{{ __('adminstaticword.State') }}: </label>
                                        <select id="upload_id" class="form-control select2" name="state_id">
                                            <option value="">{{ __('Please Select an Option') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="city_id">{{ __('adminstaticword.City') }}: </label>
                                        <select id="grand" class="form-control select2" name="city_id">
                                            <option value="">{{ __('Please Select an Option') }}
                                            </option>
                                        </select>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label class="text-dark"
                                            for="pin_code">{{ __('adminstaticword.Pincode') }}:</sup></label>
                                        <input value="{{ old('pin_code') }}"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} pincode"
                                            type="text" name="pin_code" class="form-control">
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="text-dark" for="dob">{{ __('adminstaticword.DateofBirth') }}:
                                        </label>
                                        <input value="{{ old('dob') }}" type="text" id="default-date"
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
                                            <option value="Beginner">{{ __('adminstaticword.Beginner') }}</option>
                                            <option value="Intermediate">{{ __('adminstaticword.Intermediate') }}</option>
                                            <option value="Advanced">{{ __('adminstaticword.Advanced') }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputDetails">{{ __('adminstaticword.Blind') }}:</label>
                                        <input type="checkbox" class="custom_toggle" id="cb111" name="blind" />

                                        <label class="tgl-btn" data-tg-off="0" data-tg-on="1" for="cb111"></label>

                                        <br>

                                        <div style="display: none;" id="blindbox">
                                            <div class="form-group">
                                                <label
                                                    class="text-dark">{{ __('adminstaticword.Are you registered in one of the following Association?') }}:
                                                    <span class="text-danger">*</span></label>

                                                <select required="" name="association" id="association"
                                                    class="form-control select2">
                                                    <option value="none" selected disabled hidden>
                                                        {{ __('adminstaticword.SelectanOption') }}
                                                    </option>
                                                    <option value="Al_Weam_Society_for_Blind_Females">
                                                        {{ __('adminstaticword.Al Weam Society for Blind Females') }}
                                                    </option>
                                                    <option value="Blind_Society">{{ __('adminstaticword.BlindSociety') }}
                                                    </option>
                                                    <option value="others">{{ __('adminstaticword.Others') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="bundlebox" style="display: none;">
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


                                    {{-- <div class="form-group">
                                        <label class="text-dark" for="fb_url">
                                            {{ __('adminstaticword.FacebookUrl') }}:
                                        </label>
                                        <input autofocus name="fb_url" type="text" class="form-control"
                                            placeholder="https://facebook.com" />
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="youtube_url">
                                            {{ __('adminstaticword.YoutubeUrl') }}:
                                        </label>
                                        <input autofocus name="youtube_url" type="text" class="form-control"
                                            placeholder="https://youtube.com" />
                                    </div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="lname">
                                            {{ __('adminstaticword.ArabicName') }}:<sup class="text-danger">*</sup>
                                        </label>
                                        <input value="{{ old('lname') }}" required name="lname" type="text"
                                            class="form-control"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.ArabicName') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="mobile">{{ __('adminstaticword.Email') }}: <sup
                                                class="text-danger">*</sup></label>
                                        <input value="{{ old('email') }}" required type="email" name="email"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Email') }}"
                                            class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="text-dark" for="mobile">{{ __('adminstaticword.Password') }}:
                                            <sup class="text-danger">*</sup> </label>
                                        <input required type="password" name="password"
                                            placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Password') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="role">{{ __('adminstaticword.SelectRole') }}:
                                            <sup class="text-danger">*</sup></label>
                                        <select class="form-control select2" name="role" required>
                                            <option value="none" selected disabled hidden>
                                                {{ __('adminstaticword.Please') }}
                                                {{ __('adminstaticword.SelectanOption') }}
                                            </option>
                                            <option value="user">{{ __('adminstaticword.User') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark"
                                            for="exampleInputSlug">{{ __('adminstaticword.Image') }}:
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="user_img" class="custom-file-input"
                                                    id="user_img" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label"
                                                    for="inputGroupFile01">{{ __('Choose file') }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-dark">{{ __('adminstaticword.Latest Obtained Degree') }}:
                                                <span class="text-danger">*</span></label>

                                            <select required="" name="latest_obtained_degree"
                                                id="latest_obtained_degree" class="form-control select2">
                                                <option value="none" selected disabled hidden>
                                                    {{ __('adminstaticword.SelectanOption') }}
                                                </option>
                                                <option value="Ph.D">{{ __('adminstaticword.Ph.D') }}</option>
                                                <option value="MA">{{ __('adminstaticword.MA') }}</option>
                                                <option value="BA">{{ __('adminstaticword.BA') }}</option>
                                                <option value="Baccalaureate">{{ __('adminstaticword.Baccalaureate') }}
                                                </option>
                                                <option value="Elementary school">
                                                    {{ __('adminstaticword.Elementary school') }}</option>
                                            </select>
                                            <br>
                                            <div id="degreebox" style="display: none;">
                                                <label
                                                    for="exampleInputDetails">{{ __('adminstaticword.Degree completed') }}:</label>
                                                <input type="checkbox" class="custom_toggle" id="degree_completed"
                                                    name="degree_completed" />
                                                <label class="tgl-btn" data-tg-off="0" data-tg-on="1"
                                                    for="degree_completed"></label>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-dark" for="study">
                                                    {{ __('adminstaticword.Field of Study') }}:<sup
                                                        class="text-danger">*</sup>
                                                </label>
                                                <input value="{{ old('study') }}" required name="study"
                                                    type="text" class="form-control"
                                                    placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Field of Study') }}" />
                                            </div>

                                            <div class="form-group">
                                                <label class="text-dark" for="profession">
                                                    {{ __('adminstaticword.What is your current profession?') }}:<sup
                                                        class="text-danger">*</sup>
                                                </label>
                                                <input value="{{ old('profession') }}" required name="profession"
                                                    type="text" class="form-control"
                                                    placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.What is your current profession?') }}" />
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label class="text-dark" for="twitter_url">
                                                {{ __('adminstaticword.TwitterUrl') }}:
                                            </label>
                                            <input autofocus name="twitter_url" type="text" class="form-control"
                                                placeholder="https://twitter.com" />
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark" for="linkedin_url">
                                                {{ __('adminstaticword.LinkedInUrl') }}:
                                            </label>
                                            <input autofocus name="linkedin_url" type="text" class="form-control"
                                                placeholder="https://linkedin.com" />
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-dark"
                                    for="exampleInputDetails">{{ __('adminstaticword.Leave a comment') }}:</label>
                                <textarea id="detail" name="detail" rows="3" class="form-control"
                                    placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Leave a comment') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}</label><br>
                                <input id="status_toggle" type="checkbox" class="custom_toggle" name="status"
                                    checked />

                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger-rgba"><i class="fa fa-ban"></i>
                                    {{ __('Reset') }}</button>
                                <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                                    {{ __('Create') }}</button>
                            </div>

                        </form>
                        <div class="clear-both"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";

            $('#cb111').on('change', function() {
                console.log('zena');

                if ($('#cb111').is(':checked')) {

                    $('#association').on('change', function() {
                        var opt = $(this).val();

                        if (opt == 'others') {
                            $('#bundlebox').show();
                        } else
                            $('#bundlebox').hide();
                    });
                    $('#blindbox').show('fast');

                    $('#priceMain').prop('required', 'required');

                } else {
                    $('#bundlebox').hide();

                    $('#blindbox').hide('fast');

                    $('#priceMain').removeAttr('required');
                }

            });


            $('#latest_obtained_degree').on('change', function() {
                var opt = $(this).val();
                if (opt != 'none') {
                    $('#degreebox').show();
                } else
                    $('#degreebox').hide();
            });

            $('#married_status').change(function() {

                if ($(this).val() == 'Married') {
                    $('#doaboxxx').show();
                } else {
                    $('#doaboxxx').hide();
                }
            });

            $(function() {
                $("#dob,#doa").datepicker({
                    changeYear: true,
                    yearRange: "-100:+0",
                    dateFormat: 'yy/mm/dd',
                });
            });
            $(function() {
                $('#country_id').change(function() {
                    var up = $('#upload_id').empty();
                    var cat_id = $(this).val();

                    if (cat_id) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: @json(url('country/dropdown')),
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

                $('#upload_id').change(function() {
                    var up = $('#grand').empty();
                    var cat_id = $(this).val();
                    if (cat_id) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: @json(url('country/gcity')),
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
        })(jQuery);
    </script>

@endsection
