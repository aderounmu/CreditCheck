@extends('master')
@section("content")
<div class="container custom-login">
    <div class="row">
        @if (isset($myerror) && $myerror['isError'])
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> {{$myerror['Message']}}
        </div>
        @endif
        <div class="col-sm-4 col-sm-offset-4">
            <form action="register" method="POST" >
                <div class="form-group">
                    @csrf
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"> verify password</label>
                    <input type="v_password" name="v_password" class="form-control" id="exampleInputPassword2" placeholder="verify Password">
                </div>
                <button type="submit" class="btn btn-default">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection