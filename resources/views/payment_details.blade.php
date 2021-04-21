@extends('layouts.app')


@section('content')
<div class="container">
    <div style="margin-top:20px">
    @if($enable_button)
    <div>
    <h4 class=" " >Payment </h4>
    <div>You are required to pay an amount of <span style="font-weight:bold;color:teal">INR {{$fee}} ONLY </span></div>
    <form method="POST" action="/make-payment">
    @csrf
        <button type="submit"class="waves-effect waves-light btn" >Make payment </button>
    </form>
    </div>
    @endif
    
    

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
                        
    </div>
    @endif

    @if($status !='success')
    <div class="card-panel red lighten-2" >If you have made the payment and the amount has been debited, then wait for 2-3 days for it to be reflected here.<br> If the page is not updated then send us an email at resources@e-yantra.org</div>
    @endif        
    <div class="teal-text" style="margin-top:20px">
        Registration Fee is Non-Refundable. Registration is considered valid only after the successful fee payment.
    </div>
    </div>
</div>
@stop