
@extends('layouts.default')
@section('header')
	<title>Welcome Page</title>
@stop	
@section('content')

<h1> Welcome {{Auth::user()->first}} </h1>
@stop