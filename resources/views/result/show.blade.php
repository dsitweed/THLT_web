@extends('layouts.app')

{{-- received $resultDetail and $score (score of exam) --}}

@section('content')
    <div class="body m-2">
        <h2>Score of exam: {{$score}}</h2>
        @foreach($resultDetail as $key => $question)
        <div class="my-2">
            <h3>Question {{$key + 1}} : {{$question->question}} ?</h3>
            <div class="">
                <input type="hidden" name="question_id[]" value="{{$question->id}}">
                {{-- <input type="hidden" name="question[]" value="{{$question->question}}"> --}}
                <input type="hidden" name="true_answer[]" value="{{$question->answer}}">
                <input name="answer{{$key}}" value="{{$question->choice1}}" type="radio"> {{$question->choice1}} <br>
                <input name="answer{{$key}}" value="{{$question->choice2}}" type="radio">{{$question->choice2}}<br>
                <input name="answer{{$key}}" value="{{$question->choice3}}" type="radio">{{$question->choice3}}<br>
                <input name="answer{{$key}}" value="{{$question->choice4}}" type="radio">{{$question->choice4}}<br>

                <div>Selected: {{$question->given_answer}}</div>
            </div>
        </div>
        @endforeach
        
    </div>
@endsection