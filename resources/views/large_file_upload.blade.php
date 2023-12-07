@include("admin::form._header")
      <div id="aetherupload-wrapper-{{$name}}">
       <div class="input-group controls">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <input type="file" id="{{$name}}-file" data-filename-placement="inside" class="{{$class}}" name="{{$name}}" {!! $attributes !!} />
              <div class="progress " style="height: 10px;margin-bottom:2px; margin-top:14px; width:100%">
                <div id="{{$name}}-progressbar" style="background:rgb(0, 136, 255);height:6px;width:0;"></div>
              </div>
              <div id="result-{{$name}}" style="width:100%;"></div>
            <input type="hidden" name="{{$name}}" id="{{$name}}-savedpath" value="{{ old($column, $value) }}">
              <span class="input-group-btn" id="{{$name}}-output">
              @isset($btn){!! $btn !!}@endisset
            </span>
        </div>
    </div>
@include("admin::form._footer")
