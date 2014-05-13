@extends('layouts.master')

@section('content')
    @parent

    <header class="large-header">
        <h1>Clades</h1>

        <p>A project to demonstrate the relationships between organisms.</p>
    </header>

    <div class="taxa-wrapper">
        <div class="taxa">

        </div>
    </div>

    @foreach ($hierarchy as $root)
        {{ HTML::taxon($root) }}
    @endforeach
@stop