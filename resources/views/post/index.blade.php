@extends('My-App.master')
@section('title')
   My-App
@endsection
@section('header')
  @include('My-App.header')
  @include('My-App.left-side-bar')
@endsection
@section('content')
@if(@$cturl == "edit")
@include('post.edit')
@else
@include('post.list')
@endif
@endsection