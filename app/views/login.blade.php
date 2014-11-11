@extends('layouts.default_noheader')

@section('header')
  <title>Login Page</title>

@stop


@section('content')

{{ Form::open(array('url' => 'login')) }}
<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Log In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
						
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="text-center glyphicon glyphicon-user">
                                        {{ Form::label('email', 'Email Address') }}
										{{ Form::text('email', Input::old('email'), array('placeholder' => 'jdoe@example.com')) }} </i></span>
                                                                               
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="text-center">
                                        <span class="input-group-addon"><i class="text-center glyphicon glyphicon-lock">
                                        {{ Form::label('password', 'Password') }}
										{{ Form::password('password') }}</i></span>
                                    </div>
                                    


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="text-center">
                                      <a id="btn-login" href="#" class="btn btn-success">{{ Form::submit('Login') }} </a>

                                    </div>
                                </div>


                                <div class="text-center">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            {{link_to("register", 'Sign Up Here') }}
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        
                    
         {{ Form::close() }}

@stop           
