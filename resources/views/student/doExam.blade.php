@extends('layouts.app')

{{-- receiv a Examinfo exam (Biến exam kiểu model Examinfo ) 
    and Question questions  (biến questions là array kiểu model Question)    
--}}

@php
    $student = \App\Models\Student::where('user_id', Auth::user()->id)->first();
@endphp


@section('script')

<!-- script for time limitation of exam -->
<script type="text/javascript">
var timeoutHandle;
function countdown(minutes) {
    var seconds = 60;
    var mins = minutes
    function tick() {
        var counter = document.getElementById("timer");
        var current_minutes = mins-1
        seconds--;
        counter.innerHTML =
        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {

            if(mins > 1){

               // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
               setTimeout(function () { countdown(mins - 1); }, 1000);

            }
        }
    }
    tick();
}

countdown('<?php echo $exam->time; ?>');

</script>

<!-- script for disable url -->
<script type="text/javascript">
    var time= '<?php echo $exam->time; ?>';
    var realtime = time*60000;
    setTimeout(function () {
        alert('Time Out');
        window.location.href= '/';},
   realtime);

    
</script>

@endsection




@section('content')
<body style="background-color: darkseagreen">
    <div>
        <nav class="col-lg-1 pull-right">
          <div class="sidebar-nav-fixed affix">
            <h1><b>Time <span id="timer" style="color: red">0.00</span></b></h1><br>
          </div>
        </nav>
        <h1 class="col-lg-offset-4" style="color: red;"><span style="background-color:seagreen;color: white;border-radius: 5px"><b>  Examination on {{$exam->course_name}}  </b></span></h1>
        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3" style="background-color: white">
            <div class="col-md-6 col-lg-8 col-sm-6 col-lg-offset-2">
                <form method="post" action="{{route('answer.store')}}" class="ansform">
                    @csrf

                    <input type="hidden" name="student_id" value="{{$student->id}}">
                    <input type="hidden" name="exam_id" value="{{$exam->id}}">
                    @foreach($questions as $key => $question)
                    <div class="questionContainer">
                        <h3>Question {{$key + 1}} : {{$question->question}} ?</h3>
                        <div class="col-lg-offset-1">
                            <input type="hidden" name="question_id[]" value="{{$question->id}}">
                            {{-- <input type="hidden" name="question[]" value="{{$question->question}}"> --}}
                            <input type="hidden" name="true_answer[]" value="{{$question->answer}}">
                            <input name="answer{{$key}}" value="{{$question->choice1}}" type="radio"> {{$question->choice1}} <br>
                            <input name="answer{{$key}}" value="{{$question->choice2}}" type="radio">{{$question->choice2}}<br>
                            <input name="answer{{$key}}" value="{{$question->choice3}}" type="radio">{{$question->choice3}}<br>
                            <input name="answer{{$key}}" value="{{$question->choice4}}" type="radio">{{$question->choice4}}<br>
                        </div>
                    </div>
                    @endforeach
                    <input type="submit" name="submit" value="submit" class="btn btn-primary" id="submitbtn">
                </form>
            </div>

        </div>
    </div>
   
</body>


@endsection

	 