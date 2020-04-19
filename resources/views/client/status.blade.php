@extends('layouts.customer', ['class' => 'profile-page sidebar-collapse'])

@section('content')


    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('material') }}/img/alert.svg');background-repeat: no-repeat;background-attachment: fixed;background-position: inherit; "></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ asset('material') }}/img/notify.svg" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title text-warning">Transaction status</h3>
                                <h6 class="text-danger">{{$status ?? ''}}.</h6>
                                <h6>Meanwhile.....share the message below to help us get the word out.</h6>
                                <div class="description text-center">
                                    <p>I topped up my airtime instantly at <a href="#">Kredo <sup>+</sup></a>.
                                        You should try it too.</p>
                                </div>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.KredoPlus.co.ke%2Fbuyairtime%2F" target="_blank" class="btn btn-just-icon btn-link btn-facebook"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?text=I%20topped%20up%20my%20airtime%20instantly%20at%20https%3A%2F%2Fwww.KredoPlus.co.ke%2Fbuyairtime.%20You%20should%20try%20it%20too.%20" target="_blank" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                                <a href="whatsapp://send?text=I%20topped%20up%20my%20airtime%20instantly%20at%20https%3A%2F%2Fwww.KredoPlus.co.ke%2Fbuyairtime.%20You%20should%20try%20it%20too.%20" target="_blank" class="btn btn-just-icon btn-link btn-whatsapp"><i class="fa fa-whatsapp"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
