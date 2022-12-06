@extends('admin.layouts.master')
@section('title', 'All Jobs requests - Admin')
@section('maincontent')


    @component('components.breadcumb', ['thirdactive' => 'active'])
        @slot('heading')
            {{ __('All Jobs requests') }}
        @endslot
        @slot('menu1')
            {{ __('Jobs requests') }}
        @endslot
        @slot('menu2')
            {{ __('All Jobs requests') }}
        @endslot

        @slot('button')
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">

                    <a href="page-product-detail.html" class="btn btn-danger-rgba" data-toggle="modal"
                        data-target=".bd-example-modal-sm1"><i class="feather icon-trash mr-2"></i>{{ __('Delete Selected') }}</a>

                    <div class="modal fade bd-example-modal-sm1" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleSmallModalLabel">{{ __('Delete') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <p class="text-muted">
                                        {{ __('Do you really want to delete these records? This process cannot be undone.') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="post"
                                        action="{{ action('BulkdeleteController@findJobrequestdeleteAll') }}
                    "
                                        id="bulk_delete_form" data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}

                                        <button type="button" class="btn btn-secondary"
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
                        <h5 class="box-title">{{ __('All Jobs requests') }}</h5>
                    </div>
                    <div class="card-body">

                        
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td> <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                                value="all" id="checkboxAll">
                                            <label for="checkboxAll" class="material-checkbox"></label>
                                        </td>
                                        <th>{{ __('adminstaticword.Image') }}</th>
                                        <th>{{ __('adminstaticword.Name') }}</th>
                                        <th>{{ __('adminstaticword.Email') }}</th>
                                        <th>{{ __('adminstaticword.Job Title') }}</th>
                                        <th>{{ __('adminstaticword.Status') }}</th>
                                        <th>{{ __('adminstaticword.Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" form="bulk_delete_form"
                                                    class="filled-in material-checkbox-input" name="checked[]"
                                                    value="{{ $item->id }}" id="checkbox{{ $item->id }}">
                                                <label for="checkbox{{ $item->id }}" class="material-checkbox"></label>
                                            </td>
                                            <td>
                                                @if ($item->user->user_img != null && $item->user->user_img != '')
                                                    <img src="{{ asset('images/user_img/' . $item->user->user_img) }}"
                                                        class="img-circle">
                                                @else
                                                    <img src="{{ Avatar::create($item->user->fname)->toBase64() }}"
                                                        class="dashboard-imgs" alt="">
                                                @endif
                                            </td>

                                            {{-- <img src="{{ asset('images/user_img/' . $item->user->user_img) }}"
                                                class="img-responsive img-circle"> --}}
                                            <td>{{ $item->user->fname }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            {{-- <td>{{ str_limit($item->detail, $limit= 50, $end = '...')}}</td> --}}
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success">
                                                        {{ __('adminstaticword.Approved') }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">
                                                        {{ __('adminstaticword.Pending') }}</span>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-round btn-primary-rgba" type="button"
                                                        id="CustomdropdownMenuButton3" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"><i
                                                            class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton3">
                                                        <a class="dropdown-item"
                                                            href="{{ route('requestjob.edit', $item->id) }}"><i
                                                                class="feather icon-eye mr-2"></i>{{ __('View') }}</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target=".bd-example-modal-sm"><i
                                                                class="feather icon-delete mr-2"></i>{{ __('Delete') }}</a>
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
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
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
                                                                action="{{ url('requestjob/' . $item->id) }}
                                              "data-parsley-validate
                                                                class="form-horizontal form-label-left">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('No') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ __('Yes') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
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


@endsection

@section('scripts')



    <script>
        "use Strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on("change", ".all_instructor", function() {

            $.ajax({

                type: "POST",
                dataType: "json",
                url: "{{ url('quickupdate/instructorrequest') }}",
                data: {
                    'status': $(this).is(':checked') ? 1 : 0,
                    'id': $(this).data('id')
                },
                success: function(data) {
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
    </script>


@endsection
