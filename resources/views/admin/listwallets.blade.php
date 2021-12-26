@extends('admin.layouts.base')
@section("content")
<div class="container">
    <div class="table-responsive"> 
        <form action="setlimit" method="POST" >   
        @csrf    
        <table class="table">
          <thead>
            <tr>
              <th>User</th>
              <th>Current Limit</th>
              <th>Input Limit</th>
              <th>Set Limit</th>
              <th>Reset Limit</th>
              <th>Print Report</th>
            </tr>
          </thead>
          <tbody>
        @foreach ($wallets as $item)
            <tr>
                <td>{{$item->user->name}}</td>
                <td>{{$item->wallet_limit}}</td>
                <td>
                    <input type="text" name="limit" class="form-control" id="exampleInputLimit1" placeholder="{{$item->wallet_limit}}">
                    <input type="hidden" name="wallet_id" value="{{$item->id}}">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        Set Limit
                    </button>
                </td>
                <td>
                    <a href="resetlimit/{{$item->id}}">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        Reset Limit
                    </a>
                </td>
                <td>
                    <a href="printreport/{{$item->user->id}}">
                        <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                        print report
                    </a>
                </td>
            </tr>  
        @endforeach 
          </tbody>
        </table>
        </form>
        </div>
      </div>
</div>
@endsection