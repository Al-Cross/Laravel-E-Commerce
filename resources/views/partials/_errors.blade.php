<div class="container">
	@if ($errors->count() > 0)
    	<ul>
    		@foreach($errors->all() as $error)
        		<div class="alert alert-danger">
        			<li>{{ $error }}</li>
        		</div>
        	@endforeach
    	</ul>
    @endif
</div>
