@extends('layouts.owner')

@section('title')
    <title>{{ get_string('faq') }}</title>
@endsection

@section('page_title')
    <h3 class="page-title mbot10">{{get_string('faq')}}</h3>
@endsection
@section('content')
    <div class="row mbot0">
        <div class="col s12">
            <div class="col s12">
                <ul class="collapsible collapsible-accordion">
                @foreach($faqs as $faq)
                    <li>
                        <div class="collapsible-header"><span>{{ $faq->contentDefault->question }}</span><i class="material-icons small accordion-active">remove_circle</i><i class="material-icons small accordion-disabled">add_circle</i></div>
                        <div class="collapsible-body">
                            {{ $faq->contentDefault->answer }}
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection