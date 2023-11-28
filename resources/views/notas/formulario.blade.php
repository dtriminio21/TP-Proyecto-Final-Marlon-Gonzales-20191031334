@extends('plantillas.plantilla')
@section('titulo', 'Editar')

<style>
    body{
        margin-top:20px;
        background:#eee;
    }
    .gradient-brand-color {
        background-image: -webkit-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
        background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
        color: #fff;
    }
    .contact-info__wrapper {
        overflow: hidden;
        border-radius: .625rem .625rem 0 0
    }

    @media (min-width: 1024px) {
        .contact-info__wrapper {
            border-radius: 0 .625rem .625rem 0;
            padding: 5rem !important
        }
    }
    .contact-info__list span.position-absolute {
        left: 0
    }
    .z-index-101 {
        z-index: 101;
    }
    .list-style--none {
        list-style: none;
    }
    .contact__wrapper {
        background-color: #fff;
        border-radius: 0 0 .625rem .625rem
    }

    @media (min-width: 1024px) {
        .contact__wrapper {
            border-radius: .625rem 0 .625rem .625rem
        }
    }
    @media (min-width: 1024px) {
        .contact-form__wrapper {
            padding: 5rem !important
        }
    }
    .shadow-lg, .shadow-lg--on-hover:hover {
        box-shadow: 0 1rem 3rem rgba(132,138,163,0.1) !important;
    }

    .contenedor-formulario{
        padding: 25px;
    }
</style>
@section('contenido')

    <!-- /.display-3 -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

            <div class="container-fluid note-details">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-block card-stretch">
                            <div class="card-body write-card">
                                <div class="container-fluid collapse-fluid">
                                    <h3 class="display-3">{{(isset($notas)? 'Editar Nota' : 'Agregar Nota')}}</h3>
                                    <div class="row">
                                        <form method="post" action="{{ isset($nota) ? route('notas.update', $nota->id) : route('notas.store') }}">
                                            @if(isset($nota))
                                                @method('PUT')
                                            @endif
                                            @csrf
                                        <div class="col-md-12 col-lg-12 p-0">
                                            <div class="card card-transparent card-block card-stretch event-note">
                                                <div class="card-body px-0 bukmark">


                                                        <input type="text" class="form-control mb-3 text-center" id="titulo" name="titulo" required value="{{ old('titulo', isset($nota) ? $nota->titulo : '') }}" placeholder="Titulo">

                                                        <div class="mb-3">
                                                            <textarea class="form-control" id="contenido" name="contenido" placeholder="Contenido" rows="3" required>{{ old('contenido', isset($nota) ? $nota->contenido : '') }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categorias" value="{{ old('categoria', isset($nota) ? ($nota->categorias->isNotEmpty() ? $nota->categorias->pluck('nombre')->join(', ') : '') : '') }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" id="etiquetas" name="etiquetas" placeholder="Etiquetas" value="{{ old('etiquetas', isset($nota) ? ($nota->etiquetas->isNotEmpty() ? $nota->etiquetas->pluck('nombre')->join(', ') : '') : '') }}">
                                                        </div>

                                                        <div class="mb-21">
                                                            <label for="input-color" class="form-label">Color de la Nota</label>
                                                            <div class="d-flex">
                                                                <div class="col-2">
                                                                    <input type="color" class="form-control" id="input-color" name="color" value="{{ isset($nota->color) ? $nota->color :'#ffffff', old('color')}}">
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control ml-2" id="color" name="color" required value="{{ isset($nota->color) ? $nota->color :'#ffffff', old('color')}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-lg-12 p-0 d-flex justify-content-end">
                                                <button class="btn btn-outline-primary" type="submit">Guardar</button>
                                                <a href="{{ route('notas.index') }}" class="btn btn-primary ml-2" data-extra-toggle="toggle" data-extra-class-show=".show-note-button" data-extra-class-hide=".hide-note-button" style="margin-right: 10px">Cerrar</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Resto del contenido de la página -->
                </div>
            </div>



    <script>
        var colorPicker = document.getElementById('input-color');
        var colorCodigoInput = document.getElementById('color');

        colorPicker.addEventListener('input', function() {
            colorCodigoInput.value = colorPicker.value;
            console.log('Color cambiado:', colorPicker.value);
        });
    </script>



@endsection



