@extends('plantillas.plantilla')
@section('titulo', 'Pagina Inicial')
@section('contenido')
    <style>

        .tab-content{
            padding: 30px;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: 0;
        }
        .card {
            margin-bottom: 30px;
        }
        .card-body {
            flex: 1 1 auto;
            padding: 1.57rem;
        }

        .note-has-grid .nav-link {
            padding: .5rem
        }

        .note-has-grid .single-note-item .card {
            border-radius: 10px
        }

        .note-has-grid .single-note-item .favourite-note {
            cursor: pointer
        }

        .note-has-grid .single-note-item .side-stick {
            position: absolute;
            width: 3px;
            height: 35px;
            left: 0;
            background-color: rgba(82, 95, 127, .5)
        }

        .note-has-grid .single-note-item .category-dropdown.dropdown-toggle:after {
            display: none
        }

        .note-has-grid .single-note-item .category [class*=category-] {
            height: 15px;
            width: 15px;
            display: none
        }

        .note-has-grid .single-note-item .category [class*=category-]::after {
            content: "\f0d7";
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 12px;
            color: #fff;
            position: absolute
        }

        .note-has-grid .single-note-item .category .category-business {
            background-color: rgba(44, 208, 126, .5);
            border: 2px solid #2cd07e
        }

        .note-has-grid .single-note-item .category .category-social {
            background-color: rgba(44, 171, 227, .5);
            border: 2px solid #2cabe3
        }

        .note-has-grid .single-note-item .category .category-important {
            background-color: rgba(255, 80, 80, .5);
            border: 2px solid #ff5050
        }

        .note-has-grid .single-note-item.all-category .point {
            color: rgba(82, 95, 127, .5)
        }

        .note-has-grid .single-note-item.note-business .point {
            color: rgba(44, 208, 126, .5)
        }

        .note-has-grid .single-note-item.note-business .side-stick {
            background-color: rgba(44, 208, 126, .5)
        }

        .note-has-grid .single-note-item.note-business .category .category-business {
            display: inline-block
        }

        .note-has-grid .single-note-item.note-favourite .favourite-note {
            color: #ffc107
        }

        .note-has-grid .single-note-item.note-social .point {
            color: rgba(44, 171, 227, .5)
        }

        .note-has-grid .single-note-item.note-social .side-stick {
            background-color: rgba(44, 171, 227, .5)
        }

        .note-has-grid .single-note-item.note-social .category .category-social {
            display: inline-block
        }

        .note-has-grid .single-note-item.note-important .point {
            color: rgba(255, 80, 80, .5)
        }

        .note-has-grid .single-note-item.note-important .side-stick {
            background-color: rgba(255, 80, 80, .5)
        }

        .note-has-grid .single-note-item.note-important .category .category-important {
            display: inline-block
        }

        .note-has-grid .single-note-item.all-category .more-options,
        .note-has-grid .single-note-item.all-category.note-favourite .more-options {
            display: block
        }

        .note-has-grid .single-note-item.all-category.note-business .more-options,
        .note-has-grid .single-note-item.all-category.note-favourite.note-business .more-options,
        .note-has-grid .single-note-item.all-category.note-favourite.note-important .more-options,
        .note-has-grid .single-note-item.all-category.note-favourite.note-social .more-options,
        .note-has-grid .single-note-item.all-category.note-important .more-options,
        .note-has-grid .single-note-item.all-category.note-social .more-options {
            display: none
        }

        @media (max-width:767.98px) {
            .note-has-grid .single-note-item {
                max-width: 100%
            }
        }

        @media (max-width:991.98px) {
            .note-has-grid .single-note-item {
                max-width: 216px
            }
        }

    </style>

    <div class="tab-content bg-transparent grid js-masnry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>

        <div class="col-12 d-flex justify-content-center"><a class="btn btn-dark" style="margin: 0 auto; margin-bottom: 10px" href="{{route('notas.create')}}">Nueva Nota</a></div>
        <!-- /.col-12 d-flex justify-content-center -->

        <div id="note-full-container" class="note-has-grid row">
            @forelse($notas as $nota)
            <div class="col-md-3 single-note-item all-category note-important">
                    <div class="card card-body">
                        <span class="side-stick" style="background-color: {{ isset($nota->color) ? $nota -> color : '#fff' }}; !important;"></span>
                        <h5 class="note-title text-truncate w-75 mb-0" data-noteheading="{{$nota -> titulo}}">{{$nota -> titulo}} <i class="point fa fa-circle ml-1 font-10" style="color: {{ isset($nota->color) ? $nota -> color : '#fff' }}; !important;"></i></h5>
                        <p class="note-date font-12 text-muted">{{ $nota -> fecha_creacion}}</p>
                        <div class="note-content">
                            <p class="note-inner-content text-muted" data-notecontent="{{$nota -> contenido}}">{{$nota -> contenido}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mr-1"><a href="{{ route('notas.show', $nota->id) }}"><i class="fa fa-eye favourite-note"></i></a> </span>
                            <span class="mr-1"><a data-bs-toggle="modal" data-bs-target="#modal{{$nota->id}}"><i class="fa fa-trash"></i></a> </span>
                            <span class="mr-2">
                            <i class="fa fa-solid fa-tag">
                                <span>{{isset($etiqueta->nombre) ? ($etiqueta->nombre) : 'Sin Etiquetas'}}</span>
                        </i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal{{$nota->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Nota</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Desea realmente eliminar la nota {{$nota->titulo}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <form method="post" action="{{route('notas.destroy', $nota->id)}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h1>No hay tarjetas</h1>
                <a href="{{route('notas.create')}}" class="btn btn-primary">Agregar</a>
            @endforelse
            </div>

        {{$notas->links()}}
    </div>

    <script>
        document.getElementById('categoria').addEventListener('change', function() {
            // Obtén el valor seleccionado
            var categoriaSeleccionada = this.value;

            // Realiza una solicitud Ajax para obtener las notas de la categoría seleccionada
            axios.get('/obtener-notas-por-categoria/' + categoriaSeleccionada)
            .then(function(response) {
                // Actualiza el contenido del contenedor con las notas
                var notasContainer = document.getElementById('notas-container');
                notasContainer.innerHTML = '';

                // Itera sobre las notas y agrega su información al contenedor
                response.data.notas.forEach(function(nota) {
                    var notaElement = document.createElement('div');
                    notaElement.textContent = nota.titulo; // Puedes cambiar esto según la estructura de tus notas
                    notasContainer.appendChild(notaElement);
                });
            })
            .catch(function(error) {
                console.error('Error al obtener notas:', error);
            });
        });
    </script>

@endsection

