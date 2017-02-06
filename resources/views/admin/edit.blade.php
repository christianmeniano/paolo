<head>
  @include('partials._head')
  @include('partials._javascript')
</head>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Laravel Blog</a>


    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
      
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{$admin->name}}<span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                 <li><a href="{{ route('admin.blog') }}">Home</a></li>
                                  <li>
                        <a href="{{ url('/adminlogout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/adminlogout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                  </li>
                </ul>
            </li>


                       
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container">

<div class="row">
		{!! Form::model($post, ['route' => ['admin.update', $post->id ], 'method'=> 'PUT']) !!}
			<div class="col-md-8">
			


				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, ["class" => "form-control input-lg"]) }}
				<br>
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, ["class" => "form-control input-lg"]) }}
				<br>
				{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body', null, ["class" => "form-control"]) }}
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
							{!! Html::linkroute('admin.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
						</div>
						<div class="col-sm-6">
							{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
						</div>
					</div>

				</div>
			</div>
		{!! Form::close() !!}
</div><!-- end row (form)-->

</div>