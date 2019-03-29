@extends('admin.index')
@section('content')

@push('js')
<script type="text/javascript">
  $(document).ready(function(){

    $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep($size->department_id, $size->id) !!},
      "themes" : {
        "variant" : "large"
      }
    },
    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow" ]
    });

});

  $('#jstree').on('changed.jstree', function(e, data){
  var i , j , r = [];
  for(i = 0, j = data.selected.length; i < j; i++)
  {
    r.push(data.instance.get_node(data.selected[i]).id);
  }
  $('.department_id').val(r.join(', '));
});
  
</script>
@endpush


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open([ 'url' => aurl('sizes/'.$size->id), 'method' => 'put']) !!}

      <div class="form-group">
        {!! Form::label('size_name_ar', trans('admin.name_ar')) !!}
        {!! Form::text('size_name_ar', $size->size_name_ar, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('size_name_en', trans('admin.name_en')) !!}
        {!! Form::text('size_name_en', $size->size_name_en, ['class' => 'form-control']) !!}
      </div>

      <div class="clearfix"></div>
      <input type="hidden" name="department_id" class="department_id" value="{{ $size->department_id }}">
      <div id="jstree"></div>

      <div class="form-group">
        {!! Form::label('is_public',trans('admin.is_public')) !!}
        {!! Form::select('is_public',['yes'=> trans('admin.yes'), 'no'=> trans('admin.no')],$size->is_public , ['class' => 'form-control']) !!}
      </div>

      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
