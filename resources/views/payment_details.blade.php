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
        @if (session('error'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Payment') }}</h4>
            </div>            
            
            @if($enable_button)
            <div class="card-body h4">
                @if(Auth::user()->role == 1)
                <p>
                    The internship fee is required to be paid for the resources and mentorship e-Yantra provides during the period of eYSIP. Upon the successful completion of the project allotted to you, you will be awarded with an honorarium (along with internship certificate) which will compensate you sufficiently for the internship fee as well as the work you have done during the  internship period.<br><br>
                </p>    
                @endif

                @if(Auth::user()->role == 4)
                <p>
                    The internship fee is required to be paid for the resources and mentorship e-Yantra provides during the period of eYSIP.<br><br>
                </p>    
                @endif

                <p>You are required to pay an amount of <span style="font-weight:bold;color:teal">INR {{$fee}} ONLY </span></p>
            
                <form method="POST" action="{!!route('make-payment')!!}">
                    @csrf
                    <button type="submit"class="btn btn-primary" >Make payment </button>
                </form>                              
            </div>    
            @endif
        </div>


        @if($status != null)
        <h4>Transaction details </h4>
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
        <div>
            <p class="h4">
                If you have made the payment and the amount has been debited, then wait for 2-3 days for it to be reflected here.<br> If the page is not updated then send us an email at eysip@e-yantra.org.
            </p>
        </div>
        @endif        
    
        <p class="h4"><b>Internship Fee is Non-Refundable. Registration is considered valid only after the successful fee payment.</b></p>
    </div>
</div>
@stop
