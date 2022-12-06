@extends('admin.layouts.master')
@section('title', 'Pending User Request - Admin')
@section('maincontent')


    @component('components.breadcumb', ['thirdactive' => 'active'])
        @slot('heading')
            {{ __('Pending Users') }}
        @endslot
        @slot('menu1')
            {{ __('Users') }}
        @endslot
        @slot('menu2')
            {{ __('Pending Users Request') }}
        @endslot

        @slot('button')
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    @can('instructor-pending-request.manage')
                        <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
                            data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }}</button>
                    @endcan
                    <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                    <h4 class="modal-heading">{{ __('Are You Sure') }} ?</h4>
                                    <p>{{ __('Do you really want to delete selected item names here? This process
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            cannot be undone') }}.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form id="bulk_delete_form" method="post" action="{{ route('user.bulk_delete') }}">
                                        @csrf
                                        @method('POST')
                                        <button type="reset" class="btn btn-gray translate-y-3"
                                            data-dismiss="modal">{{ __('No') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('Yes') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endslot
    @endcomponent


    <div class="contentbar">
        <!-- Start row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="box-title">{{ __('Pending Users Request') }}</h5>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                                value="all" />
                                            <label for="checkboxAll" class="material-checkbox"></label>
                                        </th>
                                        <th>#</th>
                                        <th>{{ __('adminstaticword.Image') }}</th>
                                        <th>{{ __('adminstaticword.Users') }}</th>
                                        <th>{{ __('adminstaticword.Status') }}</th>
                                        <th>{{ __('adminstaticword.Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        @if ($item->accepted == '0')
                                            <tr>
                                                <td>
                                                    <input type="checkbox" form="bulk_delete_form"
                                                        class="filled-in material-checkbox-input" name="checked[]"
                                                        value="{{ $item->id }}" id="checkbox{{ $item->id }}">
                                                    <label for="checkbox{{ $item->id }}"
                                                        class="material-checkbox"></label>
                                                </td>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    @if ($image = @file_get_contents('../public/images/user_img/' . $item->user_img))
                                                        <img @error('photo') is-invalid @enderror
                                                            src="{{ url('images/user_img/' . $item->user_img) }}"
                                                            alt="profilephoto" class="img-responsive img-circle">
                                                    @else
                                                        <img @error('photo') is-invalid @enderror
                                                            src="{{ Avatar::create($item->fname)->toBase64() }}"
                                                            alt="profilephoto" class="img-responsive img-circle">
                                                    @endif
                                                </td>
                                                <td>
                                                    User name : {{ $item->user_name }} <br>
                                                    Email : {{ $item->email }} <br>
                                                    Mobile : {{ $item->mobile }}
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="userstatus" type="checkbox"
                                                            data-id="{{ $item->id }}" name="status"
                                                            {{ $item->accepted == '1' ? 'checked' : '' }}>
                                                        <span class="knob"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-round btn-primary-rgba" type="button"
                                                            id="CustomdropdownMenuButton3" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="feather icon-more-vertical-"></i></button>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="CustomdropdownMenuButton3">
                                                            @can('Alluser.view')
                                                                <button type="button" class="dropdown-item" data-toggle="modal"
                                                                    data-target="#exampleStandardModal{{ $item->id }}">
                                                                    <i class="feather icon-eye mr-2"></i>View
                                                                </button>
                                                            @endcan
                                                            @can('instructorrequest.delete')
                                                                <a class="dropdown-item" data-toggle="modal"
                                                                    data-target=".bd-example-modal-sm"><i
                                                                        class="feather icon-delete mr-2"></i>{{ __('Delete') }}</a>
                                                            @endcan

                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="modal fade" id="exampleStandardModal{{ $item->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleStandardModalLabel">
                                                                        {{ $item->fname }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-lg-12">
                                                                        <div class="card m-b-30">
                                                                            <div class="card-body py-5">
                                                                                <div class="row">
                                                                                    <div class="user-modal">
                                                                                        @if ($image = @file_get_contents('../public/images/user_img/' . $item->user_img))
                                                                                            <img @error('photo') is-invalid @enderror
                                                                                                src="{{ url('images/user_img/' . $item->user_img) }}"
                                                                                                alt="profilephoto"
                                                                                                class="img-responsive img-circle"
                                                                                                data-toggle="modal"
                                                                                                data-target="#exampleStandardModal{{ $item->id }}">
                                                                                        @else
                                                                                            <img @error('photo') is-invalid @enderror
                                                                                                src="{{ Avatar::create($item->fname)->toBase64() }}"
                                                                                                alt="profilephoto"
                                                                                                class="img-responsive img-circle"
                                                                                                data-toggle="modal"
                                                                                                data-target="#exampleStandardModal{{ $item->id }}">
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <h4 class="text-center">
                                                                                            {{ $item->user_name }}
                                                                                        </h4>
                                                                                        <div class="button-list mt-4 mb-3">
                                                                                            <button type="button"
                                                                                                class="btn btn-primary-rgba"><i
                                                                                                    class="feather icon-email mr-2"></i>{{ $item->email }}</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-success-rgba"><i
                                                                                                    class="feather icon-phone mr-2"></i>{{ $item->mobile }}</button>
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table
                                                                                                class="table table-borderless mb-0 user-table">
                                                                                                <tbody>
                                                                                                    @isset($item->lname)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                Full name in
                                                                                                                arabic
                                                                                                                :</th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->lname }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset
                                                                                                    @isset($item->fname)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                Full name in
                                                                                                                english
                                                                                                                :</th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->fname }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset
                                                                                                    @isset($item->study)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                Study :</th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->study }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset
                                                                                                    @isset($item->english_level)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                English level :
                                                                                                            </th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->english_level }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset
                                                                                                    @isset($item->dob)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                Date Of Birth :
                                                                                                            </th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->dob }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset
                                                                                                    @isset($item->address)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                Address :</th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->address }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset
                                                                                                    @isset($item->gender)
                                                                                                        <tr>
                                                                                                            <th scope="row"
                                                                                                                class="p-1">
                                                                                                                Gender :</th>
                                                                                                            <td class="p-1">
                                                                                                                {{ $item->gender }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endisset

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleSmallModalLabel">
                                                                    {{ __('Delete') }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-muted">
                                                                    {{ __('Do you really want to delete these records? This process cannot be undone.') }}
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post"
                                                                    action="{{ route('user.delete', $item->id) }}
                                                                    "data-parsley-validate
                                                                    class="form-horizontal form-label-left">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ __('Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">{{ __('Delete') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>

    </div>

@endsection


@section('script')
    <!-- script to change status start -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(function() {
            $(document).on("change", ".userstatus", function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    dataType: "json",
                    // url: "{{ url('/quickupdate/user') }}/" + $(this).data('id'),
                    url: "{{ url('user/status') }}",

                    data: {
                        'status': $(this).is(':checked') ? 1 : 0,
                        'accepted': $(this).is(':checked') ? 1 : 0,
                        'id': $(this).data('id')
                    },
                    success: function(data) {
                        console.log('sss');
                        var warning = new PNotify({
                            title: 'success',
                            text: 'Status Update Successfully',
                            type: 'success',
                            desktop: {
                                desktop: true,
                                icon: 'feather icon-thumbs-down'
                            }
                        });
                        warning.get().click(function() {
                            warning.remove();
                        });
                    }
                });
            })
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- script to change status end -->
    <script>
        $("#checkboxAll").on('click', function() {
            $('input.check').not(this).prop('checked', this.checked);
        });
    </script>
    <!-- css for image start -->
    <style>
        .img-circle {
            height: 100px;
            width: 100px;
            /* border-radius: 90%; */
        }
    </style>
    <!-- css for image end -->
@endsection
