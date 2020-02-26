@extends('layouts.test_layout')

@section('content')
<style type="text/css">
    .plus:hover{
        cursor: pointer;
    }
    .drop{
        width: 100%;
        float: left;
        padding: 12px;        
        border:1px solid black;
        position: relative;
    }
    .option-position{
        position: absolute;
        top: 0;
        background: red;
        color: white;
        outline: none;
        border: none;
        width: 100%;
        left: 0;
    }
</style>
<script type="text/javascript">
    // function get_id(item) {
    //     drop_item(item);
    // }+
</script>

@foreach ($test[0]['types'] as $key => $value)
    @if($key == 'w')
        <h2 class="text-center">Writing</h2>
    @elseif($key == 'r')
        <h2 class="text-center">Reading</h2>
        <div class="row col-md-12">
            <div class="col-md-6" id="paragraph">
                <p>{!!$value['question']!!}</p>
            </div>
            <div class="col-md-6">                
                @foreach($value['headings'] as $heading)
                    <div class="col-md-12">
                        <?php dump($heading);?>
                        <h4>{{$heading['heading']}}</h4>
                        <p>{!!$heading['note']!!}</p>
                        @foreach($heading['questions'] as $question)
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @elseif($key == 'l')
        <h2 class="text-center" >Listening</h2>
    @endif

@endforeach
<?php

dd($test);

?>
<div class="container p-t-20">
    <h1>{{$test[0]['name']}}</h1>
    <form action="{{route('test.store')}}" method="POST" name="test_form">
        @csrf
         @foreach ($test[0]['types'] as $key => $value)

            @if($key == 'w')
                <h2 class="text-center">Writing</h2>
            @elseif($key == 'r')
                <h2 class="text-center">Reading</h2>
            @elseif($key == 'l')
                <h2 class="text-center" >Listening</h2>
            @endif

            <?php            
                // $test_id = $value['test_id'];
                // $audio = explode('|',$value['media']);
            ?>
            @if($key == 'r')
                <div class="row col-md-12">
                    <div class="col-md-6" id="paragraph">
                        <p>{!!$value['question']!!}</p>
                    </div>
                    <div class="col-md-6">
                        @foreach($value['questions'] as $question)
                            <div class="col-md-12">
                                <div class="accordion" id="accordionExample">
                                    <div class="card m-b-0 border-top">
                                        <div class="card-header" id="heading{{$question['id']}}">
                                            <h5 class="mb-0">
                                                <a class="collapsed plus" data-toggle="collapse" data-target="#collapse{{$question['id']}}" aria-expanded="false" aria-controls="collapse{{$question['id']}}">
                                                <!-- <span>Accordion Example 3</span> -->
                                                 @if($key != 'w')
                                                    <span>{{$question['question']}}</span>
                                                    <i class="m-r-5 fa fa-plus float-right" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapse{{$question['id']}}" class="collapse" aria-labelledby="heading{{$question['id']}}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    @if(empty($question['options']))
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="answer" name="question_{{$question['id']}}" placeholder="Type your answer...">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($key != 'w')
                                    <!-- <h4><span>Qus : </span>{{$question['question']}}</h4> -->
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif($key == 'w')
                @foreach($value as $paragraph)
                    @foreach($paragraph['questions'] as $question)   
                    <?php //dump($question); ?>                 
                        <div class="row">
                            <div class="col-md-6">
                                @if($question['type'] == 'd')
                                    <span class="col-md-12 drop" id="#answer_{{$question['id']}}">Drop your answer here</span>
                                @endif
                                <h5 class="d-flex" style="float: left; padding: 10px 0">{{$question['question']}}</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    @if(empty($question['options']))
                                        <div class="col-sm-12">
                                            <textarea class="form-control" style="min-height: 500px;" name="paragraph" id="word_count"></textarea>
                                            Total word count: <span id="display_count">0</span> words. Words left: <span id="word_left">200</span>
                                        </div>
                                    @endif
                                    @foreach($question['options'] as $option)
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio col-md-12">
                                            <ul class="list-group">
                                                <span id = "dragitem{{$option['id']}}-container" class="drag-container">
                                                    <li class="list-group-item qitem2" id="dragitem{{$option['id']}}" value="{{$option['question_id']}}" >
                                                    {{$option['option']}}</li>
                                                    <input type="hidden"  name="question_{{$option['question_id']}}" value="{{$option['option']}}">
                                                </span>
                                            </ul>                                            
                                        </div>
                                    </div>
                                    <br>
                                    @endforeach
                                </div>
                                <br>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @elseif($key == 'l')
                <audio controls>
                    <?php //asset("audio/$test_id/$audio[0]"); ?>
                  <source src='{{}}' type="audio/mp3">
                </audio>
            @endif
            <br><br>
        @endforeach
        <center>
            <input type="submit" class="btn btn-success">
        </center><br><br><br>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" type="text/javascript"></script>
<script>
   // var count = 7200;
   // var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

    // function timer() {
    //     count = count - 1;
    //     if (count == -1) {
    //         clearInterval(counter);
    //         return;
    //     }

    //     var seconds = count % 60;
    //     var minutes = Math.floor(count / 60);
    //     var hours = Math.floor(minutes / 60);
    //     minutes %= 60;
    //     hours %= 60;

    //     document.getElementById("timer").innerHTML = hours + ":" + minutes + ":" + seconds; // watch for spelling
    // }

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

        function makedraggable() {
            $(".qitem2").draggable({
                "revert": "invalid"
            });          
        }

        makedraggable();

        // $('#test').droppable({
        //     "accept": ".qitem2",
        //     "drop": function(event, ui) {
        //             console.log('testing the drop 1');  
        //             console.log(ui.draggable);
        //             $(ui.draggable).addClass("option-position");
        //        // debugger;
        //         if ($(this).find(".qitem2").length) {
        //             //console.log('drop event');
        //             var $presentChild = $(this).find(".qitem2"),
        //                 currChildId = $presentChild.attr("id"),
        //                 $currChildContainer = $("#" + currChildId + "-container");

        //            $currChildContainer.append($presentChild);
        //            $presentChild.removeAttr("style");
        //            $presentChild.removeClass('option-position');
        //            makedraggable();
        //         }
                
        //         $(ui.draggable).clone().appendTo(this).removeAttr("style");            
        //         $(ui.draggable).remove();        
        //     }
        // });
        $(".qitem2").mouseover(function(){            
            var value = $(this).val();            
            // var id = $("#"+item);
            
            console.log(id);
            var id = $("#answer_"+value);
            $(id).droppable({
                "accept": ".qitem2",
                "drop": function(event, ui) {
                        console.log('testing the drop 1');  
                        console.log(ui.draggable);
                        $(ui.draggable).addClass("option-position");
                   // debugger;
                    if ($(this).find(".qitem2").length) {
                        //console.log('drop event');
                        var $presentChild = $(this).find(".qitem2"),
                            currChildId = $presentChild.attr("id"),
                            $currChildContainer = $("#" + currChildId + "-container");

                       $currChildContainer.append($presentChild);
                       $presentChild.removeAttr("style");
                       $presentChild.removeClass('option-position');
                       makedraggable();
                    }
                    
                    $(ui.draggable).clone().appendTo(this).removeAttr("style");            
                    $(ui.draggable).remove();        
                }
            });
        });            
    });
    function get_id(item) {
        // alert(item);
            drop_item(item);
    }
</script>
@endsection
