@extends('admin.layouts.base')
@section("content")
<div class="container">
    <div class="">Welcome {{Session::get('user')['name']}}</div>
    <div class="row margin-y-md">
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="/admin/wallets">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <div> edit wallets</div>
                    </a>
                    
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        <div>edit products</div>
                    </a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                <a href="">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <div>edit profile</div>
                </a>
                </div>
              </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="">
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                        <div>Settings</div>
                    </a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection