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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_number" class="col-md-4 col-form-label text-md-right">{{ __('ID Number') }}</label>

                            <div class="col-md-6">
                                <input  id="id_number" type="number"class="form-control no-arrow @error('id_number') is-invalid @enderror" name="id_number" value="{{ old('id_number') }}" required autocomplete="id_number" autofocus>

                                @error('id_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input  id="age" type="number"class="form-control no-arrow @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Select Course</label>
                            <div class="col-md-6">
                                <select id="course"required class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('age') }}" >
                                    <option value = "BSIT/CS">BSIT/CS</option>
                                    <option value = "BSED/BEED">BSED/BEED</option>
                                    <option value = "BSBA">BSBA</option>
                                    <option value = "BSAT/BSA">BSAT/BAS</option>
                                    <option value = "BSHRM/TM">BSHRM/TM</option>
                                    <option value = "BSCJ">BSCJ</option>
                                    <option value = "ENG'G">ENG'G</option>
                                    <option value = "DASE">DASE</option>
                                </select>
                                  @error('course')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                            </div>
                          </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Year Level</label>
                            <div class="col-md-6">
                                <select id="yearlevel"required class="form-control @error('yearlevel') is-invalid @enderror" name="yearlevel" value="{{ old('yearlevel') }}" >
                                    <option value = "1st">First Year</option>
                                    <option value = "2nd">Second Year</option>
                                    <option value = "3rd">Third Year</option>
                                    <option value = "4th">Fourth Year</option>
                                    <option value = "5th">Fifth Year</option>
                                  </select>
                                  @error('yearlevel')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                            </div>
                          </div>


                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input value="63"  id="mobile" type="number"class="form-control no-arrow @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Gender</label>
                            <div class="col-md-6">
                                <select id="sex"required class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ old('sex') }}" >
                                    <option value = "Male">Male</option>
                                    <option value = "Female">Female</option>
                                
                                  </select>
                                  @error('course')
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button style="background-color: #8B0000; color: white" type="submit" class="btn">
                                    {{ __('Register') }}
                                </button>
                                <a style="background-color: #8B0000; color: white" class="btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        
                            
                           
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
