@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
    	@if(!empty($successMsg))
	    <div class="alert alert-success">
	        {{ $successMsg }}
	    </div>
	    @endif
	    <div class="stepwizard">
	        <div class="stepwizard-row setup-panel">
	            <div class="multi-wizard-step">
	                <a href="#step-1" type="button"
	                    class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
	                <p>Step 1</p>
	            </div>
	            <div class="multi-wizard-step">
	                <a href="#step-2" type="button"
	                    class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
	                <p>Step 2</p>
	            </div>
	            <div class="multi-wizard-step">
	                <a href="#step-3" type="button"
	                    class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}"
	                    disabled="disabled">3</a>
	                <p>Step 3</p>
	            </div>
	        </div>
	    </div>
	    <!-- =======STEP 1======== -->
	    <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
	        <div class="col-md-12">
	            <h3> Step 1</h3>
	            <div class="form-group">
	                <label for="title">Team Name:</label>
	                <input type="text" wire:model="name" class="form-control" id="taskTitle">
	                @error('name') <span class="error">{{ $message }}</span> @enderror
	            </div>
	            <div class="form-group">
	                <label for="description">Team Price:</label>
	                <input type="text" wire:model="price" class="form-control" id="teamPrice" />
	                @error('price') <span class="error">{{ $message }}</span> @enderror
	            </div>
	            <div class="form-group">
	                <label for="detail">Team Details:</label>
	                <textarea type="text" wire:model="detail" class="form-control"
	                    id="taskDetail">{{{ $detail ?? '' }}}</textarea>
	                @error('detail') <span class="error">{{ $message }}</span> @enderror
	            </div>
	            <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
	                type="button">Next</button>
	        </div>
    	</div>
    </div>
</div>