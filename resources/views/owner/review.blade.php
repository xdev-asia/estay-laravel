@extends('layouts.owner')

@section('title')
    <title>{{get_string('reviews') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection
@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('reviews')}}</h3>
@endsection
<div class="col s12">
    @if($reviews->count())
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th>{{get_string('username')}}</th>
                    <th>{{get_string('review')}}</th>
                    <th>{{get_string('item')}}</th>
                    <th>{{get_string('status')}}</th>
                    <th>{{get_string('rating')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="{{$review->id}}" />
                            <label for="{{$review->id}}"></label>
                        </td>
                        <td>@if($review->user){{$review->user->username}}@else <i class="small material-icons color-red">clear</i> @endif</td>
                        <td>{{ str_limit($review->review, 50, '...')}} <a href="#review-modal" data-toggle="modal" data-id="{{$review->id}}" class="more-button"><i class="small material-icons color-primary">add</i></a></td>
                        <td>@if($review->property_id && $review->property){{$review->property->contentDefault->name}}@elseif($review->service_id && $review->service){{ $review->service->contentDefault->name }}@else<i class="small material-icons color-red">clear</i> @endif</td>
                        <td class="review-status">{{$review->status ? get_string('approved') : get_string('pending')}}</td>
                        <td><?php for($i = 0; $i < $review->rating; $i++) echo '<i class="small material-icons color-yellow">grade</i>' ?></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$reviews->links()}}
    @else
        <strong class="center-align">{{get_string('no_results')}}</strong>
    @endif
</div>
<input type="hidden" class="token" value="{{ csrf_token() }}">
@endsection
@section('footer')
    <div id="review-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title">{{get_string('full_review')}}</strong>
                </div>
                <div class="modal-body" id="full-review"></div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal">{{get_string('close')}}</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#review-modal").on('hidden.bs.modal', function () {
                $('#full-review').html('');
            });
            $('.more-button').click(function(){
                var id = $(this).data('id');
                var token = $('.token').val();
                $.ajax({
                    url: '{{ url('/owner/review/getReview') }}/'+id,
                    type: 'post',
                    data: {_token :token},
                    success:function(msg) {
                        $('#full-review').html(msg);
                    },
                    error:function(msg){
                        toastr.error(msg.responseJSON);
                    }
                });
            });
        });
    </script>
@endsection
