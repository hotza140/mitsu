!DOCTYPE html>
<html lang="TH">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>PDF WORK</title>


        <!-- Styles -->

<style>
        /* @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
        html, body {
            font-family: "THSarabunNew";
        } */

        html, body {
            font-family: "Garuda";
        }
    </style>

    </head>
    <body>

    <?php  $data=App\WO::where('id',$id)->first();  ?>

    @if($data)
    <div class="page-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">


                                <div class="card-header">
                                </div>


                                <div class="card-block">

                                    <div class="dt-responsive table-responsive text-center">
                                    <center><img src="{{asset('img/back.jpg')}}" width="200px"></center>
                                    <br><br>
                                    </div>

                                    <div class="text-right">
                                    <p>เลขที่ใบงาน : NAV27042566</p>
                                    </div>

                                </div>

                                
                            </div>
                        </div>

                    </div>
    </div>
    @else

    <center><h2>ไม่พบข้อมูลงาน?!</h2></center>
    @endif


    </body>
</html>
