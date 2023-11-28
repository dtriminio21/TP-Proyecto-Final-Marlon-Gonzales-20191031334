@extends('plantillas.plantilla')
@section('titulo', 'Notas')
@section('contenido')

    <table class="table table-dark">
        <thead class="table-light">
        <tr>
            <td>Id</td>
            <td>Titulo</td>
            <td>Contenido</td>
            <td>Fecha de Creacion</td>
            <td>Ver</td>
            <td>Categoria</td>
            <td>Editar</td>
            <td>Borrar</td>
        </tr>
        </thead>
        <tbody>
        @foreach($notas as $nota)
            <tr class="{{ isset($nota)?($nota->id_categoria == 1 ? 'table-primary'
: ($nota->id_categoria == 2 ? 'table-secondary' :
    ($nota->id_categoria == 3 ? 'table-danger' : 'table-warning'))) : 'table-warning'}}">
                <td>{{$nota -> id}}</td>
                <td>{{$nota -> titulo}}</td>
                <td>{{$nota -> contenido}}</td>

                <td>{{$nota -> fecha_creacion}}</td>
                <td><a class="btn btn-light" href="{{ route('notas.show', $nota->id) }}">Ver</a> </td>
                <td>Editar</td>
                <td>Borrar</td>
                <td>{{ isset($nota) ?
    ($nota->id_categoria == 1 ? 'Trabajo' : ($nota->id_categoria == 2 ? 'Estudio' :
    ($nota->id_categoria == 3 ? 'Personal' : 'Ayuda'))
    ) :
    'Ayuda'
}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
