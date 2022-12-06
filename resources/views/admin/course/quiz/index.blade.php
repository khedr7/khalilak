@extends('admin.layouts.master')
@if ($topic->course_id == null)
    @section('title', 'All Placement Test')
@else
    @section('title', 'All Quiz')
@endif
@section('maincontent')
    @component('components.breadcumb', ['secondaryactive' => 'active'])
        @slot('heading')
            @if ($topic->course_id == null)
                {{ __('Placement Test') }}
            @else
                {{ __('Quiz') }}
            @endif
        @endslot

        @slot('menu1')
            @if ($topic->course_id == null)
                {{ __('Placement Test') }}
            @else
                {{ __('Quiz') }}
            @endif
        @endslot
        @slot('button')
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    @if ($topic->type == null)
                        <a href="{{ route('import.quiz') }}" class="float-right btn btn-primary-rgba mr-2"><i
                                class="feather icon-plus mr-2"></i>{{ __('Import Quiz') }}</a>
                        <a data-toggle="modal" data-target="#myModalquiz" href="#"
                            class="float-right btn btn-primary-rgba mr-2"><i
                                class="feather icon-plus mr-2"></i>{{ __('Add Question') }}</a>
                    @endif

                    @if ($topic->type == '1')
                        <a data-toggle="modal" data-target="#myModalquizsubject" class="float-right btn btn-primary-rgba mr-2"><i
                                class="feather icon-plus mr-2"></i>{{ __('Add Question') }}</a>
                    @endif

                    @if ($topic->course_id !== null)
                        <a href="{{ url('course/create/' . $topic->courses->id) }}" class="float-right btn btn-primary-rgba mr-2"><i
                                class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
                    @else
                        <a href="{{ url('placement-test') }}" class="float-right btn btn-primary-rgba mr-2"><i
                                class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
                    @endif
                </div>
            </div>
        @endslot
    @endcomponent
    <div class="contentbar">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        @if ($topic->course_id == null)
                            <h5 class="box-title">{{ __('All Placement Test') }}</h5>
                        @else
                            <h5 class="box-title">{{ __('All Quiz') }}</h5>
                        @endif
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        @if ($topic->course_id !== null)
                                            <th>{{ __('adminstaticword.Course') }}</th>
                                            <th>{{ __('adminstaticword.Topic') }}</th>
                                        @endif
                                        <th>{{ __('adminstaticword.Question') }}</th>
                                        @if ($topic->course_id == null)
                                            <th>{{ __('adminstaticword.Title') }}</th>
                                            <th>{{ __('category') }}</th>
                                        @endif
                                        @if ($topic->type == null)
                                            <th>{{ __('adminstaticword.A') }}</th>
                                            <th>{{ __('adminstaticword.B') }}</th>
                                            <th>{{ __('adminstaticword.C') }}</th>
                                            <th>{{ __('adminstaticword.D') }}</th>
                                            <th>{{ __('adminstaticword.Answer') }}</th>
                                        @endif

                                        <th>{{ __('adminstaticword.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($quizes as $quiz)
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            @if ($quiz->course_id !== null)
                                                <td>{{ $quiz->courses->title }}</td>
                                            @endif
                                            <td>{{ $quiz->topic->title }}</td>
                                            <td>{{ $quiz->question }}</td>
                                            @if ($topic->course_id == null)
                                                <td>{{ $quiz->category }}</td>
                                            @endif
                                            @if ($topic->type == null)
                                                <td>{{ $quiz->a }}</td>
                                                <td>{{ $quiz->b }}</td>
                                                <td>{{ $quiz->c }}</td>
                                                <td>{{ $quiz->d }}</td>
                                                <td>{{ $quiz->answer }}</td>
                                            @endif
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-round btn-outline-primary" type="button"
                                                        id="CustomdropdownMenuButton1" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"><i
                                                            class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                                        @if ($topic->type == null)
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                data-target="#myModaledit{{ $quiz->id }}"><i
                                                                    class="feather icon-edit mr-2"></i>{{ __('Edit') }}</a>
                                                        @endif
                                                        @if ($topic->type == '1')
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                data-target="#myModaleditsub{{ $quiz->id }}"
                                                                href="#"><i
                                                                    class="feather icon-edit mr-2"></i>{{ __('Edit') }}</a>
                                                        @endif
                                                        <a class="dropdown-item btn btn-link" data-toggle="modal"
                                                            data-target="#delete{{ $quiz->id }}">
                                                            <i class="feather icon-delete mr-2"></i>{{ __('Delete') }}</a>
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- delete Modal start -->
                                                <div class="modal fade bd-example-modal-sm" id="delete{{ $quiz->id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <p>{{ __('Do you really want to delete') }} ?
                                                                    {{ __('This process cannot be undone.') }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post"
                                                                    action="{{ url('admin/questions/' . $quiz->id) }}"
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
                                                <!-- delete Model ended -->

                                            </td>


                                        </tr>

                                        <!--Model for edit question-->
                                        <div class="modal fade" id="myModaledit{{ $quiz->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="my-modal-title">
                                                            <b>{{ __('Edit Question') }}</b>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>

                                                    </div>
                                                    <div class="box box-primary">
                                                        <div class="panel panel-sum">
                                                            <div class="modal-body">
                                                                <form id="demo-form2" method="POST"
                                                                    action="{{ route('questions.update', $quiz->id) }}"
                                                                    data-parsley-validate
                                                                    class="form-horizontal form-label-left"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}

                                                                    <input type="hidden" name="course_id"
                                                                        value="{{ $topic->course_id }}" />

                                                                    <input type="hidden" name="topic_id"
                                                                        value="{{ $topic->id }}" />
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    for="exampleInputTit1e">{{ __('adminstaticword.Question') }}</label>
                                                                                <textarea name="question" rows="6" class="form-control" placeholder="Enter Your Question">{{ $quiz->question }}</textarea>
                                                                                <br>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    for="exampleInputDetails">{{ __('adminstaticword.Answer') }}:<sup
                                                                                        class="redstar">*</sup></label>
                                                                                <select style="width: 100%" name="answer"
                                                                                    class="form-control select2">
                                                                                    <option
                                                                                        {{ $quiz->answer == 'A' ? 'selected' : '' }}
                                                                                        value="A">
                                                                                        {{ __('adminstaticword.A') }}
                                                                                    </option>
                                                                                    <option
                                                                                        {{ $quiz->answer == 'B' ? 'selected' : '' }}
                                                                                        value="B">
                                                                                        {{ __('adminstaticword.B') }}
                                                                                    </option>
                                                                                    <option
                                                                                        {{ $quiz->answer == 'C' ? 'selected' : '' }}
                                                                                        value="C">
                                                                                        {{ __('adminstaticword.C') }}
                                                                                    </option>
                                                                                    <option
                                                                                        {{ $quiz->answer == 'D' ? 'selected' : '' }}
                                                                                        value="D">
                                                                                        {{ __('adminstaticword.D') }}
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            @if ($topic->course_id !== null)
                                                                                <h4 class="extras-heading">
                                                                                    {{ __('Video And Image For Question') }}
                                                                                </h4>
                                                                                <div
                                                                                    class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">


                                                                                    <label
                                                                                        for="exampleInputDetails">{{ __('Add Video To Question') }}
                                                                                        :<sup
                                                                                            class="redstar">*</sup></label>
                                                                                    <input type="text"
                                                                                        name="question_video_link"
                                                                                        class="form-control"
                                                                                        placeholder="https://myvideolink.com/embed/.." />
                                                                                    <small
                                                                                        class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                                                                    <small class="text-muted text-info">
                                                                                        <i
                                                                                            class="text-dark feather icon-help-circle"></i>
                                                                                        {{ __('YouTube And Vimeo Video Support (Only Embed Code Link)') }}</small>
                                                                                </div>
                                                                            @endif

                                                                            @if ($topic->course_id == null)
                                                                                <div class="col-md-12 btm-20">
                                                                                    <label
                                                                                        for="type">{{ __('adminstaticword.Type') }}:<sup
                                                                                            class="redstar">*</sup></label>
                                                                                    <select name="file_type"
                                                                                        class="form-control select2 filetypeee">
                                                                                        <option value="none">
                                                                                            {{ __('adminstaticword.ChooseFileType') }}
                                                                                        </option>
                                                                                        <option value="video">
                                                                                            {{ __('adminstaticword.Video') }}
                                                                                        </option>
                                                                                        <option value="audio">
                                                                                            {{ __('adminstaticword.Audio') }}
                                                                                        </option>
                                                                                        {{-- <option value="image">{{ __('adminstaticword.Image') }}</option> --}}
                                                                                        {{-- <option value="zip">{{ __('adminstaticword.Zip') }}</option> --}}
                                                                                        {{-- <option value="pdf">{{ __('Pdf / Powerpoint / Notepad') }} --}}
                                                                                        </option>
                                                                                    </select>
                                                                                </div>

                                                                                <!--for audio -->
                                                                                <div class="col-md-12 btm-20 audioChoose1"
                                                                                    style="display:none">
                                                                                    <input type="radio"
                                                                                        name="checkAudio" class="ch70"
                                                                                        value="audiourl">
                                                                                    {{ __('adminstaticword.URL') }}
                                                                                    <input type="radio"
                                                                                        name="checkAudio" class="ch71"
                                                                                        value="uploadaudio">
                                                                                    {{ __('adminstaticword.UploadAudio') }}
                                                                                </div>

                                                                                <div class="col-md-12 audioURL1"
                                                                                    style="display:none">
                                                                                    <label
                                                                                        for="">{{ __('adminstaticword.URL') }}:
                                                                                    </label>
                                                                                    <input type="text" name="audiourl"
                                                                                        placeholder="Enter Your URL"
                                                                                        class="form-control">
                                                                                </div>

                                                                                <div class="col-md-12 audioUpload1"
                                                                                    style="display:none">
                                                                                    <label
                                                                                        for="">{{ __('adminstaticword.UploadAudio') }}:
                                                                                    </label>
                                                                                    <!-- =========== -->
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"
                                                                                                id="inputGroupFileAddon01">Upload</span>
                                                                                        </div>
                                                                                        <div class="custom-file">
                                                                                            <input type="file"
                                                                                                class="custom-file-input"
                                                                                                name="audioupload"
                                                                                                id="inputGroupFile01"
                                                                                                aria-describedby="inputGroupFileAddon01">
                                                                                            <label
                                                                                                class="custom-file-label"
                                                                                                for="inputGroupFile01">Choose
                                                                                                file</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- =========== -->
                                                                                    <!-- <input type="file" name="audioupload" class="form-control"> -->
                                                                                </div>

                                                                                <!--video-->
                                                                                <div class="col-md-12 btm-20 videotype1"
                                                                                    style="display:none">
                                                                                    <input type="radio"
                                                                                        name="checkVideo" class="ch75"
                                                                                        value="url">&nbsp;{{ __('adminstaticword.URL') }}
                                                                                    &emsp;
                                                                                    <input type="radio"
                                                                                        name="checkVideo" class="ch76"
                                                                                        value="uploadvideo">&nbsp;{{ __('adminstaticword.UploadVideo') }}
                                                                                    &emsp;
                                                                                    {{-- <input type="radio" name="checkVideo" id="ch9"
                                                                                value="iframeurl">&nbsp;{{ __('adminstaticword.IframeURL') }}
                                                                            &emsp; --}}
                                                                                    {{-- <input type="radio" name="checkVideo" id="ch10"
                                                                                value="liveurl">&nbsp;{{ __('adminstaticword.LiveClass') }}
                                                                            &emsp; --}}

                                                                                    {{-- @if ($gsetting->aws_enable == 1)
                                                                                <input type="radio" name="checkVideo" id="ch13"
                                                                                    value="aws_upload">&nbsp;{{ __('adminstaticword.AWSUpload') }}
                                                                            @endif --}}

                                                                                    {{-- @if ($gsetting->youtube_enable == 1)
                                                                                <input type="radio" name="checkVideo" id="youtubeurl"
                                                                                    value="youtube">&nbsp;{{ __('Youtube API') }}
                                                                                &emsp;
                                                                            @endif --}}

                                                                                    {{-- @if ($gsetting->vimeo_enable == 1)
                                                                                <input type="radio" name="checkVideo" id="vimeourl"
                                                                                    value="vimeo">&nbsp;{{ __('Vimeo API') }}
                                                                                &emsp;
                                                                            @endif --}}

                                                                                    <br>
                                                                                </div>

                                                                                <div class="col-md-12 videoURL1"
                                                                                    style="display:none">
                                                                                    <label
                                                                                        for="">{{ __('adminstaticword.URL') }}:
                                                                                    </label>
                                                                                    <input type="text" id="apiUrl"
                                                                                        name="vidurl"
                                                                                        placeholder="Enter Your URL"
                                                                                        class="form-control">
                                                                                </div>

                                                                                <div class="col-md-12 videoUpload1"
                                                                                    style="display:none">
                                                                                    <label
                                                                                        for="">{{ __('adminstaticword.UploadVideo') }}:
                                                                                    </label>
                                                                                    <!-- =========== -->
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"
                                                                                                id="inputGroupFileAddon01">Upload</span>
                                                                                        </div>
                                                                                        <div class="custom-file">
                                                                                            <input type="file"
                                                                                                class="custom-file-input"
                                                                                                name="video_upld"
                                                                                                id="inputGroupFile01"
                                                                                                aria-describedby="inputGroupFileAddon01">
                                                                                            <label
                                                                                                class="custom-file-label"
                                                                                                for="inputGroupFile01">Choose
                                                                                                file</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- =========== -->
                                                                                    <!-- <input type="file" name="video_upld" class="form-control"> -->
                                                                                </div>
                                                                            @endif

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div id="videoURL3"
                                                                                        @if ($quiz->file_type != 'video' || $quiz->url == null) style="display:none" @endif>
                                                                                        <br>
                                                                                        <label
                                                                                            for="">{{ __('adminstaticword.URL') }}
                                                                                            Value :
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            id="apiUrl3"
                                                                                            value="{{ $quiz->url }}"
                                                                                            name="vidurl3"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div id="videoUpload3"
                                                                                        @if ($quiz->file_type != 'video' || $quiz->file == null) style="display:none" @endif>
                                                                                        <br>
                                                                                        {{-- <label
                                                                                            for="">{{ __('adminstaticword.UploadVideo') }}:
                                                                                        </label> --}}
                                                                                        <!-- =========== -->
                                                                                        {{-- <div class="input-group mb-3">
                                                                                            <div
                                                                                                class="input-group-prepend">
                                                                                                <span
                                                                                                    class="input-group-text"
                                                                                                    id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                                                                            </div>
                                                                                            <div class="custom-file">
                                                                                                <input type="file"
                                                                                                    class="custom-file-input"
                                                                                                    name="video_upld"
                                                                                                    id="inputGroupFile01"
                                                                                                    aria-describedby="inputGroupFileAddon01" />
                                                                                                <label
                                                                                                    class="custom-file-label"
                                                                                                    for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                                                            </div>
                                                                                        </div> --}}
                                                                                        <!-- =========== -->
                                                                                        {{ __('adminstaticword.UploadedVideo') }}
                                                                                        :

                                                                                        @if ($quiz->file != null && $quiz->file_type == 'video')
                                                                                            <video
                                                                                                src="{{ asset('video/class/' . $quiz->file) }}"
                                                                                                controls>
                                                                                            </video>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            @if ($quiz->file_type == 'audio')
                                                                                <div class="form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div id="audioURL3"
                                                                                            @if ($quiz->url == null) style="display:none" @endif>
                                                                                            <label
                                                                                                for="">{{ __('adminstaticword.URL') }}:
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                value="{{ $quiz->url }}"
                                                                                                name="audiourl"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div id="audioUpload3"
                                                                                            @if ($quiz->url != '') style="display:none" @endif>
                                                                                            {{-- <label
                                                                                                for="">{{ __('adminstaticword.UploadAudio') }}:</label> --}}
                                                                                            <!-- =========== -->
                                                                                            {{-- <div class="input-group mb-3">
                                                                                                <div
                                                                                                    class="input-group-prepend">
                                                                                                    <span
                                                                                                        class="input-group-text"
                                                                                                        id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                                                                                </div>
                                                                                                <div class="custom-file">
                                                                                                    <input type="file"
                                                                                                        class="custom-file-input"
                                                                                                        name="audio"
                                                                                                        id="inputGroupFile01"
                                                                                                        aria-describedby="inputGroupFileAddon01">
                                                                                                    <label
                                                                                                        class="custom-file-label"
                                                                                                        for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                                                                </div>
                                                                                            </div> --}}
                                                                                            <!-- =========== -->
                                                                                            <!-- <input type="file" name="audio" class="form-control"> -->
                                                                                            <br>
                                                                                            @if ($quiz->file != null)
                                                                                                <label
                                                                                                    for="">{{ __('adminstaticword.AudioFileName') }}:</label>
                                                                                                <input disabled
                                                                                                    value="{{ $quiz->file }}"
                                                                                                    class="form-control">
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif


                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="col-md-12">

                                                                                <label
                                                                                    for="exampleInputDetails">{{ __('adminstaticword.AOption') }}
                                                                                    :<sup class="redstar">*</sup></label>
                                                                                <input type="text" name="a"
                                                                                    value="{{ $quiz->a }}"
                                                                                    class="form-control"
                                                                                    placeholder="Enter Option A">
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    for="exampleInputDetails">{{ __('adminstaticword.BOption') }}
                                                                                    :<sup class="redstar">*</sup></label>
                                                                                <input type="text" name="b"
                                                                                    value="{{ $quiz->b }}"
                                                                                    class="form-control"
                                                                                    placeholder="Enter Option B" />
                                                                            </div>

                                                                            <div class="col-md-12">

                                                                                <label
                                                                                    for="exampleInputDetails">{{ __('adminstaticword.COption') }}
                                                                                    :<sup class="redstar">*</sup></label>
                                                                                <input type="text" name="c"
                                                                                    value="{{ $quiz->c }}"
                                                                                    class="form-control"
                                                                                    placeholder="Enter Option C" />
                                                                            </div>

                                                                            <div class="col-md-12">

                                                                                <label
                                                                                    for="exampleInputDetails">{{ __('adminstaticword.DOption') }}
                                                                                    :<sup class="redstar">*</sup></label>
                                                                                <input type="text" name="d"
                                                                                    value="{{ $quiz->d }}"
                                                                                    class="form-control"
                                                                                    placeholder="Enter Option D" />
                                                                            </div>
                                                                            <br>

                                                                            @if ($topic->course_id == null)
                                                                                <div class="col-md-12">
                                                                                    <label
                                                                                        for="exampleInputDetails">{{ __('adminstaticword.Category') }}:<sup
                                                                                            class="redstar">*</sup></label>
                                                                                    <select name="category"
                                                                                        class="form-control select2">
                                                                                        <option value="none">
                                                                                            {{ __('adminstaticword.SelectanOption') }}
                                                                                        </option>
                                                                                        <option value="General English"
                                                                                            {{ $quiz->category == 'General English' ? 'selected' : '' }}>
                                                                                            {{ __('adminstaticword.General English') }}
                                                                                        </option>
                                                                                        <option value="Reading"
                                                                                            {{ $quiz->category == 'Reading' ? 'selected' : '' }}>
                                                                                            {{ __('adminstaticword.Reading') }}
                                                                                        <option value="Listening"
                                                                                            {{ $quiz->category == 'Listening' ? 'selected' : '' }}>
                                                                                            {{ __('adminstaticword.Listening') }}
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        @if ($topic->course_id !== null)
                                                                            <div class="form-group col-md-12">
                                                                                <label class="text-dark"
                                                                                    for="exampleInputSlug">{{ __('adminstaticword.Image') }}:
                                                                                </label>

                                                                                <div class="input-group mb-3">

                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"
                                                                                            id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                                                                    </div>


                                                                                    <div class="custom-file">

                                                                                        <input type="file"
                                                                                            name="question_img"
                                                                                            class="custom-file-input"
                                                                                            id="question_img"
                                                                                            aria-describedby="inputGroupFileAddon01">
                                                                                        <label class="custom-file-label"
                                                                                            for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group">
                                                                        <button type="reset"
                                                                            class="btn btn-danger-rgba"><i
                                                                                class="fa fa-ban"></i>
                                                                            {{ __('Reset') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary-rgba"><i
                                                                                class="fa fa-check-circle"></i>
                                                                            {{ __('Update') }}</button>
                                                                    </div>

                                                                    <div class="clear-both"></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Model close -->

                                        <!--Model for edit question-->
                                        <div class="modal fade" id="myModaleditsub{{ $quiz->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                        {{ __('adminstaticword.Question') }}</h4>
                                                    </div>
                                                    <div class="box box-primary">
                                                        <div class="panel panel-sum">
                                                            <div class="modal-body">
                                                                <form id="demo-form2" method="POST"
                                                                    action="{{ route('questions.update', $quiz->id) }}"
                                                                    data-parsley-validate
                                                                    class="form-horizontal form-label-left"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}

                                                                    <input type="hidden" name="course_id"
                                                                        value="{{ $topic->course_id }}" />

                                                                    <input type="hidden" name="topic_id"
                                                                        value="{{ $topic->id }}" />

                                                                    <input type="hidden" name="type"
                                                                        value="1" />

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="exampleInputTit1e">{{ __('adminstaticword.Question') }}</label>
                                                                            <textarea name="question" rows="6" class="form-control" placeholder="Enter Your Question">{{ $quiz->question }}</textarea>
                                                                            <br>
                                                                        </div>


                                                                    </div>
                                                                    <br>



                                                                    <div class="col-md-12">
                                                                        <div class="extras-block">
                                                                            <h4 class="extras-heading">
                                                                                {{ __('Images And Video For Question') }}
                                                                            </h4>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div
                                                                                        class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">


                                                                                        <label
                                                                                            for="exampleInputDetails">{{ __('Add Video To Question') }}
                                                                                            :<sup
                                                                                                class="redstar">*</sup></label>
                                                                                        <input type="text"
                                                                                            name="question_video_link"
                                                                                            value="{{ $quiz->question_video_link }}"
                                                                                            class="form-control"
                                                                                            placeholder="https://myvideolink.com/embed/.." />

                                                                                        <small
                                                                                            class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                                                                        <small
                                                                                            class="text-muted text-info">
                                                                                            <i
                                                                                                class="text-dark feather icon-help-circle"></i>{{ __('YouTube And Vimeo Video Support (Only Embed Code LinkG') }}</small>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div
                                                                                        class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">


                                                                                        <label
                                                                                            for="exampleInputDetails">{{ __('Add Image To Question') }}
                                                                                            :<sup
                                                                                                class="redstar">*</sup></label>
                                                                                        <input type="file"
                                                                                            name="question_img"
                                                                                            class="form-control" />


                                                                                        <small
                                                                                            class="text-danger">{{ $errors->first('question_img') }}</small>
                                                                                        <small
                                                                                            class="text-muted text-info">
                                                                                            <i
                                                                                                class="text-dark feather icon-help-circle"></i>
                                                                                            {{ __('Please Choose Only .JPG, .JPEG and .PNG') }}</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <button type="reset" class="btn btn-danger"><i
                                                                                class="fa fa-ban"></i>
                                                                            {{ __('Reset') }} </button>
                                                                        <button type="submit" class="btn btn-primary"><i
                                                                                class="fa fa-check-circle"></i>
                                                                            {{ __('Update') }}</button>
                                                                    </div>

                                                                    <div class="clear-both"></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Model close -->
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModalquiz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> {{ __('adminstaticword.Add') }}
                            {{ __('adminstaticword.Question') }}
                        </h4>
                    </div>
                    <div class="box box-primary">
                        <div class="panel panel-sum">
                            <div class="modal-body">
                                <form id="demo-form2" method="post" action="{{ route('questions.store') }}"
                                    data-parsley-validate class="form-horizontal form-label-left"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="course_id" value="{{ $topic->course_id }}" />

                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label
                                                    for="exampleInputTit1e">{{ __('adminstaticword.Question') }}</label>
                                                <textarea name="question" rows="6" class="form-control" placeholder="Enter Your Question"></textarea>
                                                <br>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="exampleInputDetails">{{ __('adminstaticword.Answer') }}:<sup
                                                        class="redstar">*</sup></label>
                                                <select style="width: 100%" name="answer" class="form-control select2">
                                                    <option value="none" selected disabled hidden>
                                                        {{ __('adminstaticword.SelectanOption') }}
                                                    </option>
                                                    <option value="A">{{ __('adminstaticword.A') }}</option>
                                                    <option value="B">{{ __('adminstaticword.B') }}</option>
                                                    <option value="C">{{ __('adminstaticword.C') }}</option>
                                                    <option value="D">{{ __('adminstaticword.D') }}</option>
                                                </select>
                                            </div>
                                            <br>
                                            @if ($topic->course_id !== null)
                                                <div class="col-md-12">
                                                    <h4 class="extras-heading">
                                                        {{ __('Video And Image For Question') }}
                                                    </h4>
                                                    <div
                                                        class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">


                                                        <label
                                                            for="exampleInputDetails">{{ __('Add Video To Question') }}
                                                            :<sup class="redstar">*</sup></label>
                                                        <input type="text" name="question_video_link"
                                                            class="form-control"
                                                            placeholder="https://myvideolink.com/embed/.." />
                                                        <small
                                                            class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                                        <small class="text-muted text-info"> <i
                                                                class="text-dark feather icon-help-circle"></i>
                                                            {{ __('Back') }}YouTube And Vimeo Video Support (Only
                                                            Embed
                                                            Code
                                                            Link)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="text-dark"
                                                        for="exampleInputSlug">{{ __('adminstaticword.Image') }}:
                                                    </label>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroupFileAddon01">{{ __('Back') }}Upload</span>
                                                        </div>
                                                        <div class="custom-file">

                                                            <input type="file" name="question_img"
                                                                class="custom-file-input" id="question_img"
                                                                aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label"
                                                                for="inputGroupFile01">{{ __('Back') }}Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($topic->course_id == null)
                                                <div class="col-md-12 btm-20">
                                                    <label for="type">{{ __('adminstaticword.Type') }}:<sup
                                                            class="redstar">*</sup></label>
                                                    <select name="file_type" id="filetype" class="form-control select2">
                                                        <option value="none">
                                                            {{ __('adminstaticword.ChooseFileType') }}</option>
                                                        <option value="video">{{ __('adminstaticword.Video') }}
                                                        </option>
                                                        <option value="audio">{{ __('adminstaticword.Audio') }}
                                                        </option>
                                                        {{-- <option value="image">{{ __('adminstaticword.Image') }}</option> --}}
                                                        {{-- <option value="zip">{{ __('adminstaticword.Zip') }}</option> --}}
                                                        {{-- <option value="pdf">{{ __('Pdf / Powerpoint / Notepad') }} --}}
                                                        </option>
                                                    </select>
                                                </div>

                                                <!--for audio -->
                                                <div class="col-md-12 btm-20" id="audioChoose" style="display:none">
                                                    <input type="radio" name="checkAudio" id="ch11"
                                                        value="audiourl">
                                                    {{ __('adminstaticword.URL') }}
                                                    <input type="radio" name="checkAudio" id="ch12"
                                                        value="uploadaudio">
                                                    {{ __('adminstaticword.UploadAudio') }}
                                                </div>

                                                <div class="col-md-12" id="audioURL" style="display:none">
                                                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                                                    <input type="text" name="audiourl" placeholder="Enter Your URL"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-12" id="audioUpload" style="display:none">
                                                    <label for="">{{ __('adminstaticword.UploadAudio') }}:
                                                    </label>
                                                    <!-- =========== -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="audioupload" id="inputGroupFile01"
                                                                aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                    <!-- =========== -->
                                                    <!-- <input type="file" name="audioupload" class="form-control"> -->
                                                </div>

                                                <!--video-->
                                                <div class="col-md-12 btm-20" id="videotype" style="display:none">
                                                    <input type="radio" name="checkVideo" id="ch1"
                                                        value="url">&nbsp;{{ __('adminstaticword.URL') }}
                                                    &emsp;
                                                    <input type="radio" name="checkVideo" id="ch2"
                                                        value="uploadvideo">&nbsp;{{ __('adminstaticword.UploadVideo') }}
                                                    &emsp;
                                                    {{-- <input type="radio" name="checkVideo" id="ch9"
                                                    value="iframeurl">&nbsp;{{ __('adminstaticword.IframeURL') }}
                                                &emsp; --}}
                                                    {{-- <input type="radio" name="checkVideo" id="ch10"
                                                    value="liveurl">&nbsp;{{ __('adminstaticword.LiveClass') }}
                                                &emsp; --}}

                                                    {{-- @if ($gsetting->aws_enable == 1)
                                                    <input type="radio" name="checkVideo" id="ch13"
                                                        value="aws_upload">&nbsp;{{ __('adminstaticword.AWSUpload') }}
                                                @endif --}}

                                                    {{-- @if ($gsetting->youtube_enable == 1)
                                                    <input type="radio" name="checkVideo" id="youtubeurl"
                                                        value="youtube">&nbsp;{{ __('Youtube API') }}
                                                    &emsp;
                                                @endif --}}

                                                    {{-- @if ($gsetting->vimeo_enable == 1)
                                                    <input type="radio" name="checkVideo" id="vimeourl"
                                                        value="vimeo">&nbsp;{{ __('Vimeo API') }}
                                                    &emsp;
                                                @endif --}}

                                                    <br>
                                                </div>

                                                <div class="col-md-12" id="videoURL" style="display:none">
                                                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                                                    <input type="text" id="apiUrl" name="vidurl"
                                                        placeholder="Enter Your URL" class="form-control">
                                                </div>

                                                <div class="col-md-12" id="videoUpload" style="display:none">
                                                    <label for="">{{ __('adminstaticword.UploadVideo') }}:
                                                    </label>
                                                    <!-- =========== -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="video_upld" id="inputGroupFile01"
                                                                aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                    <!-- =========== -->
                                                    <!-- <input type="file" name="video_upld" class="form-control"> -->
                                                </div>
                                            @endif


                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">

                                                <label for="exampleInputDetails">{{ __('adminstaticword.AOption') }}
                                                    :<sup class="redstar">*</sup></label>
                                                <input type="text" name="a" class="form-control"
                                                    placeholder="Enter Option A">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="exampleInputDetails">{{ __('adminstaticword.BOption') }}
                                                    :<sup class="redstar">*</sup></label>
                                                <input type="text" name="b" class="form-control"
                                                    placeholder="Enter Option B" />
                                            </div>

                                            <div class="col-md-12">

                                                <label for="exampleInputDetails">{{ __('adminstaticword.COption') }}
                                                    :<sup class="redstar">*</sup></label>
                                                <input type="text" name="c" class="form-control"
                                                    placeholder="Enter Option C" />
                                            </div>

                                            <div class="col-md-12">

                                                <label for="exampleInputDetails">{{ __('adminstaticword.DOption') }}
                                                    :<sup class="redstar">*</sup></label>
                                                <input type="text" name="d" class="form-control"
                                                    placeholder="Enter Option D" />
                                            </div>
                                            <br>
                                            @if ($topic->course_id == null)
                                                <div class="col-md-12">
                                                    <label
                                                        for="exampleInputDetails">{{ __('adminstaticword.Category') }}:<sup
                                                            class="redstar">*</sup></label>
                                                    <select name="category" class="form-control select2">
                                                        <option value="none">
                                                            {{ __('adminstaticword.SelectanOption') }}
                                                        </option>
                                                        <option value="General English">
                                                            {{ __('adminstaticword.General English') }}</option>
                                                        <option value="Reading">{{ __('adminstaticword.Reading') }}
                                                        <option value="Listening">
                                                            {{ __('adminstaticword.Listening') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- <div class="row">
                                        <div class="form-group col-md-6">

                                            
                                        </div>
                                    </div> --}}
                                    <br>
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                                            {{ __('Back') }}Reset</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                            {{ __('Back') }}Create</button>
                                    </div>

                                    <div class="clear-both"></div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Model close -->


        <!--Model for add question -->
        <div class="modal fade" id="myModalquizsubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="box box-primary">
                        <div class="panel panel-sum">
                            <div class="modal-body">
                                <form id="demo-form2" method="post" action="{{ route('questions.store') }}"
                                    data-parsley-validate class="form-horizontal form-label-left"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="course_id" value="{{ $topic->course_id }}" />

                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}" />


                                    <input type="hidden" name="type" value="1" />

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleInputTit1e">{{ __('adminstaticword.Question') }}</label>
                                            <textarea name="question" rows="6" class="form-control" placeholder="Enter Your Question"></textarea>
                                            <br>
                                        </div>


                                    </div>
                                    <br>


                                    <div class="col-md-12">
                                        <div class="extras-block">
                                            <h4 class="extras-heading">{{ __('Back') }}Video And Image For
                                                Question
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">


                                                        <label for="exampleInputDetails">{{ __('Back') }}Add Video
                                                            To
                                                            Question :<sup class="redstar">*</sup></label>
                                                        <input type="text" name="question_video_link"
                                                            class="form-control"
                                                            placeholder="https://myvideolink.com/embed/.." />
                                                        <small
                                                            class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                                        <small class="text-muted text-info"> <i
                                                                class="text-dark feather icon-help-circle"></i>
                                                            {{ __('Back') }}YouTube And Vimeo Video Support (Only
                                                            Embed
                                                            Code Link)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">

                                                        <label for="exampleInputDetails">{{ __('Back') }}Add Image
                                                            To
                                                            Question :<sup class="redstar">*</sup></label>
                                                        <input type="file" name="question_img" class="form-control" />
                                                        <small
                                                            class="text-danger">{{ $errors->first('question_img') }}</small>
                                                        <small class="text-muted text-info"> <i
                                                                class="text-dark feather icon-help-circle"></i>
                                                            {{ __('Back') }}Please Choose Only .JPG, .JPEG and
                                                            .PNG</small>


                                                    </div>
                                                </div>
                                                <br>

                                                <br>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                                            {{ __('Back') }}Reset</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                            {{ __('Back') }}Create</button>
                                    </div>

                                    <div class="clear-both"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
