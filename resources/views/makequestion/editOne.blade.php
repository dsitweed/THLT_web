@extends('layouts.app')

@section('content')

@foreach($questions as $question)
	
<body style="background-color: #63e9ab">
  <div class="">
                            {{-- tương đương với: put /makequestion/{{$question->id}}  --}}
    <form method="post" action="{{route('makequestion.update', [$question->id])}}"> 
      @csrf 
      
      {{-- HTML Chỉ hỗ trợ POST và GET nên muốn gửi PUT cần thêm dòng 15 --}}
      {{-- Cách viết ngắn hơn cho dòng 15  @method('PUT') --}}
      <input type="hidden" name="_method" value="put">
      <input type="hidden" name="exam_id" value="{{$question->exam_id}}">
      <div class="col-md-8 col-md-offset-2">
        <table class="table col-lg-6">
          <tbody>
            <div class="form-group">
              <tr class="danger">
                <td>
                  <strong>Question : </strong>
                </td>
                <td>
                  <input type="text" class="form-control" name="question" value="{{$question->question}}" required>
                </td>
              </tr>
            </div>
            <div class="form-group">
              <tr class="bg-success">
                <td>
                  <strong>Choice1 : </strong>
                </td>
                <td>
                  <input name="choice1" class="form-control" value="{{$question->choice1}}" type="text" required>
                </td>
              </tr>
            </div>
            <div class="form-group">
              <tr class="danger">
                <td>
                  <strong>Choice2 : </strong>
                </td>
                <td>
                  <input name="choice2" class="form-control" value="{{$question->choice2}}" type="text" required>
                </td>
              </tr>
            </div>
            <div class="form-group">
              <tr class="bg-success">
                <td>
                  <strong>Choice3 : </strong>
                </td>
                <td>
                  <input name="choice3" class="form-control" value="{{$question->choice3}}" type="text" required>
                </td>
              </tr>
            </div>
            <div class="form-group">
              <tr class="danger">
                <td>
                  <strong>Choice4 : </strong>
                </td>
                <td>
                  <input name="choice4" class="form-control" value="{{$question->choice4}}" type="text" required>
                </td>
              </tr>
            </div>
            <div class="form-group">
              <tr class="bg-success">
                <td>
                  <strong>Answer : </strong>
                </td>
                <td>
                  <input name="answer" class="form-control" value="{{$question->answer}}" type="text" required>
                </td>
              </tr>
            </div>
          </tbody>
        </table>
        <input type="submit" class="border-2 hover:cursor-pointer border-blue-800 p-3" name="update" value="update">
      </div>
    </form>
  </div>
</body>

@endforeach
@endsection