<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <meta name="keywords" content="" />
    <meta name=" description" content="" />
    <meta name="robot" content="index, follow" />
    <meta name="generator" content="brackets">
    <meta name='copyright' content='orange technology solution co.,ltd.'>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link type="image/ico" rel="shortcut icon" href="{{ asset('mobile/assets/img/favicon.ico') }}">

    <link rel="icon" href="{{asset('img/back.jpg')}}">
    @include('apk.stylesheet')
</head>

<body>
    {{-- @include('apk.header')  --}}



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Slider Banner</title>
        <style>
            html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .nav {
            width: 100%;
            height: 10%;
            background-color: #fff;
        }

        .nav img {
            object-fit: cover;
            padding: 10px 0px;
            padding-left: 150px;
            height: 100%;
        }

        .nav-left {
            gap: 20px;
            padding-right: 10px;
            display: flex;

        }

        .user_int {
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: center;
            height: 100%;
            font-size: 30px;
        }

        .user_int p {
            font-family: 'Itim', cursive;
            color: #black;
            flex-direction: row;
            align-items: center;
            margin: 0;
            padding: 0
        }

        .slider {
            width: auto;
            /* padding-left: 15%;
            padding-right: 15%; */
            height: 60%;
            justify-items: center;
            align-items: center;
            text-align: center;
            background-color: white;
            transition: all 0.5s;
        }

        .slider img {
            height: 100%;
        }

        .appbg {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 25%;
            
        }

        .footbg {
            width: 100%;
            background-color: #f8ec1e;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px 0;
            color: #fff;
            margin-top: auto;
            bottom: 0;
        }

        .icon img {
            padding: 10px;
        }

        .dow {
            display: flex;
            gap: 10px
            }

        .dow a img {
                width: auto;
                margin: 0px;
                height: 60px;
            }

        .footerbg{
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        @media only screen and (max-width: 600px) {

            .nav {
                width: 100%;
                height: 10%;
                background-color: #fff;
                text-align: center;
                align-items: center;
                justify-content: center;
            }

            .nav img {
                width: 15%;
                height: auto;
                padding: 0 !important;
            }

            .appbg {
                display: flex;
                flex-direction: column;
                justify-items: center;
                align-items: center;
                text-align: center;
                width: 100%;
                margin-top: 25%;                
            }

            .dow {
                margin: 5px;
                width: 100%;
                gap: 10px;
                display: block;
                align-items: center;
                justify-content: center;
            }

            .dow a {
                width: auto;
                margin: 0px;
                height: 30px;
                display: block;
                align-items: center;
                justify-content: center;
            }

            .dow a img{
                width: auto;
                margin: 0px;
                height: 50px;
            }

            .footbg {
                width: 100%;
                position: absolute;
                bottom: 0;
            }

            .img-foot {
                width: 200px;
            }

            .slider {
                width: 100%;
                /* padding: 25px 0; */
                height: auto;
            }

            .slider img {
                object-fit: cover;
                width: 100%;
                height: auto;
            }

            .app {
                width: 350px;
                border: #f8ec1e solid 3px;
            }

            .icon img {
                width: 40px;
                padding: 10px;
            }

            .user_int {
                display: flex;
                flex-direction: row;
                gap: 20px;
                align-items: center;
                height: 100%;
                font-size: 18px;
                text-align: center;
                align-items: center;
                justify-content: center;
            }

        }
        </style>
    </head>

    <body>
        <div class="nav">
            <img src="{{ asset('mobile\assets\img\2d-01-icon.png') }}" alt="">
            <div class="user_int">
                <p>Heavy One Click</p>
            </div>
        </div>

        <div class="slider">
            <img src="{{ asset('mobile\assets\img\ban.png') }}" alt="Team">
        </div>

        <div class="appbg">
            <div class="dow">
                <a href="{{ url('/download') }}" target="_blank"><img src="{{ asset('mobile\assets\img\GP.png') }}" alt=""></a><br>
                <a href="https://apps.apple.com/th/app/heavy-one-click-r2/id6463791677" target="_blank"><img src="{{ asset('mobile\assets\img\AS.png') }}" alt=""></a>
            </div>
        </div> 
    </body>

    </html>
    @include('apk.footer') 
    @include('apk.javascript') 
 
</body>

</html>