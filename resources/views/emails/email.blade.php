@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		<h4 class="secondary"><strong>UMTC Guidance Office</strong></h4>
		<p>Good Day! This is to inform that your schedule for consultation is on {{$date}} from {{$from}} to {{$to}}. Kindly go to the guidance office for more information.</p>

	@include('beautymail::templates.widgets.articleEnd')
@stop