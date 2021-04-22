@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Payment')])


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Payment') }}</h4>
            </div>
            @if($enable_button)
            <div class="card-body">
                <h3>You are required to pay an amount of <span style="font-weight:bold;color:teal">INR {{$fee}} ONLY </span></h3>
            
                <form method="POST" action="/make-payment">
                    @csrf
                    <button type="submit"class="btn btn-primary" >Make payment </button>
                </form>
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
        <div><h3><b>If you have made the payment and the amount has been debited, then wait for 2-3 days for it to be reflected here.<br> If the page is not updated then send us an email at eysip@e-yantra.org</b></h3></div>
        @endif        
    <br><br>
        <div>
            <h3><b>Registration Fee is Non-Refundable. Registration is considered valid only after the successful fee payment.</b></h3>
        </div>
    </div>
</div>
@stop