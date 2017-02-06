@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}

@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<h1>Create New Post</h1>

		
	
			
			{!! Form::open(['route' => 'posts.store','data-parsley-validate' => '']) !!}

					<h1>Category</h1>

			<select name="category">
 	 <option value="Travel">travel</option>
 	 <option value="Food">food</option>
  	<option value="Wedding">wedding</option>
 	 <option value="Personal">personal</option>
	</select>	
		<br>
<input type="checkbox" name="status" value="1">Publish<br>
	<br>
				
				{{ Form::label('keyword', 'Keyword:') }}
				{{ Form::hidden('tags', null,array('id' => 'mySingleField')) }}
				<ul id="singleFieldTags"></ul>

    			{{ Form::label('title', 'Title:') }}
    			{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
					
				{{ Form::label('slug', 'Slug:') }}	
				{{ route('blog.single',null) }}<span id="url"></span>
				<input type="hidden" name="slug" value=""><br>

    			{{ Form::label('body', 'Post Body:') }}
    			{{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'id' => 'summernote')) }}
    			{{ Form::hidden('blogger_id', Auth::user()->id) }}
    			<br>
    			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block'))}}
			{!! Form::close() !!}
		</div>
		<div class="col-md-2"></div>
	</div>

	

           
       
                
   
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	<script>
	
	$( "input[name=title]" ).keyup(function() {
  		val = $(this).val();
  		$("#url").html('/'+val);
  		$("input[name=slug]").val(val);
  		
	});

	$(document).ready(function() {
	  $('#summernote').summernote({height: '300px'});
	});



</script>
@endsection

