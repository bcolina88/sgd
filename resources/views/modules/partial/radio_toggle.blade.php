@php $val = isset($val) ? $val : "" @endphp
@php
    $disable = $field->data_disable == null ? [] :    json_decode($field->data_disable, true);
@endphp
<select name="field-{{$field->id}}" id="field-{{$field->id}}"  class="radio_toggle">
    <option value=""></option>
    @foreach(json_decode($field->data) as $key => $data)
        @if(array_search($key, $disable) !== false) @continue @endif
        <option value="{{$data}}" @if($data == $val) selected @endif>{{$key}}</option>
    @endforeach
</select>

<script>
    window.onload = function () {
        @foreach(json_decode($field->data) as $key => $data)
            document.getElementById("field-{{$data}}").parentElement.classList.add("toggle-item");
            @if($val == $data)
                document.getElementById("field-{{$data}}").parentElement.classList.add("show-item");
            @endif
        @endforeach


        document.getElementById("field-{{$field->id}}").addEventListener("change", function (e) {
            var el = e.target
            var val = el.options[el.selectedIndex].value;
            var items = document.getElementsByClassName("show-item");
            if(items.length > 0){
                console.log(items)
                for(var i in items){
                    try {
                        items[i].classList.remove("show-item")
                    }
                    catch (e) {

                    }
                }
            }
            document.getElementById("field-"+val).parentElement.classList.add("show-item");
        })
    }

</script>