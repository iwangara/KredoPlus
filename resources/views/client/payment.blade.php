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
                            <img src="{{ asset('material') }}/img/payment.svg" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                        </div>
                        <form class="contact-form" method="POST" action="{{route('success')}}"  autocomplete="off" class="form-horizontal">
                            @csrf
                            @method('post')
                        <div class="name">
                            <h3 class="title">Payment</h3>
                            <h6>Amount to pay in KES: <span style="color: red;">{{$amount ?? ''}} KES</span></h6>
                            <h6>Ensure your mobile device is within reach. A popup will prompt you to enter your <span style="color: red;">Mpesa PIN</span> on your mobile device.</h6>
{{--                            <h6>If the Mpesa PIN screen doesn't show automatically; <span style="color: red;"><a--}}
{{--                                        href="">Click here</a></span></h6>--}}
                            <h6>Once you are done click 'Continue' to proceed</h6>
                            <button type="submit" id="continue" class="btn btn-success btn-raised btn-round">Continue<i class="material-icons">play_arrow</i></button>
{{--                            <a href="{{url('/success')}}"  class="btn btn-success btn-raised btn-round">--}}

{{--                                Continue<i class="material-icons">play_arrow</i>--}}
{{--                            </a>--}}
                        </div>
                            <input type="text" name="CheckoutRequestID" value="{{$CheckoutRequestID ?? ''}}" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
