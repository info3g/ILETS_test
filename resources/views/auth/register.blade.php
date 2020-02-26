@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Professional') }}</label>
                            <div class="col-md-6">
                                <select name="profession_name" class="form-control @error('profession_name') is-invalid @enderror" required>
                                    <option value="">Select Professional</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->profession_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="service_name" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>
                            <div class="col-md-6">
                                {{-- <div class="container"> --}}
                                {{-- <select name="service_name"  class="form-control service_name"> --}}
                                    <select name="service_name" id="example" class="form-control"  multiple="multiple" >
                                    <option value="">Service</option>
                                </select>
                            {{-- </div> --}}
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#inlineForm">Add Profession
                                </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-xs-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Add Profession</label>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="service_name">Profession:</label>
                                                        <input type="text" class="form-control" name="service_nametest" />
                                                        <input type="hidden" class="form-control" name="category_id" value="" />  
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                     <button type="button" id="add_service_btn"  data-dismiss="modal" class="btn btn-outline-success btn-submit">Add</button>
                                                    <input type="button" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="sub_service" class="col-md-4 col-form-label text-md-right">{{ __('Service') }}</label>
                            <div class="col-md-6">
                                <select id="name" name="name" class="form-control sub_service"/>
                                <option value="">Sub Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employee_count" class="col-md-4 col-form-label text-md-right">{{ __('Employee Count') }}</label>
                            <div class="col-md-6">
                                <input id="employee_count" type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control @error('employee_count') is-invalid @enderror" name="employee_count" value="{{ old('employee_count') }}" required autocomplete="employee_count" autofocus>
                                @error('employee_count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>
                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website" autofocus>
                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="languages" class="col-md-4 col-form-label text-md-right">{{ __('Languages') }}</label>
                            <div class="col-md-6">
                                <input id="languages" type="text" class="form-control @error('languages') is-invalid @enderror" name="languages" value="{{ old('languages') }}" required autocomplete="languages" autofocus>
                                @error('languages')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_no" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>
                            <div class="col-md-6">
                                <input name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" type="text" minlength="10" maxlength="10" onkeypress="return isNumberKey(event)" required autocomplete="contact_no" autofocus/>
                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="work_location" class="col-md-4 col-form-label text-md-right">{{ __('Work Location') }}</label>
                            <div class="col-md-6">
                                <input id="work_location" type="text" class="form-control @error('work_location') is-invalid @enderror" name="work_location" value="{{ old('work_location') }}" required autocomplete="work_location" autofocus>
                                @error('work_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hourly_price" class="col-md-4 col-form-label text-md-right">{{ __('Hourly Price') }}</label>
                            <div class="col-md-6">
                                <input id="hourly_price" type="text" class="form-control @error('hourly_price') is-invalid @enderror" name="hourly_price" value="{{ old('hourly_price') }}" required autocomplete="hourly_price" autofocus>
                                @error('hourly_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="legal_structure" class="col-md-4 col-form-label text-md-right">{{ __('Legal Structure') }}</label>
                            <div class="col-md-6">
                                <select name="legal_structure" id="legal_structure" class="form-control @error('legal_structure') is-invalid @enderror" value="{{ old('legal_structure') }}" required autocomplete="legal_structure" autofocus>
                                    <option value="">Select</option>
                                    <option value="Sole Proprietorl">Sole Proprietorl</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Incorporate">Incorporate</option>
                                    <option value="Limited partnership">Limited partnership</option>
                                </select>
                                @error('legal_structure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="experience" class="col-md-4 col-form-label text-md-right">{{ __('Experience') }}</label>
                            <div class="col-md-6">
                                 <select name="experience" id="experience" class="form-control @error('experience') is-invalid @enderror" value="{{ old('experience') }}" required autocomplete="experience" autofocus>
                                    <option value="">Select</option>
                                    <option value="1-3">1-3</option>
                                    <option value="3-10">3-10</option>
                                    <option value="10+">10+</option>
                                </select>
                                @error('experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>
                            <div class="col-md-6" >
                                <textarea id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio') }}" required autocomplete="bio" autofocus ></textarea>
                                @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="about_us" class="col-md-4 col-form-label text-md-right">{{ __('About Us') }}</label>
                            <div class="col-md-6">
                                <textarea id="about_us" type="text" class="form-control @error('about_us') is-invalid @enderror" name="about_us" value="{{ old('about_us') }}" required autocomplete="about_us" autofocus></textarea>
                                @error('about_us')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>  


<script>

$("#example").select2({
   tags: true,
   allowClear: true, //
   closeOnSelect: false,
   tokenSeparators: [',', ' '],
   templateSelection: function(selection) {
        if(selection.selected) {
            return $.parseHTML('<span class="customclass">' + selection.text + '</span>');
        }
        else {
            return $.parseHTML('<span class="customclass">' + selection.text + '</span>');
        }
    }

});

$("#example").on("select2:select", function(e) {
$("li[aria-selected='true']").addClass("customclass");
$("li[aria-selected='false']").removeClass("customclass");
$('.select2-search-choice:not(.my-custom-css)', this).addClass('my-custom-css');
});

$("#example").on("select2:unselect", function(e) {
$("li[aria-selected='false']").removeClass("customclass");
});
</script>
@endsection