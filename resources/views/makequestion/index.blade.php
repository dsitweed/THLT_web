@extends('layouts.app')

{{-- $examinfo truyen tu controller --}}
@section('content')

 <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-4" style="width:550px;font-weight:bold;">
	 <h2 style="color: green">Your Question Set is complete</h2>
	  <!-- Trigger the modal with a button -->
	  <a href="/"><button type="button" class="btn btn-info btn-lg btn-block"> Back To Home </button></a><br>
	  <form action="/makequestion/{{$examinfo->id}}/edit" method="get">
		@csrf
		
		<input type="hidden" name="uniqueid" value="{{$examinfo->id}}">
	  	<button type="submit" class="btn btn-info btn-lg btn-block">Review Questions</button>
	  </form>
  </div>

 @endsection