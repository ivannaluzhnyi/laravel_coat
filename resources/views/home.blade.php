@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
         <div class="card">
             <div class="card-header" style="text-align: center">
                 <h3><a href="{{ url('/categories') }}">Categories</a></h3>
                 {{--            <a class="btn btn-outline-success" href="">Tout les categories</a>--}}
             </div>
             <div class="card-body">
                 <ul >
                     @if(isset($categories))
                         <?php  $limit = 0?>
                         @foreach($categories as $category)
                             @if($limit === 3) @break @endif
                             <li><a href="categories/{{$category->slug_name}}">{{$category->name}}</a> </li>
                             <?php ++$limit ?>
                         @endforeach
                         <br>
                         <a href="{{ url('/categories') }}"><small>Plus de categories...</small></a>
                     @endif
                 </ul>
             </div>
         </div>
        </div>

        <div class="col-7">

            <div class="card">
                <div class="card-header">Poster un article</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <img  src="images/thumbnails/{{Auth::user()->avatar }} " class="col-2 rounded float-left img-thumbnail" style="height: 60px; width: 80px !important; padding: 0 !important" alt="... thumbnail">

                        <textarea data-toggle="modal" data-target="#addPostModal"  placeholder="Exprimez-vous, {{ Auth::user()->name  }}" style="margin: auto" class=" col-8 form-control" name="" id="" cols="30" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <div style="margin-top: 25px; padding: 0" class="card" >

                <div class="card-header">
                    <h5 class="my-1">Les Posts
                    </h5>
                </div>
            </div>

            @foreach($posts as $post)
                <div class="col-auto" style="margin-top: 25px" >
                        <!-- Blog Post -->
                        <div class="card mb-4">
                            @if($post->img)
                                <img class="card-img-top" src="{{'upload_posts/'.$post->img }}" alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <h2 class="card-title">{{$post->name}}</h2>
                                <p class="card-text">{{$post->content}}</p>
                                <a href="{{url($post->slug_name)}}" class="btn btn-primary">Read More &rarr;</a>
                            </div>
                            <div class="card-footer d-flex justify-content-between text-muted">
                                <p>
                                    Posté le {{ date('d/m/Y', strtotime($post->created_at))  }} par {{$post->user_name}}
                                </p>
                                <p class="align-text-top">
                                    qqsd
                                </p>
                            </div>
                        </div>

                </div>

            @endforeach

        </div>

        <div class="col-2">
            sqdqs
        </div>
    </div>

</div>

@endsection

<script>

    CKEDITOR.replace( 'content' );
</script>


    {{--MODAL TO ADD POST--}}
    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Poster un article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <form method="POST" action="{{route('posts')}}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body form-group ">

                    <input name="title" placeholder="Titre" type="text" class="form-control" style="margin-bottom: 20px">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    <textarea placeholder="Exprimez-vous, {{ Auth::user()->name  }}" name="content" id="content" rows="10" cols="80" style="margin-bottom: 20px" class="form-control" required></textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif


                    <input name="file" type="file"  >
                        @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif

                    <div class="form-group">
                        <br />
                        <label class="mr-sm-2" for="inputState">Preference</label>
                        <br />
                        <select name="category" id="inputState" class="form-control">
                            <option value="null">Choisir catégorie ...  </option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="slug" class=" text-md-left">{{ __('Slug') }}</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">/</div>
                                </div>
                                <input type="text" name="slug"  class="form-control" id="slug">
                            </div>

                            @if ($errors->has('slug'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Poster!</button>
                </div>


                </form>
            </div>
        </div>
    </div>
@endsection




