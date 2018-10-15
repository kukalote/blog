@extends('layouts.appp')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <p>sidebar</p>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection

@section('js')

<script>

@parent
</script>
@endsection

