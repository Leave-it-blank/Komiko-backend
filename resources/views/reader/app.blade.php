<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Google Tag Manager -->
    <script data-n-head="ssr">
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '{{$globalsettings->tag_manager}}');
    </script>
    <!-- End Google Tag Manager -->
    <meta data-n-head="ssr" charset="utf-8">
    <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=0.8">
    <meta data-n-head="ssr" name="keywords" content="{{$globalsettings->keywords}}" />
    <meta data-n-head="ssr" http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta data-n-head="ssr" name="robots" content="index, follow" />
    <meta data-n-head="ssr" data-hid="og:site_name" key="og:site_name" property="og:site_name" name="og:site_name" content="{{ $globalsettings->site_name }}">
    <meta data-n-head="ssr" data-hid="og:locale" key="og:locale" property="og:locale" name="og:locale" content="en">
    <meta data-n-head="ssr" data-hid="og:type" key="og:type" property="og:type" name="og:type" content="website">
    <meta data-n-head="ssr" data-hid="image:width" key="image:width" property="image:width" name="image:width" content="400">
    <meta data-n-head="ssr" data-hid="image:height" key="image:height" property="image:height" name="image:height" content="400">
    <meta data-n-head="ssr" data-hid="robots" key="robots" property="robots" name="robots" content="all">
    <meta data-n-head="ssr" data-hid="image:alt" key="image:alt" property="image:alt" name="image:alt" content="High quality comics and more with {{$globalsettings->site_name}}!">
    <link data-n-head="ssr" rel="icon" type="image/x-icon" href="{{$globalsettings->favicon}}">

    <link data-n-head="ssr" rel="canonical" href="{{$globalsettings->site_url}}" />

    <meta data-n-head="ssr" name="og:site_url" content="{{$globalsettings->site_url}}" />
    <meta data-n-head="ssr" name="twitter:site_url" content="{{$globalsettings->site_url}}" />
    <meta data-n-head="ssr" name="twitter:creator" content="@Mimo" />
    <meta data-n-head="ssr" name="twitter:site_name" content="{{$globalsettings->site_name}}" />

    <meta data-n-head="ssr" data-hid="publisher" key="publisher" property="publisher" name="publisher" content="Mimo" />
    <!-- Fonts -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/reader.css') }}">

    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
    @inertiaHead
</head>

<body class="font-sans antialiased">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{$globalsettings->tag_manager}}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @inertia

    <div hidden>
        {{$globalsettings->adsense}}
    </div>

</body>

</html>