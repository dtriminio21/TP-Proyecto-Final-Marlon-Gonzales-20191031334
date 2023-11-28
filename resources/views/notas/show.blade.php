@extends('plantillas.plantilla')

@section('titulo', 'perfil')

<style>
    .contenedor-nota{
        padding: 50px;
    }
</style>

@section('contenido')
   <div class="contenedor-nota">
       <!-- /.contenedor-nota -->
        <div class="card text-center nota" style="border: 3px solid {{ $nota-> color}}; !important;">
            <div class="card-header">
                {{$nota->titulo}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$nota -> contenido}}</h5>
                <p class="card-text">  @if($nota->categorias->count() > 0)
                        {{-- Itera sobre las categorías --}}
                        @foreach($nota->categorias as $categoria)
                            <span class="badge badge-dark">{{ $categoria->nombre }}</span> {{-- Muestra el nombre de la categoría --}}
                        @endforeach
                    @else
                        {{-- No hay categorías --}}
                        <span class="badge badge-secondary">Sin categoría</span>
                    @endif</p>
                <a href="{{route('notas.edit', $nota)}}" class="btn btn-primary ">Editar</a>
                <a class="btn btn-warning" style="margin: 0 auto" href="{{route('notas.index')}}">Regresar al inicio</a>
            </div>
            <div class="card-footer text-body-secondary">
                {{$nota -> fecha_creacion}}  <br>
                <i class="fa fa-solid fa-tag"></i>
                @forelse($nota -> etiquetas as $etiqueta)
                    {{ $etiqueta -> nombre }}
                @empty
                    No hay etiquetas
                @endforelse
            </div>
        </div>
   </div>

@endsection
