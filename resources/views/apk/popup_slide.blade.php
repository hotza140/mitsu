<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Card Slider</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css">
</head>

<style>
    /* body {
        min-height: 600px;
        width: 100%;
        font-family: karla;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        background-color: grey;
    } */

    .phone-viewport {
        width: 500px;
        height: 500px;
        overflow: hidden;
    }

    .carousel {
        width: 100%;
    }

    /* แก้ */
    .carousel-item-pop {
        text-align: left;
        gap: 15px;
        padding: 30px 10px;
        float: left;
        height: 400px;
    }

    .card {
        margin: 10px 0px;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        width: 200px;

        /* height: 400px; */
        /* background-color: #000; */
    }

    .card__image {
        overflow: hidden;
        position: relative;
        /* width: 200px; */
        height: 400px;

    }

    .card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translateX(0) scale(1) !important;
    }

    .popup_a {
        text-align: center;
    }

    .popup_a p {
        padding: 0;
        margin: 0;
    }

    @media only screen and (max-width: 600px) {}
</style>

<body>
    <div class="popup_a">
        <p>ตัวอย่าง วิธีติดตั้ง</p>
        <div class="phone-viewport">
            <div class="carousel">
                <div class="carousel-item-pop">
                    <div class="card">
                        <div class="card__image">&nbsp;
                            <img src="{{ asset('mobile\assets\img\2d-01-icon.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">1.ระบบเเนะนำให้สเเกนเเอป
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B01.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">2.กดปุ่มสเเกนแอป
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B02.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">3.รอระบบสเเกนแอปสักครู่
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B03.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">4.สแกนสำเร็จ กดติดตั้ง
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B04.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">5.ยืนยันการดาวน์โหลด APK
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B05.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">6.รอระบบสักครู่
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B06.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">7.ยืนยันการดาวน์โหลดแอป
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B07.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">8.รอระบบสักครู่
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B08.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="carousel-item-pop">9.ติดตั้งเสร็จพร้อมใช้งาน
                    <div class="card">
                        <div class="card__image">
                            <img src="{{ asset('mobile\assets\img\B09.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- เพิ่ม carousel-item-pop เพิ่มเติมหากต้องการ -->
            </div>
        </div>
        <button class="download-button" id="Download">Download</button>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>


    <script>
        var elem = document.querySelector('.carousel');
        var flkty = new Flickity(elem, {
            imagesLoaded: true,
            cellAlign: 'center',
            contain: true
        });

        var imgs = document.querySelectorAll(".card__image img");
        var docStyle = document.documentElement.style;
        var transformProp = typeof docStyle.transform == 'string' ? 'transform' : 'WebkitTransform';

        flkty.on('scroll', function() {
            flkty.slides.forEach(function(slide, i) {
                var img = imgs[i];
                var x = (slide.target + flkty.x) * -1 / 3;
                img.style[transformProp] = 'translateX(' + x + 'px) scale(1.3)';
            });
        });

        var Download = document.getElementById("Download");
        Download.onclick = function() {
            window.open("mobile/Heavy_One_Click.apk", "_blank");
        }
    </script>

</body>

</html>
