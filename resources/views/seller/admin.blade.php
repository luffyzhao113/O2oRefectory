<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/seller/iview.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/seller/app.css') }}">
    <title>店铺后台管理系统</title>
</head>
<body>
<div id="app">
<script type="text/javascript">
    const SELLER_ID = {{ request()->input('seller_id') }};
</script>
<script type="text/javascript" src="{{ asset('/js/seller/manifest.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/seller/vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/seller/app.js') }}"></script>
</body>
</html>
