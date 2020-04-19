@extends('layouts.customer', ['class' => 'landing-page sidebar-collapse'])

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('material') }}/img/backg.svg');padding-bottom: 5em;
    background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Buy Airtel Airtime From Mpesa.</h1>
                <h4>Buy Airtel airtime from the comfort of your office or home using Mpesa.</h4>
                <br>
                <a href="#buy"  class="btn btn-primary btn-raised btn-lg">
                    <i class="add_shopping_cart"></i> Buy Now
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section section-contacts" id="buy" style="padding-bottom:1px;">
            <div class="row">

                <div  class="col-md-4">
                    <h2 class="text-center title">BUY AIRTIME</h2>
                    <h4 class="text-center description">Buy Airtel airtime from Mpesa instantly & at no extra cost.</h4>
                </div>

                <div  class="col-md-8 ">
                    {{--                        <h2 class="text-center title">Fill this form to get started</h2>--}}
                    <form class="contact-form" method="POST" action="{{route('confirm')}}"  autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-success">



                                <h4 class="card-title">{{ __('Fill this form to get started') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="form-group">
                                    <label for="amount" class="bmd-label-floating">Amount of airtime you want to buy</label>
                                    <input type="number" id="amount" min="5" max="70000" name="amount" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount','5') }}" placeholder="Amount" required="true" aria-required="true"/>
                                    @if ($errors->has('amount'))
                                        <span id="amount-error" class="error text-danger"
                                              for="amount">{{ $errors->first('amount') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="saf" class="bmd-label-floating">Mpesa Phone Number</label>
                                    <input id="saf" type="text" class="form-control{{ $errors->has('saf') ? ' is-invalid' : '' }}" name="saf" value="{{ old('saf') }}" placeholder="Mpesa Phone Number" required="true" aria-required="true"/>

                                    @if ($errors->has('saf'))
                                        <span id="saf-error" class="error text-danger"
                                              for="saf">{{ $errors->first('saf') }}</span>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label for="airtel" class="bmd-label-floating">Airtel Phone Number</label>
                                    <input id="airtel" type="text" class="form-control{{ $errors->has('airtel') ? ' is-invalid' : '' }}" name="airtel" placeholder="Airtel Phone Number" value="{{ old('airtel') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('airtel'))
                                        <span id="airtel-error" class="error text-danger"
                                              for="airtel">{{ $errors->first('airtel') }}</span>
                                    @endif
                                </div>
                                <div class="card-footer ml-auto mr-auto text-center">
                                    <button type="submit" id="continue" class="btn btn-danger btn-raised">{{ __('Continue') }}</button>
                                </div>
                                {{--                                    <div class="row">--}}
                                {{--                                <div class="col-md-4 ml-auto mr-auto text-center">--}}
                                {{--                                    <button class="btn btn-danger btn-raised">--}}
                                {{--                                        Continue--}}
                                {{--                                    </button>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                    </form>

                </div>


            </div>
        </div>
        <div class="section text-center" id="howto" style="padding-top:1px;" >
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="title">Buy airtime in 3 easy steps</h2>
                    <h5 class="description">Hustle Free.</h5>
                </div>
            </div>
            <div class="features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-info">
                                <i class="material-icons">create</i>
                            </div>
                            <h4 class="info-title">1. Fill the form</h4>
                            <p>Fill form and confirm details.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">mobile_screen_share</i>
                            </div>
                            <h4 class="info-title">2. Pay</h4>
                            <p>Make Mpesa Payment.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">mobile_friendly</i>
                            </div>
                            <h4 class="info-title">3. Phone number topped up</h4>
                            <p>Receive Airtel airtime top up instantly.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 ml-auto mr-auto text-center">
                        <a href="#buy"  class="btn btn-warning btn-raised">
                            <i class="add_shopping_cart"></i> Buy Now
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
