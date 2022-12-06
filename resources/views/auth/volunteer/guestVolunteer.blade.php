@extends('theme.master')
@section('title', 'Volunteer form')

@section('content')

    @include('admin.message')

    <!-- Signup start-->
    <section id="signup" class="signup-block-main-block register-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="box-tittle">{{ __('frontstaticword.JoinUsAsVolunteer') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('allvolunteer.volunteerRequestStore') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark" for="fname">
                                                {{ __('adminstaticword.EnglishName') }}:<sup class="text-danger">*</sup>
                                            </label>
                                            <input value="{{ old('fname') }}" autofocus required name="fname"
                                                type="text" class="form-control"
                                                placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.EnglishName') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="text-dark"
                                                for="exampleInputDetails">{{ __('adminstaticword.Address') }}:</label>
                                            <textarea name="address" rows="1" class="form-control"
                                                placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} address"></textarea>
                                        </div>
                                        <div class="form-group">
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
                                            <label class="text-dark" for="state_id">{{ __('adminstaticword.State') }}:
                                            </label>
                                            <select id="upload_id" class="form-control select2" name="state_id">
                                                <option value="">{{ __('Please Select an Option') }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark" for="city_id">{{ __('adminstaticword.City') }}:
                                            </label>
                                            <select id="grand" class="form-control select2" name="city_id">
                                                <option value="">{{ __('Please Select an Option') }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark"
                                                for="dob">{{ __('adminstaticword.DateofBirth') }}:
                                            </label>
                                            <input value="{{ old('dob') }}" type="date" id="default-date"
                                                class="datepicker-here form-control" name="dob" placeholder="dd/mm/yyyy"
                                                aria-describedby="basic-addon2" />
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
                                                <option value="Intermediate">{{ __('adminstaticword.Intermediate') }}
                                                </option>
                                                <option value="Advanced">{{ __('adminstaticword.Advanced') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">

                                            <label for="exampleInputDetails">{{ __('adminstaticword.Blind') }}?</label>
                                            <input type="checkbox" class="custom_toggle" id="cb111" name="blind" />

                                            <label class="tgl-btn" data-tg-off="0" data-tg-on="1" for="cb111"></label>

                                            <br>

                                            {{-- <div style="display: none;" id="blindbox"> --}}
                                            <div class="form-group">
                                                <label class="text-dark">if blind,
                                                    {{ __('adminstaticword.Are you registered in one of the following Association?') }}:
                                                    <span class="text-danger">*</span></label>

                                                <select required="" name="association" id="association"
                                                    class="form-control select2">
                                                    <option value="none" selected disabled hidden>
                                                        {{ __('adminstaticword.SelectanOption') }}
                                                    </option>
                                                    <option value="Al_Weam_Society_for_Blind_Females">
                                                        {{ __('adminstaticword.Al Weam Society for Blind Females') }}
                                                    </option>
                                                    <option value="Blind_Society">
                                                        {{ __('adminstaticword.BlindSociety') }}
                                                    </option>
                                                    <option value="others">{{ __('adminstaticword.Others') }}</option>
                                                </select>
                                            </div>
                                            {{-- </div> --}}

                                            {{-- <div id="bundlebox" style="display: none;"> --}}
                                            <div class="form-group">
                                                <label class="text-dark" for="other_association"> if others,
                                                    {{ __('adminstaticword.Please specify') }}:<sup
                                                        class="text-danger">*</sup>
                                                </label>
                                                <input value="{{ old('other_association') }}" name="other_association"
                                                    type="text" class="form-control"
                                                    placeholder="{{ __('adminstaticword.Please specify') }}" />
                                            </div>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="exampleInputDetails">{{ __('adminstaticword.disabled?') }}:</label>
                                            <input type="checkbox" class="custom_toggle" id="disabled_check"
                                                name="disabled_check" />

                                            <label class="tgl-btn" data-tg-off="0" data-tg-on="1"
                                                for="disabled_check"></label>
                                            <br>

                                            {{-- <div id="disabledbox" style="display: none;"> --}}
                                            <div class="form-group">
                                                <label class="text-dark" for="disabled">if disabled,
                                                    {{ __('adminstaticword.Please specify') }}:<sup
                                                        class="text-danger">*</sup>
                                                </label>
                                                <input value="{{ old('disabled') }}" name="disabled" type="text"
                                                    class="form-control"
                                                    placeholder="{{ __('adminstaticword.Please specify') }}" />
                                            </div>
                                            {{-- </div> --}}
                                        </div>
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
                                            <label class="text-dark" for="mobile">{{ __('adminstaticword.Email') }}:
                                                <sup class="text-danger">*</sup></label>
                                            <input value="{{ old('email') }}" required type="email" name="email"
                                                placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Email') }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-dark" for="mobile">{{ __('adminstaticword.Mobile') }}:
                                                <sup class="text-danger">*</sup></label>
                                            <input value="{{ old('mobile') }}" required type="text" name="mobile"
                                                placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Mobile') }}"
                                                class="form-control">
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
                                                <label
                                                    class="text-dark">{{ __('adminstaticword.Latest Obtained Degree') }}:
                                                    <span class="text-danger">*</span></label>

                                                <select required="" name="latest_obtained_degree"
                                                    id="latest_obtained_degree" class="form-control select2">
                                                    <option value="none" selected disabled hidden>
                                                        {{ __('adminstaticword.SelectanOption') }}
                                                    </option>
                                                    <option value="Ph.D">{{ __('adminstaticword.Ph.D') }}</option>
                                                    <option value="MA">{{ __('adminstaticword.MA') }}</option>
                                                    <option value="BA">{{ __('adminstaticword.BA') }}</option>
                                                    <option value="Baccalaureate">
                                                        {{ __('adminstaticword.Baccalaureate') }}
                                                    </option>
                                                    <option value="Elementary school">
                                                        {{ __('adminstaticword.Elementary school') }}</option>
                                                </select>
                                                <br>
                                                {{-- <div id="degreebox" style="display: none;"> --}}
                                                <label
                                                    for="exampleInputDetails">{{ __('adminstaticword.Degree completed') }}?</label>
                                                <input type="checkbox" class="custom_toggle" id="degree_completed"
                                                    name="degree_completed" />
                                                <label class="tgl-btn" data-tg-off="0" data-tg-on="1"
                                                    for="degree_completed"></label>
                                                {{-- </div> --}}

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
                                                <div class="form-group">
                                                    <label class="text-dark"
                                                        for="exampleInputDetails">{{ __('adminstaticword.Why do you want to join Khalilk Initiative?') }}:</label>
                                                    <textarea name="Reason_for_joining" rows="1" class="form-control"
                                                        placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Why do you want to join Khalilk Initiative?') }} "></textarea>
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
                                                        <option value="General English teacher">
                                                            {{ __('adminstaticword.General English teacher') }}
                                                        </option>
                                                        <option value="La3younak">
                                                            {{ __('adminstaticword.Volunteer for La3younak') }}
                                                        </option>
                                                        <option value="Health Education">
                                                            {{ __('adminstaticword.Health Education') }}
                                                        </option>
                                                        <option value="Photographer">
                                                            {{ __('adminstaticword.Photographer') }}
                                                        </option>
                                                        <option value="IT Support">
                                                            {{ __('adminstaticword.IT Support') }}
                                                        </option>
                                                        <option value="Marketing">
                                                            {{ __('adminstaticword.Marketing') }}
                                                        </option>
                                                        <option value="others">{{ __('adminstaticword.Others') }}</option>
                                                    </select>
                                                </div>
                                                {{-- <div id="other_type" style="display: none;"> --}}
                                                <div class="form-group">
                                                    <label class="text-dark" for="other_type">If others,
                                                        {{ __('adminstaticword.Please specify') }}:<sup
                                                            class="text-danger">*</sup>
                                                    </label>
                                                    <input value="{{ old('other_type') }}" name="other_type"
                                                        type="text" class="form-control"
                                                        placeholder="{{ __('adminstaticword.Please specify') }}" />
                                                </div>
                                                {{-- </div> --}}
                                            </div>
                                            <div class="form-group">
                                                <label class="text-dark" for="interview_date">if English
                                                    teacher,{{ __('frontstaticword.Book an appointment for interview') }}:
                                                </label>
                                                <input value="{{ old('interview_date') }}" type="date"
                                                    id="default-date" class="datepicker-here form-control"
                                                    name="interview_date" placeholder="dd/mm/yyyy"
                                                    aria-describedby="basic-addon2" />
                                                <label class="text-dark" for="exampleInputSlug">if English
                                                    teacher, your {{ __('adminstaticword.CV') }}:
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                            id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input"
                                                            id="file" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark"
                                        for="exampleInputDetails">{{ __('adminstaticword.Leave a comment') }}:</label>
                                    <textarea id="detail" name="detail" rows="3" class="form-control"
                                        placeholder="{{ __('adminstaticword.Please') }} {{ __('adminstaticword.Enter') }} {{ __('adminstaticword.Leave a comment') }}"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}</label><br>
                                    <input id="status_toggle" type="checkbox" class="custom_toggle" name="status"
                                        checked />
                                </div> --}}
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                                        {{ __('Reset') }}</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                        {{ __('send') }}</button>
                                </div>

                            </form>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup end-->

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

            $('#disabled_check').on('change', function() {

                if ($('#disabled_check').is(':checked')) {
                    $('#disabledbox').show();
                } else
                    $('#disabledbox').hide();
            });

            $('#type').on('change', function() {
                var opt = $(this).val();

                if (opt == 'others') {
                    $('#other_type').show();
                } else
                    $('#other_type').hide();
            });

            $('#married_status').change(function() {

                if ($(this).val() == 'Married') {
                    $('#doaboxxx').show();
                } else {
                    $('#doaboxxx').hide();
                }
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
