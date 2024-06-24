<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>flea-market</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/slide.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

</head>
</head>

<body>
  <div id="app">
    @component('components.header')
    @endcomponent
    @yield('main')
  </div>
</body>

</html>