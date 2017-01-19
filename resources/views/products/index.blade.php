@extends('layouts.app')
@section('title', $nameCategory)


@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="panel panel-default">
                    <h2><center><div class="panel-heading">
                        {!! 'Productos de la categoria ' . $nameCategory !!}              
                    </div></center></h2>
                    <div class="panel-body">
                    @if (count($products) > 0)
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Tarea</th>
                                <th>Iva</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>


                            <tbody>
                                @foreach($products as $task)
                                  
                                <td>{{ $task->name }} <br>
                                    <span class="small">
                                    Creado por: 
                                    
                                    {{ Auth::user()->name }}

                                    </span></td>

    
                                     <td> <br>
                                    <span class="small">
                                      {{ (($task->tax / 100) * $task->price) * $task->stock}}
                                    </span></td>

                                     <td> <br>
                                    <span class="small">
                                     
                                    {{  ($task->price * $task->stock) + (($task->tax / 100) * $task->price) * $task->stock}}
                                    </span></td>


                                 <td> <br>
                                    <span class="small">
                                   
                                    {{$task->stock}}
                                    </span></td>

                                

                                 <td> <br>
                                    <span class="small">
                                   
                                    {{ $task->description }}
                                    </span></td>
                                



                                
                                    <td>
                                        <form 
                                        action="{{ url('products/delete/' . $task->id) }}"
                                        method="POST"
                                        >
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button onclick="return confirm('¿Seguro que quieres eliminarlo?')"
                                            class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a 
                                            href="{{
                                             url('categories/' . $nameCategory . '/' . $task->name . '/edit/' . $task->id)
                                             }}"
                                            class="btn btn-warning btn-sm" 
                                            ><i class="fa fa-edit"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <center> {{ $products->render() }} </center>
                    @else
                       <center> <b>No hay ningun productos</b>
                    @endif
                    @if (Auth::user())
                    <br>
                    <br><br><br>
                    <center><a href="{{ url('products/create') }}" class="btn btn-success btn-sm">Crear un producto</a></center>
                    @endif          
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection