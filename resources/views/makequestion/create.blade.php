@extends('layouts.app')

{{-- Truyền 1 tham số là Examinfo examinfo 
	1 kiểu model Examinfo biến có tên là examinfo 
--}}

@section('content')
<h1>Exam name: {{$examinfo->name}}</h1>
<h2 style="text-align: center;"><b>Create Questions System will redirect you when set is full</b></h2>
<form method="post" action="{{route('makequestion.store')}}">	
	@csrf
    
		<div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput">Question</label>
		    <input type="text" name="question" class="form-control " id="formGroupExampleInput" required>
		  </div>
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput2">Option 1</label>
		    <input type="text" name="option1" class="form-control" id="formGroupExampleInput2" required>
		  </div>
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput2">Option 2</label>
		    <input type="text" name="option2" class="form-control" id="formGroupExampleInput2" required>
		  </div>
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput2">Option 3</label>
		    <input type="text" name="option3" class="form-control" id="formGroupExampleInput2" required>
		  </div>
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput2">Option 4</label>
		    <input type="text" name="option4" class="form-control" id="formGroupExampleInput2" required>
		  </div>
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput2">Answer</label>
		    <input type="text" name="answer" class="form-control" id="formGroupExampleInput2" required>
		  </div>
		  {{-- Có thể ẩn label exam ID khi thiết kế giao diện đang để hiện cho dễ test  --}}
		  <div class="form-group">
		    <label class="col-form-label" for="formGroupExampleInput2">Exam ID: {{$examinfo->id}}</label>
		    <input type="hidden" name="examId" class="form-control" id="formGroupExampleInput2" value="{{$examinfo->id}}" readonly>
		  </div>
		  <button type="Submit" class="btn btn-success btn-block">Submit</button>
		</div>
</form>

@endsection