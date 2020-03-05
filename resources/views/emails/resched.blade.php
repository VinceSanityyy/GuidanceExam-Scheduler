@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		<h4 class="secondary"><strong>UMTC Guidance Office</strong></h4>
		<p>Your request from the guidance office has been rescheduled on {{$date}} from {{$from}} to {{$to}}.</p>

	@include('beautymail::templates.widgets.articleEnd')
@stop