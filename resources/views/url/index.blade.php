@extends('layout')

@section('content')

<?php
    $url = $url ?? new App\Url();
?>

<div class="jumbotron">
    <h1 class="display-4 text-center">Short URL generator</h1>
    <hr>
    @if (session('hash'))
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ url('/', session('hash')) }}" class="h2" target="_blank">{{ url('/', session('hash')) }}</a>
            </div>
        </div>
        <hr>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-4">
        {{ Form::open(['action' => 'UrlController@create', 'method' => 'post']) }}
        <div class="form-group @error('url') has-error @enderror">
            {{ Form::label('url', 'Url') }}
            {{ Form::text('url', $url->origin, ['class' => 'form-control']) }}
            @error('url')
            <div class="message-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            {{ Form::checkbox('isCustom', 'yes', $url->is_custom, ['onclick' => 'setCustomUrlGeneration()']) }}
            {{ Form::label('isCustom', 'Custom settings') }}
        </div>

        <div class="form-group @error('customUrl') has-error @enderror" id="custom-url-form-group" >
            {{ Form::label('customUrl', 'Custom short URL') }}
            {{ Form::text('customUrl', $url->is_custom ? $url->hash : '', ['class' => 'form-control']) }}
            @error('customUrl')
            <div class="message-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group @error('expired') has-error @enderror">
            {{ Form::label('expired', 'Expired') }}
            {{ Form::text('expired', $url->expired, ['class' => 'form-control datepicker']) }}
            @error('expired')
            <div class="message-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            {{ Form::submit('Generate', ['class' => 'btn btn-primary']) }}
        </div>

        {{ Form::close() }}
        </div>
    </div>
</>

@endsection

