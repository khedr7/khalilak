@extends('admin.layouts.master')
@section('title', 'View Job request - Admin')
@section('maincontent')
    @component('components.breadcumb', ['fourthactive' => 'active'])
        @slot('heading')
            {{ __('View Job request') }}
        @endslot
        @slot('menu1')
            {{ __('Job request') }}
        @endslot
        @slot('menu2')
            {{ __('All Job request') }}
        @endslot
        @slot('menu3')
            {{ __('View Job request') }}
        @endslot
    @endcomponent
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="box-title">{{ __('View Job request') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <ul class="instructor">
                                <h3>User details</h3>
                                <li>
                                    @if ($show->user_img != null && $show->user_img != '')
                                        <img src="{{ asset('images/user_img/' . $show->user_img) }}" class="img-circle">
                                    @else
                                        <img src="{{ Avatar::create($item->user->fname)->toBase64() }}"
                                            class="dashboard-imgs" alt="">
                                    @endif

                                    {{-- <img src="{{ asset('images/user_img/' . $show->user_img) }}" class="img-circle" /> --}}
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
                                {{-- <li><span class="text-color">{{ __('adminstaticword.VolunteerType') }}:</span>
                                    {{ $show->type }}
                                </li> --}}
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
                                {{-- @if ($show->disabled == 1)
                                    <li><span class="text-color">{{ __('adminstaticword.Disabled') }}:</span>
                                        {{ $show->desabled }}
                                    </li>
                                @else
                                    <li><span class="text-color">{{ __('adminstaticword.Disabled') }}:</span>
                                        No
                                    </li>
                                @endif --}}
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
                                {{-- <li><span class="text-color">{{ __('adminstaticword.reason for joining Khalilk') }}:</span>
                                    {{ $show->Reason_for_joining }}
                                </li> --}}
                                <li><span class="text-color">{{ __('adminstaticword.Phone') }}:</span> {{ $show->mobile }}
                                </li>
                                <li><span class="text-color">{{ __('adminstaticword.Email') }}:</span> {{ $show->email }}
                                </li>
                                <li><span class="text-color">{{ __('adminstaticword.DateofBirth') }}:</span>
                                    {{ $show->dob }}
                                </li>
                                {{-- <li><span class="text-color">{{ __('adminstaticword.comment') }}:</span>
                                    {{ $show->detail }}</li> --}}


                                {{-- <li><span class="text-color">{{ __('adminstaticword.interview appointment date') }}:</span>
                                    {{ $show->interview_date }}
                                </li> --}}
                            </ul>
                            <ul class="instructor">
                                <h3>Request details</h3>
                                <li><span class="text-color">{{ __('adminstaticword.Title') }}:</span>
                                    {{ $findJob->title }}
                                </li>

                                <li><span class="text-color">{{ __('adminstaticword.Resume') }}:</span> <a
                                        href="{{ asset('files/findJob/' . $findJob->cv) }}"
                                        download="{{ $findJob->cv }}">{{ __('adminstaticword.Download') }} <i
                                            class="fa fa-download"></i></a></li>
                            </ul>
                        </div>

                        <form action="{{ route('requestjob.update', $findJob->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}


                            <div class="row ml-3">
                                <div class="form-group ml-4 col-md-6">
                                    <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                                    <br>
                                    <input type="checkbox" name="status" id="status" class="custom_toggle"
                                        {{ $findJob->status == 1 ? 'checked' : '' }} />
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
