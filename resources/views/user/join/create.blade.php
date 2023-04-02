@extends('user.join.layout')
@section('content')
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
            <div class="card rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">정보 입력</h3>

                    <form class="px-md-2">
                        <div class="form-floating mb-4">
                            <input type="text" id="login_id" class="form-control" name="login_id">
                            <label class="form-label" for="login_id">아이디</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" id="password" class="form-control" name="password">
                            <label class="form-label" for="password">비밀번호</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="name" class="form-control" name="name">
                            <label class="form-label" for="name">이름</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" class="form-control" id="birth">
                            <label for="birth" class="form-label">생년월일</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="phone" name="phone" class="form-control">
                            <label for="phone" class="form-label">연락처</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="address1" name="address1" class="form-control"
                                   onclick="findAddress()" readonly>
                            <label for="address1" class="form-label">주소</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="address2" name="address2" class="form-control">
                            <label for="address2" class="form-label">상세주소</label>
                        </div>
                        <button type="button" class="btn btn-success btn-lg mb-1" onclick="join()">회원가입</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // 주소 검색
        function findAddress() {
            new daum.Postcode({
                oncomplete: function (data) {
                    document.getElementById('address1').value = data.address;
                }
            }).open();
        }

        // 회원가입
        function join() {
            var login_id = document.getElementById('login_id').value;
            var password = document.getElementById('password').value;
            var name = document.getElementById('name').value;
            var birth = document.getElementById('birth').value;
            var phone = document.getElementById('phone').value;
            var address1 = document.getElementById('address1').value;
            var address2 = document.getElementById('address2').value;

            if (login_id.trim().length === 0) {
                alert('아이디를 입력해주세요.');
                return false;
            } else if (password.trim().length === 0) {
                alert('비밀번호를 입력해주세요.');
                return false;
            } else if (name.trim().length === 0) {
                alert('이름을 입력해주세요.');
                return false;
            } else if (birth.trim().length === 0) {
                alert('생년월일을 입력해주세요.');
                return false;
            } else if (phone.trim().length === 0) {
                alert('연락처를 입력해주세요.');
                return false;
            } else if (address1.trim().length === 0) {
                alert('주소를 입력해주세요.');
                return false;
            } else if (address2.trim().length === 0) {
                alert('상세주소를 입력해주세요.');
                return false;
            }

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '/join',
                type: 'post',
                data: {
                    'name': name,
                    'birth': birth,
                    'phone': phone,
                    'address': address1 + ' ' + address2,
                    'login_id': login_id,
                    'password': password
                },
                success: function (res) {
                    if (res.code === 200) {
                        alert('회원가입이 완료되었습니다. 로그인은 회원가입 승인 후 가능합니다.');
                        location.href = '{{ route('home') }}';
                    } else {
                        alert('회원가입 실패');
                        console.log(res);
                    }
                },
                error: function (request, status, error) {
                    console.log('code: ' + request.status + '\n' +
                        'message: ' + request.responseText + '\n' +
                        'error: ' + error);
                }
            })
        }
    </script>
@endsection
