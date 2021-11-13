@php $val = isset($val) ? $val : "" @endphp
@php
    $disable = $field->data_disable == null ? [] :    json_decode($field->data_disable, true);
@endphp

<select name="field-{{$field->id}}" id="field-{{$field->id}}"  class="selectDynamic">
    <option value=""></option>
    @foreach(json_decode($field->data) as $key => $data)
        @if(array_search($key, $disable) !== false) @continue @endif
        @if($field->name == "Empresa")
            @if(\App\Http\Controllers\UserController::seeModuleEmpresa($module->id, $key))
                <option value="{{$key+1}}" @if($key+1 == $val) selected @endif>{{$data}}</option>
            @endif
        @else
            <option value="{{$key+1}}" @if($key+1 == $val) selected @endif>{{$data}}</option>
        @endif
    @endforeach
</select>