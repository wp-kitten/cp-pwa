@php
    $options = \App\Plugins\VP_PWA\Util::getPluginOptions();
@endphp
<!-- Web Application Manifest -->
<link rel="manifest" href="{{env('APP_URL')}}/{{CPPWA_MANIFEST_FILE_NAME}}">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="{{$options['theme_color']}}">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="{{$options['name']}}">
<link rel="icon" sizes="512x512" href="{{$options['icons']['152x152']}}">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="{{$options['theme_color']}}">
<meta name="apple-mobile-web-app-title" content="{{$options['name']}}">
<link rel="apple-touch-icon" href="{{$options['icons']['152x152']}}">

@if(! empty($options['icons']['640x640']))
    <link href="{{$options['icons']['640x640']}}" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['750x750']))
    <link href="{{$options['icons']['750x750']}}" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['1242x1242']))
    <link href="{{$options['icons']['1242x1242']}}" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['1125x1125']))
    <link href="{{$options['icons']['1125x1125']}}" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['828x828']))
    <link href="{{$options['icons']['828x828']}}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['1242x1242']))
    <link href="{{$options['icons']['1242x1242']}}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['1536x1536']))
    <link href="{{$options['icons']['1536x1536']}}" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['1668x1668']))
    <link href="{{$options['icons']['1668x1668']}}" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
    <link href="{{$options['icons']['1668x1668']}}" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
@elseif(!empty($options['icons']['2048x2048']))
    <link href="{{$options['icons']['2048x2048']}}" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
@endif


<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="{{$options['background_color']}}">
<meta name="msapplication-TileImage" content="{{$options['icons']['152x152']}}">
