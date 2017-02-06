@extends('main')

@section('title', 'Edit Post')

@section('content')

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h1 class="text-center">Drafts</h1>
		</div>
		<div class="col-md-4"></div>
	</div>

	@foreach($drafts as $draft)
		<div class="row">
		{!! Form::model($draft, ['route' => ['posts.update', $draft->id ], 'method'=> 'PUT']) !!}
			<div class="col-md-8">
	
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', $draft->title, ["class" => "form-control input-lg"]) }}
				<br>
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', $draft->slug, ["class" => "form-control input-lg"]) }}
				<br>
				{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body',$draft->body, ["class" => "form-control", 'id' => 'summernote']) }}
				<br>
				
			</div>
			<div class="col-md-4">
				<div class="well">
					<dl>
						<dt>Draft</dt>
					</dl>
					<dl class="dl-horizontal">
						<dt>Created At: Date</dt>
						<dd>{{ date('M j, Y h:i a', strtotime($draft->created_at)) }}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Last Updated: Date</dt>
						<dd>{{ date('M j, Y h:i a', strtotime($draft->updated_at)) }}</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>Publish</dt>
						<dd><input type="checkbox" name="status" value="published"></dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							{!! Html::linkroute('posts.show', 'Cancel', array($draft->id), array('class' => 'btn btn-danger btn-block')) !!}
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

@section('scripts')
	<script>

	$(document).ready(function() {
	  $('#summernote').summernote({height: '300px'});
	});



</script>
@endsection

@endsection