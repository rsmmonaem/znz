@include('layouts.head')
	
<div class="container">
	<div class="logo-brand header sidebar rows">
		<div class="logo" style="text-align: center">
			<style>
				.sidebar-inner .media {
					margin: 10px -15px 0 -15px !important;
				}
			</style>
			<h1>Welcome to J & Z Group</h1>
			{{-- <h1><a href="{!! URL::to('/') !!}">{!! config('config.application_name').' '.config('code.version') !!}</a></h1> --}}
		</div>
	</div>
	@include('layouts.sidebar')
    <div class="right content-page">

		@include('layouts.header')	
		
        <div class="body content rows scroll-y">
			@yield('breadcrumb')
			
			@include('message')

			@yield('content')

			@include('layouts.footer')	
        </div>
    </div>
</div>
<div id="overlay"></div>
<div class="modal fade" id="myModal" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
	
@include('layouts.foot')	
@yield('javascript')
		
	
	
	