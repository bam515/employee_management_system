@extends('admin.login.layout')

@section('content')
    <form>
        <div class="form-outline mb-4">
            <input type="text" id="login_id" class="form-control" name="login_id">
            <label class="form-label" for="login_id">ID</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control">
            <label class="form-label" for="password">Password</label>
        </div>

        <button type="button" class="btn btn-primary btn-block mb-4">Login</button>
    </form>
@endsection
