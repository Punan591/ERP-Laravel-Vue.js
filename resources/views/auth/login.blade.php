<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punan Chowdhury Creation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition login-page" style="background-color:#000000;">
    <div id="app">
        <router-view>
            <Login />
        </router-view>
    </div>
</body>

</html>
