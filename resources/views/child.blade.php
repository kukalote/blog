@extends('alert')

@section('title', 'Page Title')


@section('sidebar')
*****
    @parent
    <p> 上层section</p>
*****
@endsection

@section('sidebar')
-----
    @parent
    <p> 中层section</p>
-----
@endsection

@section('sidebar')
+++
    <p> 低层section</p>
+++
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
