@extends('master')
@section("content")
<div class="custom-product">
     <div class="col-sm-10">
        <div class="trending-wrapper">
            <h4>List of Cards</h4>
            <a class="btn btn-success" href="addCC_Card">Add Card</a> <br> <br>
            @foreach($cards as $item)

            <div class=" row searched-item cart-list-devider">
             {{-- <div class="col-sm-3"> 
                <a href="detail/{{$item->id}}">
                    <img class="trending-image" src="{{$item->gallery}}">
                  </a>
             </div>
             <div class="col-sm-4">
                    <div class="">
                      <h2>{{$item->name}}</h2>
                      <h5>{{$item->description}}</h5>
                    </div>
             </div> --}}
             <div class="CC_Tiles">
                <div class="CC_Tile js-CC_tile">
                  <div class="CC_Tile-content CC_Tile-content--toggle js-toggle-CC_tile"
                    role="button"
                    tabindex="0"
                    aria-expanded="false"
                    aria-controls="edit-flyout-0">
                    <div class="CC_Card-image">
                      {{-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/62127/creditCC_Card-visa.svg" alt="Visa"> --}}
                    {{$item->provider}}
                    </div>
                    <pre class="CC_Card-code"><code>&#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679; &#9679;&#9679;&#9679;&#9679; 1234</code></pre>
                    <p class="CC_Card-expiry">{{$item->exp_date}}</p>
                  </div>
                  
                </div>
                
              </div>
             
                <a href="/removeCard/{{$item->id}}" class="btn btn-warning" >Remove to Card</a>
             
            </div>
            @endforeach
          </div>
          <a class="btn btn-success" href="">Add Card</a> <br> <br>

     </div>
</div>
@endsection