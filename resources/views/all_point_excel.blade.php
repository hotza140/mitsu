<table>
    <thead>
        <tr>
        <th style="width: 150px">เลขที่คำขอ</th>
        <th style="width: 150px">วันที่แลกแต้ม</th>
            <th style="width: 150px">ชื่อช่าง</th>
            <th style="width: 150px">ชื่อสินค้า </th>
            <th style="width: 150px">คะแนนที่ใช้</th>
            <th style="width: 150px">คะแนนก่อนใช้</th>
            <th style="width: 150px">คะแนนหลังใช้</th>
            <th style="width: 150px">สถานะ</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$itts)
        <tr>
        <td>{{$itts->number}}</td>
        <td>{{$itts->date}}</td>
        <?php $p1=App\User::where('id',$itts->id_user)->first();  ?>
        <td>{{($p1->name)?? '-'}} {{($p1->lastname)?? '-'}}}</td>
        <td>{{$itts->title}}</td>
        <td>{{$itts->buy_point}}</td>
        <td>{{$itts->old_point}}</td>
        <td>{{$itts->bl_point}}</td>
        @if($itts->status==0)
        <td style="color: green;">กำลังรอยืนยัน</td>
        @elseif($itts->status==2)
        <td style="color: red;">ไม่อนุมัติ</td>
        @else
        <td style="color: grey;">อณุมัติ</td>
        @endif
        </tr>
        @endforeach

    </tbody>
</table>