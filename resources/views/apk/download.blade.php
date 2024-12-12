<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="icon" href="{{asset('img/back.jpg')}}">

    <title>Heavy One Click - Google Play Store</title>
    <style>
        body {
            width: 100%;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 0;
            margin: 0;
            position: sticky;
            width: 100%;
            height: 65px;
            top: 0;
            transition: all 0.5s;
            /* box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); */
        }

        .header.scrolled {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 0;
            margin: 0;
            position: sticky;
            width: 100%;
            height: 65px;
            top: 0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header div {
            display: flex;
            gap: 20px;
            font-size: 15px;
            color: #878A8D;
        }

        .header img {
            height: 125px;
            padding: 0px 15px;
        }

        .header-act {
            color: #349F7F;
        }





        .container {
            max-width: 70%;
            padding: 0% 15%;
            background-color: #fff;
            margin: 80px 30px;
        }

        .download {
            width: 100%;
            display: flex;
            align-items: center;
        }

        .download img {
            width: 190px;
            height: 190px;
        }

        .app-icon {
            width: 80px;
            height: 80px;
            border-radius: 20%;
            margin-right: 20px;
        }

        .app-info {
            flex-grow: 1;
        }

        .name-app {
            font-size: 48px;
            font-weight: 700;
            font-family: 'ABeeZee';
            padding: 0;
            margin: 0;
        }

        .company-name {
            color: #4caf50;
            font-size: 18px;
            font-weight: 500;
            padding: 10px 0px;
        }

        .stats-all {
            display: flex;
            bottom: 0;
            padding: 10px 0px;
            align-items: end;
        }

        .stats {
            font-size: 14px;
            color: #777;
            margin: 0px;
            padding: 0px 10px;
            text-align: center;
        }

        .stats p {
            margin: 0;
            padding: 0;
        }

        .stats p b {
            color: #000;
        }

        .stats img {
            object-fit: scale-down;
            width: 100%;
            height: 30px;
        }

        .type {
            display: block;
            align-items: center;
        }

        .type p img {
            padding: 0px 5px;
            width: 10px;
            height: 10px;
        }

        .plus {
            width: 100%;
            height: 100%;
        }

        .download-button {
            justify-content: center;
            background-color: #01875F;
            color: #fff;
            height: 40px;
            padding: 0px 60px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin: 10px 0px;
        }

        .download-button:hover {
            background-color: #016C4C;
        }

        .share {
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            gap: 10px;
        }

        .share p {
            font-size: 14px;
            display: flex;
            text-align: center;
            color: #01875F;
            font-weight: 600;
            justify-content: center;
        }

        .share img {
            height: 25px;
            width: 25px;
        }

        .tab-download {
            gap: 30px;
            display: flex;
        }

        .image-carousel {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .carousel-item {
            background-color: #ddd;
            border-radius: 8px;
            display: inline-block;
            overflow: hidden;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #666;
            margin: 10px;
            box-shadow: 4px 4px 8px #EBEBEB;
        }

        .carousel-item img {
            display: block;
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
            height: auto;
            box-shadow: 2px 2px 6px #EBEBEB;
        }

        .content-section {
            margin-top: 20px;
        }

        .content-section h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .content-section p {
            font-size: 14px;
            line-height: 1.6;
            color: #555;
        }

        .footer {
            /* display: flex;
            align-items: center;
            justify-content: center; */
            width: 67%;
            padding-left: 18%;
            padding-right: 15%;
            font-size: 12px;
            color: #878A8D;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
        }

        .footer-t {
            padding-right: 150px;
        }

        .footer-one {
            padding-top: 30px;
            display: flex;
        }

        .footer-nav {
            display: flex;
            gap: 40px;
            padding-top: 30px;
        }


        .info {
            padding: 0px 50px;
            font-family: 'Roboto', sans-serif;
        }

        .apprd {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .apprd img {
            width: 15px;
            height: 15px;
        }

        .content-section .text {
            /* font-family: 'Itim', cursive; */
            font-weight: 500;
            font-size: 25px;
        }

        /* แก้ */
        .popup_box {
            display: flex;
            position: absolute;
            min-height: 600px;
            width: 40%;
            left: 30%;
            top: 10%;
            border-radius: 10px;
            font-family: karla;
            align-items: center;
            justify-content: center;
            margin: 0;
            background-color: #fff;
        }

        .modal {
            /* opacity: 1; */
            visibility: hidden;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            overflow: unset;
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #747474;
            /* float: right; */
            position: fixed;
            top: 12%;
            left: 67%;
            font-size: 28px;
            font-weight: bold;
            z-index: 50;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .head-icon span {
            display: none;
        }

        .box-icon {
            height: 260px;
            width: 260px;
        }

        .box-icon img {
            height: 260px;
            width: 260px;
        }

        @media only screen and (max-width: 600px) {

            .popup_box {
                display: flex;
                position: absolute;
                min-height: 600px;
                width: 100%;
                left: 0;
                top: 10%;
                border-radius: 10px;
                font-family: karla;
                align-items: center;
                justify-content: center;
                margin: 0;
                background-color: #fff;
            }

            .close {
                top: 12%;
                left: 90%;
            }

            .container {
                max-width: 100%;
                padding: 0% 0%;
                background-color: #fff;
                margin: 20px 30px;
            }

            .download {
                width: 100%;
                display: flex;
                align-items: center;
            }


            .header.scrolled {
                justify-content: space-between;
                display: flex;
                align-items: center;
                background-color: #fff;
                padding: 0;
                margin: 0;
                position: sticky;
                width: 100%;
                height: 55px;
                top: 0;
                z-index: 1000;
            }

            .header.scrolled {
                justify-content: space-between;
                display: flex;
                align-items: center;
                background-color: #fff;
                padding: 0;
                margin: 0;
                position: sticky;
                width: 100%;
                height: 55px;
                top: 0;
                z-index: 1000;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }

            .header div {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                font-size: 15px;
                color: #878A8D;
            }

            .header div p {
                display: none;

            }

            .stats-all {
                position: relative;
                display: flex;
                left: -105px;
            }

            .stats img {
                object-fit: scale-down;
                width: 100%;
                height: 18px;
            }

            .stats p {
                font-size: 10px;
            }

            .app-icon {
                width: 90px !important;
                height: 90px !important;
                border-radius: 20%;
                margin-right: 20px;
                margin-top: 15px;
            }

            .name-app {
                font-size: 22px;
                font-family: 'ABeeZee';
                padding: 0;
                margin: 0;
            }

            .company-name {
                color: #4caf50;
                font-size: 16px;
                padding-top: 5px;
                padding-bottom: 30px;
            }

            .download {
                padding-top: 20px;


            }

            .download-button {
                position: relative;
                justify-content: center;
                background-color: #01875F;
                color: #fff;
                height: 35px;
                padding: 0px 15%;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 12px;
                margin: 10px 0px;

            }

            .share{
                position: relative;
                left: 0;
            }

            .share img {
                width: 15px;
                height: 15px;
            }

            .share p {
                font-size: 8px;
                padding-right: 50px;
            }

            .tab-download {
                position: absolute;
                top: 320px;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100%;
                gap: 30px;
                display: block;
                text-align: center;
            }

            .info {
                padding: 0px 0px;
            }

            .image-carousel-box{
                overflow: scroll;
            }

            .image-carousel {
                height: auto;
                width: 400px;
                display: flex;
            }

            .carousel-item {
                display: inline-block;
                background-color: #ddd;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #666;
                margin: 20px 2px;
            }

            .carousel-item img {
                object-fit: cover;
                border-radius: 10px;
                width: 100%;
                gap: 20px;
                box-shadow: 2px 2px 6px #EBEBEB;
            }

            .footer {
                width: 90%;
                padding-left: 5%;
                padding-right: 5%;
                height: 100%;
                font-size: 12px;
                color: #878A8D;
                box-shadow: 8px 0px 0px rgba(0, 0, 0, 0.1);
            }

            .footer-t {
                padding: 0% 13%;
            }

            .footer-t p {
                width: 100px;
            }

            .footer-th {
                margin-top: 20px;
                padding-right: 20%;
                padding-left: 12%;
            }

            .footer-th p {
                width: 100px;
            }

            .footer-nav {
                display: none;
            }

            .head-icon .material-symbols-outlined {
                display: block;
                width: 60%;
                color: rgb(95, 99, 104);
            }

            .head-icon {
                text-align: right;
                right: 0;
            }

            .app-info {
                /* position: relative;
                top: -40px; */
                margin-top: -80px;
                order: 2;
            }

            .box-icon {
                width: 120px;
            }

            .footer-one {
                padding-top: 30px;
                display: block;
            }

        }
    </style>
 
</head>

<body>
    <div class="header">
        <img src="{{ asset('mobile\assets\img\google play img.webp') }}" alt="">
        <div class="head-icon">
            <span class="material-symbols-outlined">search</span>
            <span class="material-symbols-outlined">help</span>
            <span class="material-symbols-outlined">account_circle</span>
        </div>
        <div>
            <p>เกม</p>
            <p class="header-act">แอป</p>
            <p>ภาพยนตร์</p>
            <p>หนังสือ</p>
            <p>เด็ก</p>
        </div>
    </div>
    <div class="container">

        <div class="download">
            <div class="app-info">
                <div class="name-com">
                    <p class="name-app">Heavy One Click</p>
                    <div class="company-name">Company</div>
                </div>
                <div class="stats-all">
                    <div class="stats">
                        <img src="{{ asset('mobile\assets\img\100+.png') }}" class="plus">
                        <div class="type">
                            <p>ดาวน์โหลด</p>
                        </div>
                    </div>



                    <div class="stats">
                        <div class="type">
                            <img src="{{ asset('mobile\assets\img\17+.png') }}" alt="">
                            <p>ประเภท 17+<img src="{{ asset('mobile\assets/img/info.png') }}" alt=""></p>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-download">
                    <button class="download-button" id="myBtn">Download</button>

                    <div class="share">
                        <a href="javascript:void(0)" onclick="shareURL()"><img
                                src="{{ asset('mobile\assets\img\share.png') }}" alt=""></a>
                        <p>แชร์</p>
                        <img src="{{ asset('mobile\assets\img\tag.png') }}" alt="">
                        <p>เพิ่มเป็นสิ่งที่อยากได้</p>
                    </div>
                </div>
            </div>
            <div class="box-icon">
                <img src="{{ asset('mobile\assets\img\2d-02.png') }}" alt="App Icon" class="app-icon">
            </div>
        </div>

        <div class="image-carousel-box">
            <div class="image-carousel">
                <div class="carousel-item"><img src="{{ asset('mobile\assets\img\11.png') }}" alt=""></div>
                <div class="carousel-item"><img src="{{ asset('mobile\assets\img\22.png') }}" alt=""></div>
                <div class="carousel-item"><img src="{{ asset('mobile\assets\img\33.png') }}" alt=""></div>
            </div>
        </div>


        <div class="info">
            <div class="apprd">
                <img src="{{ asset('mobile\assets\img\pc.png') }}" alt="">
                <p>แอปนี้พร้อมใช้งานบนอุปกรณ์ทุกเครื่องของคุณ</p>
            </div>
            <div class="content-section">
                <p class="text">เกี่ยวกับแอปนี้</p>
                <p>คำอธิบายย่อ</p>
                <p>Heavy One Click R2 เป็นแอพพลิเคชันที่คอยช่วยเหลือช่างที่ดูแลแอร์ Mitsubishi Heavy Duty ให้ง่ายและสะดวกมากยิ่งขึ้น ด้วยคลิกเดียวเท่านั้น
                     แอร์จะได้รับการบำรุงรักษาและแก้ไขปัญหาอย่างมืออาชีพ แอพนี้ไม่เพียงแค่ช่วยให้คุณติดตามและจัดการกับแอร์ของคุณได้โดยรวดเร็วและง่ายดาย 
                     แต่ยังมีฟังก์ชันการสะสมคะแนนที่ท้าทายและน่าสนใจ</p>
            </div>

            <div class="content-section">
                <p class="text">ความปลอดภัยของข้อมูล</p>
                <p>ความปลอดภัยเริ่มต้นด้วยความเข้าใจเกี่ยวกับวิธีที่นักพัฒนาแอปรวบรวมและแชร์ข้อมูล
                    แนวทางปฏิบัติด้านความเป็นส่วนตัวและความปลอดภัยของข้อมูลอาจแตกต่างกันไปตามการใช้งาน ภูมิภาค
                    และอายุของคุณ นักพัฒนาแอปได้ให้ข้อมูลนี้ไว้และอาจอัปเดตข้อมูลในส่วนนี้เมื่อเวลาผ่านไป</p>
            </div>
        </div>

    </div>
    <div class="footer">
        <div class="footer-g">
            <div class="footer-one">
                <div class="footer-t">
                    <p><b>Google Play</b></p>
                    <p>Play Pass</p>
                    <p>Play Points</p>
                    <p>บัตรของขวัญ</p>
                    <p>แลก</p>
                    <p>นโยบายการคืนเงิน</p>
                </div>

                <div class="footer-th">
                    <p><b>เด็กและครอบครัว</b></p>
                    <p>คำแนะนำสำหรับผู้ปกครอง</p>
                    <p>การแชร์ในครอบครัว</p>
                </div>
            </div>

            <div class="footer-nav">
                <p>ข้อกำหนดในการให้บริการ</p>
                <p>ความเป็นส่วนตัว</p>
                <p>เกี่ยวกับ Googlt Play</p>
                <p>นักพัฒนาแอป</p>
                <p>Google Store</p>
                <p>ราคาทั้งหมดรวม VAT</p>
            </div>
        </div>

    </div>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <div class="popup_box">
            @include('apk.popup_slide')
        </div>
    </div>
</body>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.visibility = "visible"; 
    }

    span.onclick = function() {
        modal.style.visibility = "hidden";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.visibility = "hidden";
        }
    }

    function shareURL() {
        const url = "https://heavyoneclick.com/download";

        if (navigator.share) {
            navigator.share({
                    title: 'Download Link',
                    text: 'Check out this link:',
                    url: url
                })
                .then(() => console.log('Successfully shared'))
                .catch((error) => console.error('Error sharing:', error));
        } else {
            copyToClipboard(url);
            alert('Link copied to clipboard: ' + url);
        }
    }

    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    }

    window.addEventListener("scroll", function() {
            const header = document.querySelector(".header");
            if (window.scrollY > 50) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });
</script>

</html>
