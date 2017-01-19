@extends('layouts.app')
@section('title', 'Categorias')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <center><div class="panel-heading">Categorias</div></center><hr>

                <div class="panel-body">
                        
                         @if (count($categories) > 0)
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Categoria</th>
                                <th>Descripcion</th>
                                <th>&nbsp;</th>
                            </thead>


                            <tbody>
                                @foreach ($categories as $categorias)
                                <tr>
                                    
                                <td><a href="{{ url('categories/' . $categorias->name . '/' . $categorias->id .'/products') }}">{{ $categorias->name }} <br>
                                    <span class="small"></a>
                                    Creada por: 
                                    {{$categorias->user->name}}
                                    </span></td>
                                    <td>{{ $categorias->description }}</td>
                                   
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>

                        <center> {{ $categories->render() }} </center>
                    @else
                        <b>No hay ninguna categoria</b>
                    @endif
                    @if (Auth::user())
                    <br>
                    
                    <center><a href="{{ route('categories.create') }}" class="btn btn-success btn-sm">Crear una categoria</a>    </center>
                    @endif      


                </div>

               

            </div>
        </div>
    </div>
</div>
@endsection
