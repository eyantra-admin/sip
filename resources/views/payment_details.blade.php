@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Payment')])


@section('content')
<div class="content">
    <div class="container-fluid">
        @if (session('status'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Payment') }}</h4>
            </div>            
            
            @if($enable_button)
            <div class="card-body">
                <h3>
                    The internship fee is required to be paid for the resources and mentorship e-Yantra provides during the period of eYSIP. Upon the successful completion of the project allotted to you, you will be awarded with an honorarium (along with internship certificate) which will compensate you sufficiently for the internship fee as well as the work you have done during the  internship period.<br><br>


                    You are required to pay an amount of <span style="font-weight:bold;color:teal">INR {{$fee}} ONLY </span></h3>
            
                {{--<form method="POST" action="{!!route('make-payment')!!}">
                    @csrf
                    <button type="submit"class="btn btn-primary" >Make payment </button>
                </form>--}}

                @if(is_null($trxData->trxDate) && is_null($trxData->trxUTR))
                <div class="alert alert-info" role="alert" style="color: black;">
                    <p>Please transfer the amount of Rs. 5000/- to confirm your internship with us.</p>
                    <p>The payment can be made through bank transfer.</p>
                    <p>Please use the following details to make the payment:</p>

                    <p><b>Account name:</b> IIT BOMBAY PROJECT AND CONSULTANCY</p>
                    <p><b>Account number:</b> 2724101114190</p>
                    <p><b>Bank name:</b> CANARA BANK</p>
                    <p><b>Branch:</b> IIT Powai, Mumbai</p>
                    <p><b>Branch Address:</b> 
                    Canara Bank, I I T Powai Branch, Gulmohar Building, IIT Bombay Powai, Mumbai 400076
                    </p>
                    <p><b>IFSC code:</b> CNRB0002724</p>

                    <p>Once the payment has been made, please fill the following form.</p>
                </div>

                <form method="post" action="{{ route('submitTrxDetails') }}" autocomplete="off" class="form-horizontal">
                @csrf
                    <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">
                            {{ __('Transaction Date') }}
                        </label>
                        <div class="col-sm-3">
                            <div class="input-field {{ $errors->has('trxDate') ? ' has-danger' : '' }}">
                                <input class="form-control" type="text" name="trxDate" id="trxDate" placeholder="Transaction Date" value="{{ old('trxDate')}}">
                                @if ($errors->has('trxDate'))
                                    <span id="fullname-error" class="error text-danger" for="trxDate">{{ $errors->first('trxDate') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">
                            {{ __('Unique Transaction Reference number(UTR)') }}
                        </label>
                        <div class="col-sm-3">
                            <div class="input-field {{ $errors->has('trxUTR') ? ' has-danger' : '' }}">
                                <input class="form-control" type="text" name="trxUTR" id="trxUTR" placeholder="Unique Transaction Reference number(UTR)" value="{{ old('trxUTR')}}">
                                @if ($errors->has('trxUTR'))
                                    <span id="fullname-error" class="error text-danger" for="trxUTR">{{ $errors->first('trxUTR') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>   
                    <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>            
                </form>
                @else
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Payment Deatils') }}</h4>
                    </div>            
            
                    <div class="card-body"><p>We have received your following Transaction details:</p>
                        <p><b>Date:</b> {{$trxData->trxDate}}</p>
                        <p><b>UTR:</b> {{$trxData->trxUTR}}</p>

                        <p>Once we verifiy the transaction details, Will update the payment status.</p>
                    </div>  
                </div>      
                @endif                
            </div>    
            @endif
        </div>


        @if($status != null)
        <h4 class=" " >Transaction details </h4>
            <table>
                <tr class="my-8 border-b-2 border-gray-800">
                    <td class="">Status :</td>
                    <td class="px-4 md:px-8">{{$message}}</td>
                </tr>
                <tr class="my-8 border-b-2 border-gray-800">
                    <td>Amount :</td>
                    <td class="px-4 md:px-8"> Rs {{$fee}}</td>
                </tr>

                <tr class="my-8 border-b-2 border-gray-800">
                    <td>Transaction id :</td>
                    <td class="px-4 md:px-8">{{$trans_id}}</td>
                </tr>
                <tr class="my-8 border-b-2 border-gray-800">
                    <td>transaction date :</td>
                    <td class="px-4 md:px-8">{{$trans_date}}</td>
                </tr>         
            </table>                

        @endif

        @if($status !='success')
        <div><h3><b>If you have made the payment and the amount has been debited, then wait for 2-3 days for it to be reflected here.<br> If the page is not updated then send us an email at support@e-yantra.org</b></h3></div>
        @endif        
    <br><br>
        <div>
            <h3><b>Internship Fee is Non-Refundable. Registration is considered valid only after the successful fee payment.</b></h3>
        </div>
    </div>
</div>
@stop
