<!DOCTYPE html>
<html>
    <head>
        <title>Clades</title>

        {{ HTML::style('build/styles/screen.css') }}
    </head>
    <body>
        @section('head')

        @show

        @section('content')

        @show

        {{ HTML::script('build/scripts/vendor/zepto.js') }}
        {{ HTML::script('build/scripts/app.js') }}
    </body>
</html>