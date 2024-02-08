<table>
    <thead>
        <tr>
        <th style="width: 150px">ชื่อหลักสูตร</th>
        <th style="width: 150px">รอบหลักสูตร</th>
            <th style="width: 150px">ชื่อ - นามสกุล</th>
            <th style="width: 150px">ชื่อเล่น</th>
            <th style="width: 150px">เบอร์โทรศัพท์</th>
            <th style="width: 150px">สังกัดร้าน</th>
            <th style="width: 150px">วันที่ลงทะเบียน</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$item)
        <tr>
            <td>{{@$title}}</td>
            <td>{{@$turn}}</td>
            <td>{{$item->full_name}}</td>

            <td>{{$item->nickname}}</td>
            <td>{{$item->phone}}</td>

            <td>{{$item->agency}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
        @endforeach

    </tbody>
</table>