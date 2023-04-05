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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#access_popup">승인</button>
                    <button type="button" class="btn btn-danger">반려</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="access_popup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function accessEmployee(no) {

        }

        function rejectEmployee(no) {

        }
    </script>
@endsection
