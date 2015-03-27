<!DOCTYPE html>
<html>
    <head>
        <title>Jamie Shepherd, Designer &amp; Developer @if(isset($title)) - {{ $title }}@endif</title>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="{{ elixir("css/app.css") }}">
        <script src="/js/helpers.js"></script>
        <script src="//use.typekit.net/zun7twj.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
    </head>
    <body>
@include('_layout.nav')
<div id="wrapper">
@yield('body')
@include('_layout.footer')
</div>