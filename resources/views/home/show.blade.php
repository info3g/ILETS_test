@extends('app')
@section('content')
<div class="banner-section">
    <div class="">
        <img src="{{asset('images/banner.png')}}" alt="banner"/>
        <div class="banner-content">
            <div class="container">
                <div class="row">
                    <h1 class="text-center " style="margin: auto;color:#9ec73b">{{ucwords(str_replace('tree',' Tree', $data['name']))}}</h1>
                    <h3>Enter your date of birth, find out your Birth Tree and learn what it says about you. Three easy steps to know yourself better.</h3>
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
                        @include('menu.linkunit18090')
                        </div>
                        </div>
                        </div>
<div class="add">
    <div class="container">
 
    </div>
</div>
<div class="full-cntent-section pt-4 pb-2 detail-section">
    <div class="container">
        <div class="row">
        <div class="col-md-8 col-sm-12">
            <!--<img src="{{asset('images/tree-spacer.png')}}" alt="banner"/>-->
            <p class="mt-3"><strong><i>{{ucwords(str_replace('tree',' Tree', $data['name']))}}({{$data['final_date']}})</i></strong></p>
            <p>{{$data['answer']}}</p>
        </div>
        <div class="add col-md-4 col-sm-12">
    <div class="container">
        @include('menu.banner300250')
    </div>
    </div>
</div>
    </div>
</div>




@endsection