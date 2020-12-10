<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel ={ csrfToken: '{{csrf_token()}}' }</script>
         <link rel="stylesheet" href="css/all.css">
       <link rel="stylesheet" href="css/bootstrap.min.css">
       <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>


        <script src="/css/app.css"></script>
        <title>API DEV with VUE</title>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 Fonts -->

    </head>
<div id="app">
<navc></navc>
<articl></articl>
</div>

<!--<article></article>-->

    <script src=" {{ asset('js/app.js')  }}"></script>


</html>

