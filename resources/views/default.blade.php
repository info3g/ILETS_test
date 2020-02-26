<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    <head>
        @include('layouts.header')
        @include('layouts.css')
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    </head>
    <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">              

        @include('layouts.navbar')
        @include('layouts.sidebar')
            @yield('content')  
        @include('layouts.footer')
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>      
        @include('layouts.js')   
    </body>
</html>