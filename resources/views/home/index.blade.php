@extends('app')
@section('content')
<div class="banner-section">
            <div class="">
                <img src="{{asset('images/banner.png')}}" alt="banner"/>
                <div class="banner-content">
                    <div class="container">
                        <div class="row">
                            <h3>One click and find out your Birthday Tree to learn what it says about you.<span>Know yourself better.</span></h3>
                           {{--  <h3>{{ucwords(str_replace('tree',' Tree', $data['name']))}}</h3>
                            <p>Enter your date of birth, find out your Birth Tree and learn what it says about you. Three easy steps to know yourself better.</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="add">
            <div class="container">
                 @include('menu.linkunit46815')
             </div>
         </div>
         <div class="col-md-12 col-sm-12 social-frame">
             <div class="container">
                  <div class="social-frame-inner">
         <ul class="social">
                            <li class="nav-item">
                              <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.birthdaytree.org%2F&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=tahoma&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none;width:100%;overflow:hidden;height:35px;" allowTransparency="true"></iframe>
                            </li>
                            <li class="nav-item">
                                @include('layouts.sharer')
                            </li>
                        </ul>
                        </div>
                        </div>
                        </div>
                     <div class="col-md-12 col-sm-12 social-frame">
                     <div class="container">
                     <div class="add">
                        @include('menu.linkunit18090')
                    </div>
                    </div>
                    </div>
<div class="full-cntent-section pt-4 pb-5">
    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <img src="{{asset('images/tree-spacer.png')}}" alt="banner"/>
            <h1>Birth <span>Tree</span></h1>
            <p><strong><i>Everyone has a birth tree. A tree is assigned to a specific range of days in a year.</i></strong></p>
            <p class="text-center">Each birth tree explains some significant characteristic traits and behaviour of people who are born around a certain range of days. The significance of attaching a tree to your life and the day you were born on were first developed by the ancient Celts, more so the druids a respectable subset of the Celts. They believed that this was very spiritual and the closest a person could be connected to the environment and nature. 
            </p>
        </div>
    </div>
</div>
<div class="split-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 side-sec pt-5 pb-5">
                <div class="box">
                    <h1>Choose your <span> Birth Date</span></h1>
                    <p><strong><i>Check which tree you get and see for yourself if it matches your personality.</i></strong></p>
                    <div class="row box-inner">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <ul>
                                @foreach($data['list1'] as $key => $val)
                                <li><a href="{{route('show',$key)}}">{{$val}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <ul>
                                @foreach($data['list2'] as $key => $val)
                                <li><a href="{{route('show',$key)}}">{{$val}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <ul>
                                @foreach($data['list3'] as $key => $val)
                                <li><a href="{{route('show',$key)}}">{{$val}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <ul>
                                @foreach($data['list4'] as $key => $val)
                                <li><a href="{{route('show',$key)}}">{{$val}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection