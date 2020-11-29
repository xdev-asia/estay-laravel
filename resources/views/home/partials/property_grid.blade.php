      <div class="item">
          <a href="{{url('/property').'/'.$property->alias}}" class="item-img">
              
        @if(count($property->images))
                    <img class="responsive-img" src="{{ URL::asset('images/data').'/'.$property->images[0]->image }}"/>
        @else
                    <img class="item-thumb" src="{{ URL::asset('images/').'/no_image.jpg' }}"/>
        @endif

          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg"/>18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="{{url('/property').'/'.$property->alias}}">{{ $property->contentload->name }}</a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                {{-- <div class="text-muted">11.254.000đ</div> --}}
                <p class="lead mb-0">{{ currency((int)$property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency')) }} <span class="currency"> {{ $static_data['strings']['per_night'] }}</p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="{{url('/property').'/'.$property->alias}}" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg"/>
              50 người mua
            </div>
          </div>
        </div>

{{-- <div class="item box-shadow">
    <div id="carousel-_{{$property->id}}" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
        <div class="featured-sign">
            {{ $static_data['strings']['featured'] }}
        </div>
        <div class="price">
            <span class="currency"></span> </span>
        </div>
    </div>
    <div class="data">
        <a href="{{url('/property').'/'.$property->alias}}"><h3 class="item-title primary-color">{{ $property->contentload->name }}</h3></a>
        <div class="item-category">{{$property->location['address'].', '.$property->location['city'] .' - '. $property->location['country']}}</div>
        <div class="item-category">{{ $static_data['strings']['category'] .': '. $property->category->contentload->name .' | ' }}
            {{ $static_data['strings']['location'] .': '. $property->prop_location->contentload->location }}</div>                        <div class="item-category">{{ $static_data['strings']['size'] .': '. $property->property_info['size'] . ' '. $static_data['site_settings']['measurement_unit']. ' | '}}
            {{ $static_data['strings']['rooms'] .': '. $property->rooms .' | '}}
            {{ $static_data['strings']['guests'] .': '. $property->guest_number}}</div>
        @if($property->user)<div class="small-text">{{ $static_data['strings']['posted_by'] .': '. $property->user->username }}</div>@endif
    </div>
</div> --}}