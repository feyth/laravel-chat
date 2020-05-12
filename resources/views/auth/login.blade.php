@extends('layouts.app')

@section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)">Login</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Login</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <section class="login_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>Bem vindo!</h3>
                                <p>Digite seus dados para entrar.</p>
                            </div>
                            <!-- end .login_header -->

                            <div class="login--form">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input placeholder="Digite seu e-mail" id="email" type="email" class="text_field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input placeholder="Digite sua senha" id="password" type="password" class="text_field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <button class="btn btn--md btn--round" type="submit">Entrar</button>

                                <div class="login_assist">
                                    <p class="signup">Não tem uma conta?
                                        <a href="/register">Cadastre-se</a>!
                                    </p>
                                </div>
                            </div>
                            <!-- end .login--form -->
                        </div>
                        <!-- end .cardify -->
                    </form>
                </div>
                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
@endsection
