@extends('default')
@section('content')
<div class="whole-section">
    <div class="full-overlay-section">
        <div class="container">

            <div class="d-flex flex-column align-items-center overlay-sec  pt-3 pb-3">
                @include('menu.banner72890')
                <h1>Day of <span>Birth </span></h1>
                <img class="pt-1 pb-4" src="{{asset('images/sep-purple.png')}}" alt="banner"/>
                <p class="text-center"> Did you know that the day on which you were born says a lot about the type of person you are? No, not the date of birth, but the day of the week you were born on. Surprising but true, there is a unique set of personality traits that can be attributed to you on the basis of the day of the week you were born on.  </p>
                {{-- <b>Please enter following details</b> --}}
                <form class="birth-form" action="{{ route('dob.store')}}" method="post">
                    <div>
                        @csrf
                        <label for="email">Your Birth Date: </label>
                        <select name="birthdate" class="form-control" id="sel1">
                            @for($i=1;$i<=31;$i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor					
                        </select>
                    </div>
                    <div>
                        <label for="email">Your Birth Date: </label>
                        <select name="birthmonth" class="form-control" id="sel1">
                            <option value="Jan">January</option>
                            <option value="Feb">February</option>
                            <option value="Mar">March</option>
                            <option value="Apr">April</option>
                            <option value="May">May</option>
                            <option value="Jun">June</option>
                            <option value="Jul">July</option>
                            <option value="Aug">August</option>
                            <option value="Sep">September</option>
                            <option value="Oct">October</option>
                            <option value="Nov">November</option>
                            <option value="Dec">December</option>
                        </select>
                    </div>
                    <div>
                        <label for="email">Your Birth Date: </label>
                        <select name="birthyear" class="form-control" id="sel1">
                            @php $curyear = date("Y"); @endphp  
                            @for($i=1920;$i<=$curyear;$i++)
                             <option value={{$i}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                @include('menu.linkunit18090')
            </div>
        </div>
    </div>
   
</div>


@endsection