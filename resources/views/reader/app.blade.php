<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script data-n-head="ssr" src="https://www.googletagmanager.com/gtag/js?id={{$globalsettings->tag_manager}}" async=""></script>
        <meta data-n-head="ssr"  charset="utf-8">
        <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=0.8">
        <meta  data-n-head="ssr" name="keywords"  content="{{$globalsettings->keywords}}" />
        <meta data-n-head="ssr" http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta data-n-head="ssr" name="robots" content="index, follow" />
        <meta data-n-head="ssr" data-hid="og:site_name" key="og:site_name" property="og:site_name" name="og:site_name"
        content="{{ $globalsettings->site_name }}">
        <meta data-n-head="ssr" data-hid="og:locale" key="og:locale" property="og:locale" name="og:locale" content="en">
        <meta data-n-head="ssr" data-hid="og:type" key="og:type" property="og:type" name="og:type" content="website">
        <meta data-n-head="ssr" data-hid="image:width" key="image:width" property="image:width" name="image:width"
            content="400">
        <meta data-n-head="ssr" data-hid="image:height" key="image:height" property="image:height" name="image:height"
            content="400">
            <meta data-n-head="ssr" data-hid="robots" key="robots" property="robots" name="robots" content="all">
        <meta data-n-head="ssr" data-hid="image:alt" key="image:alt" property="image:alt" name="image:alt"
            content="High quality comics and more with {{$globalsettings->site_name}}!">
            <link data-n-head="ssr" rel="icon" type="image/x-icon" href="{{$globalsettings->favicon}}">


            <link data-n-head="ssr"  rel="canonical" href="{{$globalsettings->site_url}}" />

            <meta data-n-head="ssr"  name="og:site_url" content="{{$globalsettings->site_url}}" />
            <meta data-n-head="ssr"  name="twitter:site_url" content="{{$globalsettings->site_url}}" />
            <meta data-n-head="ssr"  name="twitter:creator" content="@Mimo" />
            <meta data-n-head="ssr"
        name="twitter:site_name"
         content="{{$globalsettings->site_name}}"
      />

        <meta data-n-head="ssr" data-hid="publisher" key="publisher" property="publisher" name="publisher" content="Mimo" />
        <!-- Fonts -->
       <!-- Styles -->
        <link   rel="stylesheet" href="{{ mix('css/reader.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <div hidden>
            {{$globalsettings->adsense}}
        </div>

    </body>
</html>
