<table>
    <thead>
        <tr>
        <th style="width: 150px">ชื่อ/นามสกุล ช่าง </th>
        <th style="width: 150px">ชื่อ/นามสกุล ลูกค้า </th>
            <th style="width: 150px">เบอร์ติดต่อ ลูกค้า </th>
            <th style="width: 150px">ร้านค้า </th>
            <th style="width: 150px">ชื่อรุ่น(indoor) </th>
            <th style="width: 150px">หมายเลขเครื่องปรับอากาศ(indoor) </th>
            <th style="width: 150px">ชื่อรุ่น(outdoor) </th>
            <th style="width: 150px">หมายเลขเครื่องปรับอากาศ(outdoor) </th>
            <th style="width: 150px">คะแนนที่ได้รับ </th>
            <th style="width: 150px">วันที่และเวลาในการติดตั้ง </th>
            <th style="width: 150px">ช่วงเวลาที่เลือก Start </th>
            <th style="width: 150px">ช่วงเวลาที่เลือก End </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$item)
        <tr>
        <?php  $name=App\Models\Customer::where('id',$item->customer_id)->first();
         $users=App\User::where('id',@$name->mechanic_id)->first();  
         $market=App\Models\market::where('id',@$users->id_market)->first();
        ?>
        <td>{{@$users->name}} {{@$users->lastname}}</td>
            <td>{{@$name->full_name}}</td>
            <td>{{@$name->phone}}</td>
            <td>{{@$market->titleth}}</td>

            <td>{{$item->in_name}}</td>
            <td>{{$item->indoor_number}}</td>

            <td>{{$item->out_name}}</td>
            <td>{{$item->outdoor_number}}</td>
            <td>{{$item->point}}</td>
            <td>{{$item->created_at}}</td>
            
            <td>{{$date_s}}</td>
            <td>{{$date_e}}</td>
        </tr>
        @endforeach

    </tbody>
</table>