@extends('layouts.app')

<style>
    .quoteOfDay {
        margin: 0 auto;
        width: 25%;
    }

    .quote {
        font-size: 1.2em;
    }

    .tip {
        color: red;
        margin:auto;
        width:25%;
    }
</style>

@section('content')
    <div class="quoteOfDay">
        <h1>This is the current quote</h1><br>

        <p class="quote"><b>{{ $quote->text }}</b></p>
        <i>- {{ $quote->author }}</i>
    </div>
    <br><br>
    <p class="tip">
    This quote will be updated every minute between 06:00 and 23:00 (task scheduler)
    </p>

@endsection