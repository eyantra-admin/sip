@extends('layouts.app', ['activePage' => 'validate', 'titlePage' => __('Validate')])

@section('style')
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<style>
			

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 24px;
				margin-top: 5px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
@endsection
@section('content')

<div class="container ">
	<div class="row">
		<div class="col-md-10 col-md-offset-2 ">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">Enter the Hash Code ( QR code Certificate )</div>
				<br />
				<form class="form-horizontal" role="form" method="POST" action="{{ url('validate') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">Hash Number</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="certiNumber" required>
					</div>
				</div>
				<br />
					<div class="form-group">
						<div class="col-md-4 col-md-offset-3">
							<button type="submit" class="btn btn-primary" name="hash" >Submit</button>&nbsp; &nbsp; &nbsp;&nbsp;
						</div>
					</div>
				</form>
		</div>
		</div>
	</div>
</div>
@endsection
