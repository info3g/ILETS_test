<div class="header text-center">
    <div class="container">
        <div class="row">
            <div class="navbar navbar-expand-md col-md-12">
                <div class="col-md-12 logo col-sm-6 col-xs-6 d-flex justify-content-center">
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt="logo"/></a>
                </div>
                <div class="col-md-9 logo col-sm-6 col-xs-6 navbar-toolbar d-flex flex-shrink-0 justify-content-end">
                    <!--<a class="navbar-tool d-flex mr-4" href="#">-->
                    <!--    <div class="navbar-tool-icon-box"><img src="{{asset('images/hut.png')}}" alt="logo"/></div>-->
                    <!--    <div class="navbar-tool-text">-->
                    <!--        <strong>Email:</strong>-->
                    <!--        <p>info@birthdaytree.org</p>-->
                    <!--    </div>-->
                    <!--</a>-->
                    <!--<a class="navbar-tool d-flex " href="#">-->
                    <!--    <div class="navbar-tool-icon-box"><img src="{{asset('images/phone.png')}}" alt="logo"/></div>-->
                    <!--    <div class="navbar-tool-text">-->
                    <!--        <strong>Phone:</strong>-->
                    <!--        <p>+92 368 1234754</p>-->
                    <!--    </div>-->
                    <!--</a>-->
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-stuck-menu">
    <div class="container">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                {{-- 
                <li class="nav-item"><a href="/">Find Your Day of Birth</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Tuesday</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Monday</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Wednesday</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Thursday</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Friday</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Saturday</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Born on Sunday</a></li>
                --}}
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Find Your Day of Birth</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','monday')}}" title="Born on Monday">Born on Monday</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','tuesday')}}" title="Born on Tueday">Born on Tuesday</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','wednesday')}}" title="Born on Wednesday">Born on Wednesday</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','thursday')}}" title="Born on Thursday">Born on Thursday</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','friday')}}" title="Born on Friday">Born on Friday</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','saturday')}}" title="Born on Saturday">Born on Saturday</a> </li>
                <li class="nav-item"><a class="nav-link" href="{{route('dob.show','sunday')}}" title="Born on Sunday">Born on Sunday</a> </li>
            </ul>
        </div>
    </div>

</nav>







<div class="banner-section">
    <img src="{{asset('images/banner.jpg')}}" alt="banner"/>
    <div class="banner-content">
        <div class="container">
            <div class="row">
                <div class="inner-banner">
                    <h3><strong>Not aware on which day you were born? </strong></h3>
                    <p>Its a one step process to know the day of your birth and also the nature that you posses.</p>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- 
<div class="header pt-4 pb-4 text-center">
    <div class="container">
        <h1>Day Of Birth</h1>
        <p>Not aware on which day you were born? Its a one step process to know the day of your birth and also the nature that you posses.</p>
    </div>
</div>
--}}
