<div class="item box-shadow">
    <div id="carousel-_{{$property->id}}" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
        <div class="featured-sign">
            {{ $static_data['strings']['featured'] }}
        </div>
        <div class="price">
            <span class="currency"></span> {{ currency((int)$property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency')) }} <span class="currency"> {{ $static_data['strings']['per_night'] }}</span>
        </div>
        @if(count($property->images))
        <div class="carousel-inner" role="listbox">
            <?php $c = 0; ?>
            @foreach($property->images as $image)
                <div class="carousel-item @if(!$c) active <?php $c++; ?> @endif">
                    <img class="responsive-img" src="{{ URL::asset('images/data').'/'.$image->image }}"/>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel-_{{$property->id}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">{{$static_data['strings']['previous']}}</span>
        </a>
        <a class="carousel-control-next" href="#carousel-_{{$property->id}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">{{$static_data['strings']['next']}}</span>
        </a>
        @else
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="responsive-img" src="{{ URL::asset('images/').'/no_image.jpg' }}"/>
                </div>
            </div>
        @endif
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
</div>