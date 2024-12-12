<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <script>
        // ฟังก์ชันเปิด/ปิดเมนูดรอปดาวน์
        function toggleDropdown() {
            document.getElementById("dropdownMenu").classList.toggle("show");
        }

        // ปิดเมนูดรอปดาวน์เมื่อคลิกนอกเมนู
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-image') && !event.target.closest('.dropdown-menu')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

    <title>Document</title>

    <style>
        .nav {
            position: fixed;
            width: 100%;
            height: 100px;
            background-color: #fff;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .nav img {
            /* width: 175px;
            height: 175px; */
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
            color: #BD2325;
            flex-direction: row;
            align-items: center;
            margin: 0;
            padding: 0
            
            
        }

    </style>


</head>

<body>
    <div class="nav">
        <img src="{{ asset('mobile\assets\img\logo_sexy.png') }}" alt="">
            <div class="user_int">
                <p>UNIVERSE</p>
            </div>
        </div>



    </div>
</body>

</html>