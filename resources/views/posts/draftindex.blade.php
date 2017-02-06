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
	
	<div class="row">
		<div class="col-md-4">
			<ul class="list-group">
				@foreach($drafts as $draft)
					<li class="list-group-item">
						<h4>{{$draft->title}}</h4>
						<h4>{{ route('blog.single',null) }}/{{$draft->slug}}</h4>
						<a href="" class="btn btn-success">View</a>
						<a href="{{ route('blog.drafts', $draft->id) }}" class="btn btn-success">Edit</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
	

@endsection