<table>
    <thead>
        <tr>
        <th style="width: 150px">ชื่อ/นามสกุล </th>
            <th style="width: 150px">เบอร์ติดต่อ </th>
            <th style="width: 150px">ร้านค้า </th>
            <th style="width: 150px">ชื่อรุ่น(indoor) </th>
            <th style="width: 150px">หมายเลขเครื่องปรับอากาศ(indoor) </th>
            <th style="width: 150px">ชื่อรุ่น(outdoor) </th>
            <th style="width: 150px">หมายเลขเครื่องปรับอากาศ(outdoor) </th>
            <th style="width: 150px">วันที่และเวลาในการติดตั้ง </th>
            <th style="width: 150px">ช่วงเวลาที่เลือก Start </th>
            <th style="width: 150px">ช่วงเวลาที่เลือก End </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data->data as $key=>$item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->market}}</td>

            <td>{{$item->in_name}}</td>
            <td>{{$item->indoor_number}}</td>

            <td>{{$item->out_name}}</td>
            <td>{{$item->outdoor_number}}</td>

            <td>{{$item->created_at}}</td>
            <td>{{$item->date_s}}</td>
            <td>{{$item->date_e}}</td>
        </tr>
        @endforeach

    </tbody>
</table>