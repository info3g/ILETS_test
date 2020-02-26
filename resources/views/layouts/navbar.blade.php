'<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="navbar-brand nav-link">
                        <img alt="branding logo" src="{{asset('admin_theme/app-assets/images/logo/robust-logo-light.png')}}" data-expand="{{asset('admin_theme/app-assets/images/logo/robust-logo-light.png')}}" data-collapse="{{asset('admin_theme/app-assets/images/logo/robust-logo-light-small.png')}}" class="brand-logo">
                    </a>
                </li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>                  
                </ul>
                <ul class="nav navbar-nav float-xs-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a href="" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="{{ asset(Auth::user()->image) }}" alt="avatar"><i></i></span><span class="user-name">{{ Auth::user()->first_name }}</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item" data-toggle="modal" data-target="#inlineForm_{{Auth::user()->id}}"><i class="icon-head"></i> Edit Profile
                            </a>
                            <a href="" data-toggle="modal" data-target="#inlineForm1_{{Auth::user()->id}}" class="dropdown-item"><i class="icon-mail6"></i> Change Password</a>
                            <a href="" data-toggle="modal" data-target="#inlineForm2_{{Auth::user()->id}}"class="dropdown-item"><i class="icon-clipboard2"></i> Update Image</a>
                           {{--  <a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a> --}}
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <i class="icon-power3"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="modal fade text-xs-left" id="inlineForm_{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Edit Profile</label>
            </div>
            <form method="post" action="{{ route('users.update', Auth::user()->id) }}">
               @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First Name </label>
                        <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name </label>
                        <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-outline-success" value="Update">
                    <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade text-xs-left" id="inlineForm1_{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Change Password</label>
            </div>
            <form method="post" action="{{ route('change.password') }}">
               @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Old Password</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password </label>
                        <input type="password" class="form-control" name="new_password" />
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-outline-success" value="Update">
                    <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade text-xs-left" id="inlineForm2_{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Update Image</label>
            </div>
            <form action="{{ route('file.upload.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" />
                    </div>
                </div>
                 <div class="modal-footer">
                    <input type="submit" class="btn btn-outline-success" value="Update">
                    <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                </div>
            </div>
        </form>
        </div>
    </div>
</div>