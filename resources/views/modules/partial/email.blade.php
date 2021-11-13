@php $val = isset($val) ? $val : "" @endphp
<input type="email" id='{{$field->name}}' name="field-{{$field->id}}" class="form-control" value="{{ old($field->name, $val) }}">