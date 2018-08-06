@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <!-- <h1 class="page-header">
             Forms
         </h1>
        -->
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Bot Configuration
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">

        @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ session('success') }}</strong> 
        </div>
        @endif
        @if (session('danger'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ session('danger') }}</strong> 
        </div>
        @endif
        
        <form role="form" method="POST" action="{{ route('admin.storeconfig') }}">
            {{ csrf_field() }}
            
             @if(is_null($bot))
            
            @else 
                <div class="form-group">
                <label>Telegram ID</label>
                <input class="form-control" value="{{ $bot->id }}" disabled="disabled">
            </div>
            @endif
            
            <div class="form-group">
                <label>Telegram Bot Token</label>
                <input class="form-control" name="token" placeholder="Enter bot token" value="{{ $config->token or '' }}">
                @if ($errors->has('token'))
                <span class="error text-danger">
                    <strong>{{ $errors->first('token') }}</strong>
                </span>
                @endif
            </div>
   
            <div class="form-group">
                <label>Default Currency</label>
                <input class="form-control" name="currency" placeholder="Enter currency" value="{{ $config->currency or '' }}">
            </div>

            <div class="form-group">
                <label>Telegram Webhook</label>
                <input class="form-control" name="webhook" placeholder="Enter webhook" value="{{ $config->webhook or '' }}">
                @if ($errors->has('webhook'))
                <span class="error text-danger">
                    <strong>{{ $errors->first('webhook') }}</strong>
                </span>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Save</button>

        </form>

    </div>
</div>
<!-- /.row -->

@endsection