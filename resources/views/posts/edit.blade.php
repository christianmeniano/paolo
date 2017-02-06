@extends('main')

@section('title', 'Edit Post')

@section('content')




	@foreach($drafts as $draft)
		<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id ], 'method'=> 'PUT']) !!}
			<div class="col-md-8">
	
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, ["class" => "form-control input-lg"]) }}
				<br>
				{{ Form::label('slug', 'Slug:') }}	
				{{ route('blog.single',null) }}<span id="url"></span>
				<input type="hidden" name="slug" value=""><br>
				<br>
				{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body', null, ["class" => "form-control", 'id' => 'summernote']) }}
				<br>
				
			</div>
			<div class="col-md-4">
				<div class="well">
					<dl>
						<dt>Draft</dt>
					</dl>
					<dl class="dl-horizontal">
						<dt>Created At: Date</dt>
						<dd>{{ date('M j, Y h:i a', strtotime($post->created_at)) }}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Last Updated: Date</dt>
						<dd>{{ date('M j, Y h:i a', strtotime($post->updated_at)) }}</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>Publish</dt>
						<dd><input type="checkbox" name="status" value="published"></dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							{!! Html::linkroute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
						</div>
						<div class="col-sm-6">
							{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
						</div>
					</div>

				</div>
			</div>
		{!! Form::close() !!}
	</div><!-- end row (form)-->
	@endforeach





	<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id ], 'method'=> 'PUT']) !!}
			<div class="col-md-8">
			

				{{ Form::label('keyword', 'Keyword:') }}
				{{ Form::hidden('tags', null,array('id' => 'mySingleField')) }}
				<ul id="singleFieldTags"></ul>

				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, ["class" => "form-control input-lg"]) }}
				<br>
				{{ Form::label('slug', 'Slug:') }}	
				{{ route('blog.single',null) }}<span id="url"></span>
				<input type="hidden" name="slug" value=""><br>
				<br>
				{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body', null, ["class" => "form-control", 'id' => 'summernotes']) }}
				{{ Form::hidden('status', 'published') }}
			</div>
			<div class="col-md-4">
				<div class="well">
					<dl class="dl-horizontal">
						<dt>Created At: Date</dt>
						<dd>{{ date('M j, Y h:i a', strtotime($post->created_at)) }}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Last Updated: Date</dt>
						<dd>{{ date('M j, Y h:i a', strtotime($post->updated_at)) }}</dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							{!! Html::linkroute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
						</div>
						<div class="col-sm-6">
							{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
						</div>
					</div>

				</div>
			</div>
		{!! Form::close() !!}
	</div><!-- end row (form)-->

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

		$(document).ready(function() {
	  $('#summernotes').summernote({height: '300px'});
	});




</script>
@endsection