<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header">
                @can('quiz-topic.delete')
                    <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete15"><i
                            class="feather icon-trash mr-2"></i>{{ __('Delete Selected') }} </button>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="displaytable table table-striped table-bordered w-100">
                        <thead>
                            <tr>
                                <th><input id="checkboxAll10" type="checkbox" class="filled-in" name="checked[]"
                                        value="all" />
                                    <label for="checkboxAll" class="material-checkbox"></label> #
                                </th>
                                <th>{{ __('adminstaticword.User') }}</th>
                                <th>{{ __('adminstaticword.Action') }}</th>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($questionnaires as $questionnaire)
                                <tr>
                                    <?php $i++; ?>
                                    <td>
                                        <input type="checkbox" form="bulk_delete_form15"
                                            class="filled-in material-checkbox-input10" name="checked[]"
                                            value="{{ $questionnaire->id }}" id="checkbox{{ $questionnaire->id }}">
                                        <label for="checkbox{{ $questionnaire->id }}" class="material-checkbox"></label>
                                        <?php echo $i; ?>
                                        <!-- bulk delete modal start -->
                                        <div id="bulk_delete15" class="delete-modal modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4 class="modal-heading">{{ __('Are You Sure') }} ?</h4>
                                                        <p>{{ __('Do you really want to delete selected item ? This process
                                                                                                                                                                                                                                                                                                                                cannot be undone') }}.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="bulk_delete_form15" method="post"
                                                            action="{{ route('questionnaire.bulk_delete') }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="reset" class="btn btn-gray translate-y-3"
                                                                data-dismiss="modal">{{ __('No') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('Yes') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- bulk delete modal start -->
                                    </td>
                                    <td>{{ $questionnaire->user->user_name }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button"
                                                id="CustomdropdownMenuButton1" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"><i
                                                    class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">

                                                <a class="dropdown-item"
                                                    href="{{ url('questionnaire/' . $questionnaire->id) }}"><i
                                                        class="feather icon-file mr-2"></i>{{ __('Show') }}</a>

                                                <a class="dropdown-item btn btn-link" data-toggle="modal"
                                                    data-target="#deleteq1{{ $questionnaire->id }}">
                                                    <i class="feather icon-delete mr-2"></i>{{ __('Delete') }}</a>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade bd-example-modal-sm"
                                            id="deleteq1{{ $questionnaire->id }}" tabindex="-1" role="dialog"
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
                                                        <h4>{{ __('Are You Sure ?') }}</h4>
                                                        <p>{{ __('Do you really want to delete') }}
                                                            <b>{{ $questionnaire->user->user_name }} Questionnaire
                                                            </b>?
                                                            {{ __('This process cannot be undone.') }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post"
                                                            action="{{ url('questionnaire/' . $questionnaire->id) }}"
                                                            class="pull-right">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="reset" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('No') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('Yes') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $("#checkboxAll").on('click', function() {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>

<div class="modal fade" id="myModaltopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">
                    <b>Add Quiz</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="box box-primary">
                <div class="panel panel-sum">
                    <div class="modal-body">
                        <form id="demo-form2" method="post" action="{{ url('admin/quiztopic/') }}"
                            data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}

                            <input type="hidden" name="course_id" value="{{ $cor->id }}" />


                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputTit1e">{{ __('adminstaticword.QuizTopic') }}:<span
                                            class="redstar">*</span>
                                    </label>
                                    <input type="text" placeholder="Enter Quiz Topic" class="form-control "
                                        name="title" id="exampleInputTitle" value="">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputDetails">{{ __('adminstaticword.QuizDescription') }}:<sup
                                            class="redstar">*</sup></label>
                                    <textarea name="description" rows="3" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputTit1e">{{ __('adminstaticword.Marks') }}:<span
                                            class="redstar">*</span>
                                    </label>
                                    <input type="number" placeholder="Enter Per Question Mark" class="form-control "
                                        name="per_q_mark" id="exampleInputTitle" value="">
                                </div>
                            </div>
                            <br>


                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputTit1e">{{ __('adminstaticword.QuizTimer') }}:<span
                                            class="redstar">*</span>
                                    </label>
                                    <input type="text" placeholder="Enter Quiz Time" class="form-control"
                                        name="timer" id="exampleInputTitle">
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="exampleInputTit1e">{{ __('adminstaticword.Days') }}:</label>
                                    <input type="text" placeholder="Enter Due Days" class="form-control"
                                        name="due_days" id="exampleInputTitle">
                                    <small>(Days after quiz will start when user enroll in course)</small>

                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label><br>
                                    <label class="switch">
                                        <input class="slider" type="checkbox" name="status" checked />
                                        <span class="knob"></span>
                                    </label>


                                </div>

                                <div class="col-md-4">
                                    <label
                                        for="exampleInputTit1e">{{ __('adminstaticword.QuizReattempt') }}:</label><br>
                                    <label class="switch">
                                        <input class="slider" type="checkbox" name="quiz_again" checked />
                                        <span class="knob"></span>
                                    </label>


                                </div>


                                <div class="col-md-4">
                                    <label for="exampleInputTit1e">{{ __('Quiz Type') }}:</label><br>
                                    <label class="switch">
                                        <input class="slider" type="checkbox" name="free" checked />
                                        <span class="knob"></span>
                                    </label>


                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                                    Reset</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
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

<!-- script to change status start -->
<script>
    $("#checkboxAll").on('click', function() {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>
<script>
    function quiztopic(id) {

        var status = $(this).prop('checked') == true ? 1 : 0;

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ url('/quiz/topic/status/') }}/" + id,
            data: {
                'status': status,
                'id': id
            },
            success: function(data) {
                console.log(id)
            }
        });
    };
</script>

<script>
    function quizreattemp(id) {

        var status = $(this).prop('checked') == true ? 1 : 0;

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ url('/quiz/topic/again/status/') }}/" + id,
            data: {
                'status': status,
                'id': id
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
    };
</script>
<!-- script to change status end -->
