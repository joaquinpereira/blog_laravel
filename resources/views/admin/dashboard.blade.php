@extends('admin.layout')

@section('content')
    <h1>Dashboard</h1>
    <p>{{ auth()->user()->name }}</p>
    <p>{{ auth()->user()->email }}</p>
@endsection