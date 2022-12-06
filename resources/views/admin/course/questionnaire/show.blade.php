@extends('admin.layouts.master')
@section('title','Questionnaire Answers')
@section('maincontent')
@component('components.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
   {{ __('Questionnaire Answers') }}
@endslot

@slot('menu1')
   {{ __('Questionnaire') }}
@endslot
@slot('menu2')
   {{ __('Questionnaire Answers') }}
@endslot
@slot('button')
{{-- <div class="col-md-4 col-lg-4">
    <div class="widgetbar">
        @can('assignment.delete ')
        <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete"><i
            class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }}</button>
     @endcan
    </div>                        
</div> --}}
@endslot
@endcomponent
<div class="contentbar"> 
  <div class="row">
      
      <div class="col-lg-12">
          <div class="card m-b-30">
              <div class="card-header">
                  <h5 class="box-title">{{ __('Questionnaire Answers') }}</h5>
              </div>
              <div class="card-body">
              
                  <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                          <tr>
                            <th>
                              {{-- <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                              value="all" /> --}}
                          <label for="checkboxAll" class="material-checkbox"></label>   # 
                          </th>
                          {{-- <th>{{ __('adminstaticword.User') }}</th>
                          <th>{{ __('adminstaticword.Course') }}</th> --}}
                          <th>{{ __('adminstaticword.Type') }}</th>
                          <th>{{ __('adminstaticword.Question') }}</th>
                          <th>{{ __('adminstaticword.Answer') }}</th>                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0;?>
                        @foreach($questionnaires as $questionnaire)
                          <tr>
                            <?php $i++;?>
                            <td>
                                                     
                            {{--   <input type='checkbox' form='bulk_delete_form' class='check filled-in material-checkbox-input'
                                  name='checked[]' value='{{ $assign->id }}' id='checkbox{{ $assign->id }}'>
                              <label for='checkbox{{ $assign->id }}' class='material-checkbox'></label> --}}
                              <?php echo $i; ?>
                          </td>
                          <td>{{$questionnaire->type}}</td>
                          <td>{{$questionnaire->question}}</td>
                          <td>{{$questionnaire->answer}}</td>
                          
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
   <script type="text/javascript">
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );

   $("#sortable").sortable({
   update: function (e, u) {
    var data = $(this).sortable('serialize');
   
    $.ajax({
        url: "{{ route('slider_reposition') }}",
        type: 'get',
        data: data,
        dataType: 'json',
        success: function (result) {
          console.log(data);
        }
    });

  }

});
  </script>
   <script>
    $("#checkboxAll").on('click', function () {
$('input.check').not(this).prop('checked', this.checked);
});
</script>

@endsection

