@extends('layouts.app')

@section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li class="active">
                                <a href="javascript::void(0)">Mensagens</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Mensagens</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <section class="message_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="cardify messaging_sidebar">
                        <div class="messaging__header">
                            <div class="messaging_menu">
                                <a href="javascript:void(0)" id="drop2" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="lnr lnr-inbox"></span>Inbox
                                    <span class="msg">0</span>
                                    <span class="lnr lnr-chevron-down"></span>
                                </a>

                                <ul class="custom_dropdown messaging_dropdown dropdown-menu" aria-labelledby="drop2">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <span class="lnr lnr-inbox"></span>Inbox
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.messaging_menu -->

                            <div class="messaging_action">
                                <span class="lnr lnr-sync"></span>
                            </div>
                            <!-- end /.messaging_action -->
                        </div>
                        <!-- end /.messaging__header -->

                        <div class="messaging__contents">
                            <div class="message_search">
                                <input type="text" placeholder="Buscar mensagem ...">
                                <span class="lnr lnr-magnifier"></span>
                            </div>

                            <div class="messages">
                                @if($users->count() > 0)
                                    @foreach($users as $user)
                                        <div class="message">
                                            <div class="message__actions_avatar">
                                                <div class="avatar">
                                                    <img src="/chat/images/user-avatar.png" alt="">
                                                </div>
                                            </div>
                                            <!-- end /.actions -->

                                            <div class="message_data">
                                                <div class="name_time">
                                                    <div class="name">
                                                        <p>
                                                            <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->name }}">
                                                                {{ $user->name }}
                                                            </a>
                                                        </p>
                                                        <span class="lnr lnr-envelope"></span>
                                                    </div>

                                                    <span class="time">
                                                        <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->name }}">
                                                        Abrir chat
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- end /.message_data -->
                                        </div>
                                        <!-- end /.message -->
                                    @endforeach
                                @else
                                    <p>No users found! try to add a new user using another browser by going to <a href="{{ url('register') }}">Register page</a></p>
                                @endif

                            </div>
                            <!-- end /.messages -->
                        </div>
                        <!-- end /.messaging__contents -->
                    </div>
                    <!-- end /.cardify -->
                </div>
                <!-- end /.col-md-5 -->

            </div>
            <!-- end /.row -->
        </div>
    </section>

    @include('layouts.includes.chat-box')

    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
@stop

@section('script')

@stop
