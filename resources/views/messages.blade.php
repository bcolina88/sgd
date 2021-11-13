@if (session('msg'))
    <div class="container-fluid">
        <div class="alert alert-success col-12">
            {{session('msg')}}
        </div>
    </div>
    
@endif

@if (session('error')) 
    <div class="container-fluid">
        <div class="alert alert-danger col-12">
            {{session('error')}}
        </div>
    </div>
@endif


@if ($errors->any())
   <div class="container-fluid">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif