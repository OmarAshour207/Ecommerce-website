    @push('js')
    <script type="text/javascript">
      $(document).ready(function() {
          var dataSelect = [
            @foreach(App\Model\Country::all() as $country)
              {
                "text": "{{ $country->{'country_name_'.lang()} }}",
                "children": [
                  @foreach($country->mallsIn()->get() as $mall)
                  {
                    "id": "{{ $mall->id }}",
                    "text": "{{ $mall->{ 'mall_name_'.lang() } }}",
                    @if(check_mall($mall->id, $product->id))
                    "selected": true ,
                    @endif
                  },
                  @endforeach
                  ],
              },
              @endforeach
            ];

          $(".SelectMany").select2({
            data: dataSelect,
            placeholder: "Select a Mall",
            allowClear: true,
            // templateResult: formatState
            theme: "classic",
        });
      });
    </script>
    @endpush
      
    <div id="product_size_weight" class="tab-pane fade">
      <h3> {{ trans('admin.product_size_weight') }} </h3>
      <div class="size_weight">
        <center> <h1> Choose The department </h1> </center>
      </div>

      <div class="data_info hidden">
        
        <div class="form-group col-md-4 col-lg-4 col-sm-4">
          {!! Form::label('color_id',trans('admin.colors')) !!}
          {!! Form::select('color_id', App\Model\Color::pluck('color_name_'.lang(), 'id'), $product->color_id, ['class' => 'form-control', 'placeholder' =>  trans('admin.color_id')]) !!}
        </div>
        
        <div class="form-group col-md-4 col-lg-4 col-sm-4">
          {!! Form::label('trade_id',trans('admin.trademarks')) !!}
          {!! Form::select('trade_id',App\Model\TradeMark::pluck('trademark_name_'.lang(), 'id'), $product->trade_id,   ['class' => 'form-control', 'placeholder' =>  trans('admin.trademark_id')]) !!}
        </div>
        
        <div class="form-group col-md-4 col-lg-4 col-sm-4">
          {!! Form::label('manu_id',trans('admin.manufactures')) !!}
          {!! Form::select('manu_id',App\Model\Manufacture::pluck('manufacture_name_'.lang(), 'id'), $product->manu_id, ['class' => 'form-control', 'placeholder' =>  trans('admin.manufacture_id')]) !!}
        </div>
        
        <div class="form-group col-md-12 col-lg-12 col-sm-12">
          {!! Form::label('malls', trans('admin.malls')) !!}
          <select name="mall[]" class="SelectMany form-control" multiple="multiple" style="width: 100%;">
            
          </select>
        </div>
        <div class="clearfix"></div>
      </div>  
    </div>
