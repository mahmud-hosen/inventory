@extends('admin.layouts.app')

@section('content')
<div class="container">

<div class="signup-form">
    <form method="POST" action="{{ route('login') }}">
                        @csrf
		<h2>{{ __('Login') }}</h2>
		<hr>
        
        <div id="email_field" class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>                    
				</div>
                <input type="email" id="email" name="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" >
                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                 @enderror
            </div>
        </div>
		
        <div id="password_field" class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-lock"></i>
					</span>                    
				</div>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"  required autocomplete="current-password">
                @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
        </div>
		
		<div id="signin_div" class="form-group">
            <button type="submit" id="submit_button" class="btn btn-primary btn-lg">{{ __('Login') }}</button>
                
        </div>

       
        
    </form>

@endsection
