@extends('admin.employee.wait.layout')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">이름</th>
            <th scope="col">생년월일</th>
            <th scope="col">연락처</th>
            <th scope="col">주소</th>
            <th scope="col">-</th>
        </tr>
        </thead>
        <tbody>
        @php
            $no = $rows->total() - (($rows->currentPage() - 1) * $rows->perPage())
        @endphp
        @foreach($rows as $row)
            <tr>
                <th scope="row">{{ $no-- }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ date('Y.m.d', strtotime($row->birth)) }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->address }}</td>
                <td>
                    <button type="button" class="btn btn-primary"
                            onclick="accessEmployee({{ $row->user_id }})">승인</button>
                    <button type="button" class="btn btn-danger"
                            onclick="rejectEmployee({{ $row->user_id }})">반려</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

