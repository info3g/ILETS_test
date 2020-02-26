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
    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555; 
    }
    ::-webkit-input-placeholder {
       text-align: center;
    }

    ::-moz-placeholder { /* Firefox 18- */
       text-align: center;  
    }

    ::-moz-placeholder {  /* Firefox 19+ */
       text-align: center;  
    }

    ::-ms-input-placeholder {  
       text-align: center; 
    }
    div.testing_p_tag p {
        padding: 0 5px;
    }
    div.testing_p_tag {
        display: inline-flex;
    }
</style>
<?php

// dump($test[0]['time']);
 $str_time = $test[0]['time'].':'.'00';
    
sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
$time_seconds;
?>
<div class="container p-t-20 wrapper-container">
    <h1>{{$test[0]['name']}}</h1>
    <div class="pull-right timer">Time left = <span id="timer"></span></div>
    <form action="{{route('test.store')}}" method="POST" name="test_form">
        @csrf
        @foreach ($test[0]['types'] as $key => $value)
            @if($key == 'w')
                <div class="info-detail">
          <div class="center-text"> <h2 class="text-center">Writing</h2><hr class="info-hr"></div>
                <div class="row col-md-12 inner-info">
                    @foreach($value['headings'] as $heading)                    
                        <div class="col-md-6" id="paragraph">                            
                            <p>{!!$heading['note']!!}</p>
                        </div>
                        <div class="col-md-6"> 
                            <div class="full-width">
                                <?php
                                if (strpos($heading['note'], '150') !== false) {
                                    $words = 150; ?>
                                    <div id="paragraph_word" class="paragraph_test" value>
                                        <textarea class="form-control" style="min-height: 250px;resize: none" name="paragraph_{{$heading['id']}}" id="word_count1"></textarea>
                                        <!-- Total word count: <span id="display_count">0</span> words. --> Words left: <span id="word_left1">{{$words}}</span>
                                    </div>
                                <?php 
                                }

                                elseif (strpos($heading['note'], '250') !== false) {
                                    $words = 250; ?>
                                    <div id="paragraph_word" class="paragraph_test" value>
                                        <textarea class="form-control" style="min-height: 250px;resize: none" name="paragraph_{{$heading['id']}}" id="word_count2"></textarea>
                                        <!-- Total word count: <span id="display_count">0</span> words. --> Words left: <span id="word_left2">{{$words}}</span>
                                    </div>
                                <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            @elseif($key == 'r')   
                <div class="info-detail reading-list">     
                  <div class="center-text"> <h2 class="text-center">Reading</h2><hr class="info-hr"></div>

                <div class="row col-md-12 inner-info">
                    <div class="col-md-6 text-paragraph" id="paragraph" style="height: 500px; overflow-y: scroll;overflow-x: hidden;"> 
                        <p>{!!$value['question']!!}</p>
                    </div>
                    <div class="col-md-6 text-paragraph-2" style="height: 500px; overflow-y: scroll">
                        @foreach($value['headings'] as $heading)
                            <div class="col-md-12">          
                            <?php //dump($heading); ?>                      
                                <h4>{{$heading['heading']}}</h4>
                                <p>{!!$heading['note']!!}</p>
                                @if($heading['image'] != '')                                    
                                    <img src="{{asset($heading['image'])}}" style="height: auto;width: 600px; margin-bottom: 30px">
                                @endif                                                                
                                <div class="accordion" id="accordionExample_{{$heading['id']}}">
                                @foreach($heading['questions'] as $question)                                    
                                    @if($heading['question_type'] != 't' && $heading['question_type'] != 'p') 
                                            <div class="card m-b-0 border-top">
                                                <div class="card-header" id="heading{{$question['id']}}">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed plus" data-toggle="collapse" data-target="#collapse{{$question['id']}}" aria-expanded="false" aria-controls="collapse{{$question['id']}}">                                                    
                                                         @if($key != 'w')
                                                            <span style="display:inline-flex">{{$question['serial_no']}})&nbsp; {!!$question['question']!!}</span>
                                                            <i class="m-r-5 fa fa-plus float-right" aria-hidden="true"></i>
                                                        @endif
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapse{{$question['id']}}" class="collapse" aria-labelledby="heading{{$question['id']}}" data-parent="#accordionExample_{{$heading['id']}}">
                                                    <div class="card-body">
                                                        <div class="form-group row">                                                    
                                                            @foreach($question['options'] as $option)
                                                                <div class="col-md-9">
                                                                    @if($heading['question_type'] == 'm')
                                                                        <div class="custom-control custom-radio col-md-6">
                                                                            <input type="radio" class="custom-control-input" id="customControlValidation{{$option['id']}}" name="question_{{$question['id']}}" value="{{$option['option']}}">
                                                                            <label class="custom-control-label" for="customControlValidation{{$option['id']}}">{{$option['option']}}</label>
                                                                        </div>
                                                                    @endif
                                                                    @if($heading['question_type'] == 'c')
                                                                        <div class="form-group row">                                                                            
                                                                            <div class="col-md-12">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing{{$option['id']}}" name="option_{{$question['id']}}_{{$option['id']}}" value="{{$option['option']}}">
                                                                                    <label class="custom-control-label" for="customControlAutosizing{{$option['id']}}">
                                                                                        {{$option['option']}}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif                                                                
                                                                </div>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                     @elseif($heading['question_type'] == 'p')
                                        <h5>
                                            <div class="testing_p_tag">{{$question['serial_no']}}) {!!$question['question']!!} <span> 
                                                <input type="text" name="question_{{$question['id']}}" style="width: 40px;"> </span>
                                            </div>
                                        </h5>                
                                     @else
                                        <?php                                             
                                            $input_box = '<input type="text" name="question_'.$question['id'].'" placeholder="'.$question['serial_no'].'">';
                                            $qst = preg_replace('/[_]+/', $input_box, $question['question']);                                            
                                        ?>                                
                                       <h5> {!!$qst!!}</h5>                                   
                                    @endif
                                @endforeach
                                </div>
                                <br><br>
                            </div>
                        @endforeach
                    </div>
                </div>    
                </div>        
            @elseif($key == 'l')    
            <div class="info-detail listening-detail">             
           <div class="center-text"> <h2 class="text-center">Listening</h2><hr class="info-hr"></div>

                <?php  
                    $audios = explode('|', $value['media']);
                    $count = count($audios);
                    $test_id = $value['test_id'];                  
                ?>                
                <audio id="ctrlaudio" controls>                    
                    @for($i=0;$i<$count;$i++)                    
                        <source src='{{asset("Audio/$test_id/$audios[$i]")}}' type="audio/mp3">                           
                    @endfor
                </audio>
                <div class="row col-md-12">
                    <div class="col-md-12 text-paragraph-2">                
                        @foreach($value['headings'] as $heading)
                            <div class="col-md-12 inner-info">          
                            <?php //dump($heading); ?>                      
                                <h4>{{$heading['heading']}}</h4>
                                <p>{!!$heading['note']!!}</p>
                                @if($heading['image'] != '')                                    
                                    <img src="{{asset($heading['image'])}}" style="height: auto;width: 600px; margin-bottom: 30px">
                                @endif
                                <div class="accordion" id="accordionExample_{{$heading['id']}}">
                                @foreach($heading['questions'] as $question)                                    
                                    @if($heading['question_type'] != 't' && $heading['question_type'] != 'p') 
                                            <div class="card m-b-0 border-top">
                                                <div class="card-header" id="heading{{$question['id']}}">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed plus" data-toggle="collapse" data-target="#collapse{{$question['id']}}" aria-expanded="false" aria-controls="collapse{{$question['id']}}">                                                    
                                                         @if($key != 'w')
                                                            <span style="display:inline-flex">{{$question['serial_no']}})&nbsp;{!!$question['question']!!}</span>
                                                            <i class="m-r-5 fa fa-plus float-right" aria-hidden="true"></i>
                                                        @endif
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapse{{$question['id']}}" class="collapse" aria-labelledby="heading{{$question['id']}}" data-parent="#accordionExample_{{$heading['id']}}">
                                                    <div class="card-body">
                                                        <div class="form-group row">                                                    
                                                            @foreach($question['options'] as $option)
                                                                <div class="col-md-9">
                                                                    @if($heading['question_type'] == 'm')
                                                                        <div class="custom-control custom-radio col-md-6">
                                                                            <input type="radio" class="custom-control-input" id="customControlValidation{{$option['id']}}" name="question_{{$question['id']}}" value="{{$option['option']}}">
                                                                            <label class="custom-control-label" for="customControlValidation{{$option['id']}}">{{$option['option']}}</label>
                                                                        </div>
                                                                    @endif
                                                                    @if($heading['question_type'] == 'c')
                                                                        <div class="form-group row">                                                                            
                                                                            <div class="col-md-12">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing{{$option['id']}}" name="option_{{$question['id']}}_{{$option['id']}}" value="{{$option['option']}}">
                                                                                    <label class="custom-control-label" for="customControlAutosizing{{$option['id']}}">
                                                                                        {{$option['option']}}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif                                                                
                                                                </div>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                     @elseif($heading['question_type'] == 'p')
                                        <h5>{{$question['serial_no']}}) {{$question['question']}} <span> <input type="text" name="question_{{$question['id']}}" style="width: 40px;"> </span></h5>                                    @else
                                        <?php                                             
                                            $input_box = '<input type="text" name="question_'.$question['id'].'" placeholder="'.$question['serial_no'].'">';
                                            $qst = preg_replace('/[_]+/', $input_box, $question['question']);                                            
                                        ?>                                
                                       <h5>{!!$qst!!}</h5>                                   
                                    @endif
                                @endforeach
                                </div>
                                <br><br>
                            </div>
                        @endforeach
                    </div>
                </div> 
                </div>
            @endif
        @endforeach
        <input type="hidden" name="test_id" value="{{$test[0]['id']}}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
        <div class="clearfix"> </div>
        <center>
            <input type="submit" class="btn btn-success">
        </center><br><br><br>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" type="text/javascript"></script>
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
    $(document).ready(function() {       
        $("#word_count1").on('keyup', function() {
            var total_words = 150;
            var words = this.value.match(/\S+/g).length;
            if (words > total_words) {
                // Split the string on first 200 words and rejoin on spaces
                var trimmed = $(this).val().split(/\s+/, total_words).join(" ");
                // Add a space at the end to keep new typing making new words
                $(this).val(trimmed + " ");
            }
            else {
                $('#display_count').text(words);
                $('#word_left1').text(total_words-words);
            }
        });

        $("#word_count2").on('keyup', function() {
            var total_words = 250;
            var words = this.value.match(/\S+/g).length;
            if (words > total_words) {
                // Split the string on first 200 words and rejoin on spaces
                var trimmed = $(this).val().split(/\s+/, total_words).join(" ");
                // Add a space at the end to keep new typing making new words
                $(this).val(trimmed + " ");
            }
            else {
                $('#display_count').text(words);
                $('#word_left2').text(total_words-words);
            }
        });               

        function makedraggable() {
            $(".qitem2").draggable({
                "revert": "invalid"
            });          
        }
	
	/*******************   Play multiple audio code start   **************************/   
        $(function () {
            var audio = document.getElementById('ctrlaudio');        
            all_songs = audio.getElementsByTagName('source').length;
            var lstsongNames = []; 
            for(i=1;i<all_songs;i++){
                lstsongNames.push(audio.getElementsByTagName('source')[i].src);
            }                    
            var curPlaying = 0;
            current_song = audio.getElementsByTagName('source')[0];             
            counter = 0;
            total_songs = lstsongNames.length;
            audio.addEventListener('ended', function() {            
                if(counter < total_songs){
                    current_song.src = current_song.src.replace(current_song.src,lstsongNames[counter]);
                    audio.load();
                    audio.play();
                    counter++;
                }
           });      
       });
        /*******************   Play multiple audio code End   **************************/
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
