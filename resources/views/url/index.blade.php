@extends('layout')

@section('content')

<div class="jumbotron">
    <h1 class="display-4 text-center">Short URL generator</h1>
    <hr>
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

            @if ($url->id > 0)
                <a href="{{ url('/', $url->hash) }}" class="h2 generated" target="_blank">{{ url('/', $url->hash) }}</a>
            @endif
        </div>

        {{ Form::close() }}
        </div>
    </div>
</div>

@endsection

