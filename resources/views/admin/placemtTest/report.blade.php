@extends('admin.layouts.master')
@section('title', 'Report')
@section('maincontent')
    @component('components.breadcumb', ['secondaryactive' => 'active'])
        @slot('heading')
            {{ __('Report') }}
        @endslot

        @slot('menu1')
            {{ __('Report') }}
        @endslot
    @endcomponent

    <div class="contentbar">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('All Report') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Test') }}</th>
                                        <th>{{ __('General English Mark') }}</th>
                                        <th>{{ __('Listening Mark') }}</th>
                                        <th>{{ __('Reading Mark') }}</th>
                                        <th>{{ __('Speaking Mark') }}</th>
                                        <th>{{ __('Final Mark') }}</th>
                                        <th>{{ __('adminstaticword.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if ($ans) --}}
                                    @foreach ($reports as $key => $report)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>user name : {{ $report->user->user_name }} <br>
                                                email : {{ $report->user->email }}</td>
                                            <td>{{ $report->quiz->title }}</td>
                                            <td>{{ $report->general_mark }}</td>
                                            <td>{{ $report->reading_mark }}</td>
                                            <td>{{ $report->listening_mark }}</td>

                                            <td>
                                                @if ($report->speaking_mark == null)
                                                    --
                                                @else
                                                    {{ $report->speaking_mark }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($report->final_mark == null)
                                                    --
                                                @else
                                                    {{ $report->final_mark }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-round btn-outline-primary" type="button"
                                                        id="CustomdropdownMenuButton1" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"><i
                                                            class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                                        {{-- @can('course-chapter.edit') --}}
                                                        <a data-toggle="modal" data-target="#myModalS{{ $report->id }}"
                                                            class="dropdown-item" href="#"><i
                                                                class="feather icon-edit mr-2"></i>Add Speaking Mark</a>
                                                        <a data-toggle="modal" data-target="#myModalF{{ $report->id }}"
                                                            class="dropdown-item" href="#"><i
                                                                class="feather icon-edit mr-2"></i>Add Final Mark</a>
                                                        {{-- @endcan --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- @endif --}}
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->

        {{-- ---------------add Speaking mark----------- --}}

        <div class="modal fade" id="myModalS{{ $report->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">
                            <b>Add Speaking Mark</b>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="box box-primary">
                        <div class="panel panel-sum">
                            <div class="modal-body">
                                <form id="demo-form2" method="post"
                                    action="{{ url('placement-test-report/' . $report->id) }}" data-parsley-validate
                                    class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}


                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleInputTit1e">{{ __('adminstaticword.Select') }}
                                                {{ __('adminstaticword.Speaking Mark') }}</label>
                                            <select name="speaking_mark" class="form-control select2">
                                                <option value="Top Notch Fundamentals">
                                                    {{ __('Top Notch Fundamentals') }}
                                                </option>
                                                <option value="Top Notch 1">
                                                    {{ __('Top Notch 1') }}
                                                </option>
                                                <option value="Top Notch 2">
                                                    {{ __('Top Notch 2') }}
                                                </option>
                                                <option value="Top Notch 3">
                                                    {{ __('Top Notch 3') }}
                                                </option>
                                                <option value="Summit 1">
                                                    {{ __('Summit 1') }}
                                                </option>
                                                <option value="Summit 2">
                                                    {{ __('Summit 2') }}
                                                </option>
                                                <option value="Beyond Summit 2">
                                                    {{ __('Beyond Summit 2') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger-rgba"><i class="fa fa-ban"></i>
                                            Reset</button>
                                        <button type="submit" class="btn btn-primary-rgba"><i
                                                class="fa fa-check-circle"></i>
                                            Create</button>
                                    </div>
                                    <div class="clear-both"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ---------------add final mark----------- --}}

        <div class="modal fade" id="myModalF{{ $report->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">
                            <b>Add Final Mark</b>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="box box-primary">
                        <div class="panel panel-sum">
                            <div class="modal-body">
                                <form id="demo-form2" method="post"
                                    action="{{ url('placement-test-report/' . $report->id) }}" data-parsley-validate
                                    class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}


                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleInputTit1e">{{ __('adminstaticword.Select') }}
                                                {{ __('adminstaticword.Final Mark') }}</label>
                                            <select name="final_mark" class="form-control select2">
                                                <option value="Top Notch Fundamentals">
                                                    {{ __('Top Notch Fundamentals') }}
                                                </option>
                                                <option value="Top Notch 1">
                                                    {{ __('Top Notch 1') }}
                                                </option>
                                                <option value="Top Notch 2">
                                                    {{ __('Top Notch 2') }}
                                                </option>
                                                <option value="Top Notch 3">
                                                    {{ __('Top Notch 3') }}
                                                </option>
                                                <option value="Summit 1">
                                                    {{ __('Summit 1') }}
                                                </option>
                                                <option value="Summit 2">
                                                    {{ __('Summit 2') }}
                                                </option>
                                                <option value="Beyond Summit 2">
                                                    {{ __('Beyond Summit 2') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger-rgba"><i class="fa fa-ban"></i>
                                            Reset</button>
                                        <button type="submit" class="btn btn-primary-rgba"><i
                                                class="fa fa-check-circle"></i>
                                            Create</button>
                                    </div>
                                    <div class="clear-both"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
