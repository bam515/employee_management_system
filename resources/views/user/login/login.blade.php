@extends('user.login.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">로그인</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="login_id" value="{{ old('login_id') }}"
                                   id="inputEmail" type="text" placeholder="name@test.com">
                            <label for="inputEmail">ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPassword"
                                   type="password" name="password" placeholder="Password">
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="inputRememberPassword" type="checkbox">
                            <label class="form-check-label" for="inputRememberPassword">비밀번호 기억하기</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="">비밀번호를 잊어버리셨나요?</a>
                            <a class="btn btn-primary" href="{{ route('login') }}">로그인</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{ route('join') }}">회원가입</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
