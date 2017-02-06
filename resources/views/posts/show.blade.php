@extends('main')

@section('title', 'View Post')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h2>Category:</h2>
			<h1>{{ $post->category }}</h1>
			<h2>Title:</h2>
			<h1>{{ $post->title }}</h1>
			<h2>Blog:</h2>
			<p class="lead">{!! $post->body !!}</p>
			<br><br>
			<h4>Comments to be approve: </h4>
			<br>
			@foreach($comments as $comment)
				<p>{{$comment->name}}: {{$comment->comment}}</p>
				{!! Html::linkroute('status', 'Approve', [$comment->id,$post->id], array('class' => 'btn btn-success')) !!}
		        {!! Html::linkroute('status', 'Disapprove', [$comment->id,$post->id], array('class' => 'btn btn-danger')) !!}
		        {{ csrf_field() }}
			@endforeach
		</div>




		<div class="col-md-4">																										
			<div class="well">
				<dl class="dl-horizontal">		
					<label>Url: </label>
					<p><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></p>
				</dl>

				<dl class="dl-horizontal">
					<label>Created At: Date</label>
					<p>{{ date('M j, Y h:i a', strtotime($post->created_at)) }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Last Updated: Date</label>
					<p>{{ date('M j, Y h:i a', strtotime($post->updated_at)) }}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkroute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-sm-6">


  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure want to delete this post?</p>
        </div>
        
        <div class="modal-footer">
        
        		{!! Form::open(['route' => ['posts.destroy', $post->id ], 'method' => 'DELETE']) !!}

						{!! Form::submit('Yes', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
       
     
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>






						{!! Form::open(['route' => ['posts.destroy', $post->id ], 'method' => 'DELETE']) !!}

						{!! Form::submit('Yes', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>

			</div>
		</div>
	</div>




	

		



@endsection