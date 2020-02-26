@extends('layouts.test_layout')
<!-- Load content from app.blade.php file from app folder-->
@section('content')
<?php 
    // $time = $data[0]['time']; 
    // $mins = substr($time, strpos($time, ":") + 1);
    // $hrs = explode(":",$time);
    // $hours = $hrs[0];

    $str_time = $data[0]['time'].':'.'00';
    
    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
    $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
    $time_seconds;

?>
<div class="container p-t-20">
    <div class="pull-right">Time left = <span id="timer"></span></div>
    <?php   $count = 1;     ?>
    <h1>{{$data[0]['name']}}</h1>
    <form action="{{route('test.store')}}" method="POST" name="test_form">
        @csrf
        @foreach ($data[0]['types'] as $key => $value)
            @if($key == 'w')
                <h2 class="text-center">Writing</h2>
            @elseif($key == 'r')
                <h2 class="text-center">Reading</h2>
            @elseif($key == 'l')
                <h2 class="text-center">Listining</h2>
            @endif
            
            <?php  
                $test_id = $value['test_id']; 
                $audio = explode('|',$value['media']); 
            ?>
            @if($key == 'l')
                <audio controls>
                  <source src='{{asset("audio/$test_id/$audio[0]")}}' type="audio/mp3">                                    
                </audio>
            @endif
            @foreach($value['questions'] as $question)
                <div class="row">
                    <div class="col-md-6">
                        @if($key == 'w')
                            <h4>{{$question['question']}}</h4>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($key != 'w')
                            <h4><span>Qus : </span>{{$question['question']}}</h4>
                        @endif
                        <div class="form-group row">
                        @if(empty($question['options']))
                            <!-- <label for="answer" class="col-sm-2 text-right control-label col-form-label">Answer</label> -->
                            <div class="col-sm-12">
                                @if($key == 'w')
                                    <textarea class="form-control" style="min-height: 500px;" name="paragraph" id="word_count"></textarea>
                                    Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left">200</span>
                                @else
                                    <input type="text" class="form-control" id="answer" name="question_{{$question['id']}}" placeholder="Type your answer...">                        
                                @endif
                            </div>
                        @endif
                        @foreach($question['options'] as $option)
                        <div class="col-md-9">
                            <div class="custom-control custom-radio col-md-6">                        
                                <input type="radio" class="custom-control-input" id="customControlValidation{{$option['id']}}" name="mcq_{{$question['id']}}" value="{{$option['option']}}">
                                <label class="custom-control-label" for="customControlValidation{{$option['id']}}">{{$option['option']}}</label>
                            </div>             
                        </div>
                        <br>
                        @endforeach
                    </div>   
                    <?php $count++; ?> 
                    <br>
                    </div>
                </div>
            @endforeach
        @endforeach
        <center>
            <input type="submit" class="btn btn-success">
        </center><br><br><br>
    </form>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    var count = <?php echo $time_seconds; ?>;
    var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

    function timer() {
        count = count - 1;
        if (count == -1) {
            clearInterval(counter);
            return;
        }

        var seconds = count % 60;
        var minutes = Math.floor(count / 60);
        var hours = Math.floor(minutes / 60);
        minutes %= 60;
        hours %= 60;

        document.getElementById("timer").innerHTML = hours + ":" + minutes + ":" + seconds; // watch for spelling
    }
    // window.onbeforeunload = function() {
    //     return "Dude, are you sure you want to leave? Think of the kittens!";
    // }
    /*
    document.getElementById('timer').innerHTML =41+ ":" + 00;
    startTimer();
    
    function startTimer() {
        var presentTime = document.getElementById('timer').innerHTML;
        var timeArray = presentTime.split(/[:]+/);
        // console.log(timeArray);
        var m = timeArray[0];
        var s = checkSecond((timeArray[1] - 1));
        if(s==59){m=m-1}
        // if(m<0){alert('timer completed')}    
        if(m < 0){
            stopTimer();
            setTimeout("document.test_form.submit();",timeArray[1]);
        }         
        document.getElementById('timer').innerHTML =  m + ":" + s;
        setTimeout(startTimer, 1000);
    }
    function checkSecond(sec) {
        if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
        if (sec < 0) {sec = "59"};
        return sec;
    }
    function stopTimer(){
        document.getElementById('timer').innerHTML =00+ ":" + 00;
    }*/
    $(document).ready(function() {
        var total_words = 200;
        $("#word_count").on('keyup', function() {
            var words = this.value.match(/\S+/g).length;
            if (words > total_words) {
                // Split the string on first 200 words and rejoin on spaces
                var trimmed = $(this).val().split(/\s+/, total_words).join(" ");
                // Add a space at the end to keep new typing making new words
                $(this).val(trimmed + " ");
            }
            else {
                $('#display_count').text(words);
                $('#word_left').text(total_words-words);
            }
        });
     });
</script>
@endsection