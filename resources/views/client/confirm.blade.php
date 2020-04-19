@extends('layouts.customer', ['class' => 'profile-page sidebar-collapse'])

@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('material') }}/img/confirm.svg');"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="{{ asset('material') }}/img/confirmed.svg" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <form class="contact-form" method="POST" action="{{route('pay')}}"  autocomplete="off" class="form-horizontal">
                            @csrf
                            @method('post')
                        <div class="name">
                            <h3 class="title">Confirm transaction details</h3>
                            <h6>Hey,<br>You have requested to buy airtime worth: <span style="color: red;">{{$amount ?? ''}} KES</span></h6>
                            <h6>The number to be topped up is: <span style="color: red;">{{$airtel ?? ''}}</span></h6>
                            <h6>The number to send Mpesa is: <span style="color: red;">{{$saf ?? ''}}</span></h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" id="continue" class="btn btn-warning btn-raised btn-round">Yes,Proceed<i class="material-icons">play_arrow</i></button>
{{--                                    <a href="#buy"  class="btn btn-warning btn-raised btn-round">--}}

{{--                                        Yes,Proceed<i class="material-icons">play_arrow</i>--}}
{{--                                    </a>--}}
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('/#buy') }}"  class="btn btn-outline-primary btn-raised btn-round">

                                        <i class="material-icons">fast_rewind</i>No,Make Changes
                                    </a>
                                </div>
                            </div>
                        </div>

                            <input type="text" name="saf" value="{{$saf ?? ''}}" hidden>
                            <input type="text" name="airtel" value="{{$airtel ?? ''}}" hidden>
                            <input type="text" name="amount" value="{{$amount ?? ''}}" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
