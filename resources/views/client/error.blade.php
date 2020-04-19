@extends('layouts.customer', ['class' => 'profile-page sidebar-collapse'])

@section('content')

    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('material') }}/img/herror.svg'); background-position: center top;background-size: contain"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ asset('material') }}/img/error.svg" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <form class="contact-form" method="POST" action="{{route('pay')}}"  autocomplete="off" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="name">
                                    <h3 class="title text-danger">Opppss An Error Occured!!!</h3>
                                    <h6><span style="color: blue;">An Error Occurred while initiating payment, Please try again.</span></h6>

                                    <div class="row">
                                        <div class="ml-auto mr-auto text-center">

                                                                                <a href="/#buy"  class="btn btn-primary btn-raised btn-round">

                                                                                    <i class="material-icons">settings_backup_restore</i> Try Again
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
