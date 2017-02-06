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
      
    			{{ Form::label('title', 'Title:') }}
    			{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
				
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255']) }}

    			{{ Form::label('body', 'Post Body:') }}
    			{{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
    			{{ Form::hidden('blogger_id', $adminid) }}
    			<br>
    			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block'))}}
			{!! Form::close() !!}
		</div>
		<div class="col-md-2"></div>
	</div>

