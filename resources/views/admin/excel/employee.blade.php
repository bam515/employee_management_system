<table>
    <thead>
    <th>사번</th>
    <th>이름</th>
    <th>생년월일</th>
    <th>연락처</th>
    <th>주소</th>
    <th>입사일</th>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr>
            <td>{{ $row->emp_no }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ date('Y.m.d', strtotime($row->birth)) }}</td>
            <td>{{ $row->phone }}</td>
            <td>{{ $row->address }}</td>
            <td>{{ $row->join_date !== null ? date('Y.m.d', strtotime($row->join_date)) : '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
