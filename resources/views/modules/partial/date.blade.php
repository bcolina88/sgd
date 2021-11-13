@php $val = isset($val) ? $val : "" @endphp
@php $type = isset($type) ? $type : "" @endphp



<input type="text" class="form-control mydatepicker" id='field-{{$field->id}}' name="field-{{$field->id}}" aria-describedby="emailHelp"  value='{{$val}}'>
