@extends('layouts.app')

@section('content')

    <div class="container category">
        <h1>Categories</h1>
        <br>


        <div class="row">
            <div class="col-md-7 col-12">
{{--                {{ dd(!empty($categories)) }}--}}
                @if (!empty($categories))
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Lien</th>
                            <th scope="col">Ajouté le</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->slug_name }} </td>
                                <td> {{ date('d/m/Y', strtotime($category->created_at)) }} </td>
                                @auth
                                    <td>


                                        <a href="/categories/delete/{{$category->id}}"><i class="fas fa-trash">- supprimer</i></a>

                                    </td>
                                @endauth

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    Pas de catgories pour le moment!
                @endif
            </div>
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header">
                        Ajouter un nouveau categorie
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('categories')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row" >
                                <label for="slug" class="col-md-4 col-form-label text-md-right">{{ __('Slug') }}</label>

                                <div class="col-md-6">

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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
