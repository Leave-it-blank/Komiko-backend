<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name=”robots” content=”noindex, nofollow”>
        <!-- Fonts -->
       <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/reader.css') }}">

        <!-- Scripts -->
      
       
    </head>
    <body class="font-sans antialiased bg-neutral-900 min-h-screen text-white" >
        <div class="container mx-auto p-10 ">
            <div class="flex justify-center items-center h-screen gap-5" >
                 
                <a href="/login" class="mx-2 rounded-md"><button class="px-3 py-2 bg-purple-500 rounded-md"> Login</button></a>
                <a href="/register" class="mx-2 rounded-md"><button class="px-3 py-2 bg-purple-500 rounded-md"> Register</button></a>
                <a href="/admin/dashboard" class="mx-2 rounded-md"><button class="px-3 py-2 bg-purple-500 rounded-md"> Dashboard</button></a>
            </div>
        </div>
          
    </body>
</html>
