
@extends('backend.layout.app')

@section('content')

<div class="container">
    <form action="{{ route('admin.settings.store') }}" method="post">
        {{ csrf_field()}}
        <div class="form-group">
            <label>URL Callback Telegram bot</label>   
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                     arial-haspopup="true" arial-expanded="false">ttete<span class="caret"></span>                       
                    </button>
                    <ul class="dropdown">
                        <li><a href=""></a></li>   
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                    </ul>
                <input type="url" class="form-control" id="url_callback_bot" value="{{ $url_callback_bot }}">   
            </div>
        </div>   
        </div>        
        <button class="btn-primary" type="submit">Submit</button>
    </form>
 </div>   

@endsection