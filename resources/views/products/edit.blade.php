@extends('layouts.app')
@section('title', 'Editar ' . $name)

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('errors.errors')

        <!-- New Task Form -->
        <form action=" {{ url('categories/'. $nameC .'/' . $id . '/products') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Nombre:</label>

                <div class="col-sm-6">
                    <input type="text" name="nombre" id="task-name" class="form-control" required value="{{ $name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="task-description" class="col-sm-3 control-label">Descripción:</label>
                <div class="col-sm-6">
                    <textarea name="descripcion" id="task-description" class="form-control" required>{{ $product->description }}</textarea>
                </div>                
            </div>

             <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Iva:</label>

                <div class="col-sm-6">
                    <input type="text" name="iva" id="task-name" class="form-control" required value="{{ $product->tax }}">
                </div>
            </div>
             

            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Precio:</label>

                <div class="col-sm-6">
                    <input type="text" name="precio" id="task-name" class="form-control" required value="{{ $product->price }}">
                </div>
            </div>   

            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Unidades</label>

                <div class="col-sm-6">
                    <input type="text" name="unidades" id="task-name" class="form-control" required value="{{ $product->stock }}">
                </div>
            </div>
            
            <center>
            

            <div align='center'>
            <select name="transporte"  align='center'>
            
            <center><option>{{ $nameC }}</option></center>
            
           
             @foreach ($query as $element)
                <center><option>{{ $element->name }}</option></center>
           @endforeach


                
            </select>
            </div></center>
            <br><br> <br>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <center><button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Actualizar {{ $name }}
                    </button></center>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Tasks -->
@endsection