@extends('admin.layout')

@section('header')
    <h1>
        Posts
        <small>Crear un post</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
    </ol>
@endsection

@section('content')
    <div class="row">
        @if ($post->photos->count())
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="row">
                        @foreach ($post->photos as $photo)
                            <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-xs" style="position:absolute">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <img src="{{ Storage::url($photo->url) }}" class="img-responsive">
                                </div>
                            </form>                                
                        @endforeach
                    </div>
                </div>
            </div>            
        @endif
        <form method="POST" action="{{ route('admin.posts.update',$post) }}">
            @method('PUT')
            @csrf
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Título de la publicación</label>
                            <input name="title" placeholder="Ingresa aqui el título de la publicación" 
                            type="text" class="form-control" value="{{ old('title', $post->title) }}">
                            {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label>Contenido de la publicación</label>
                            <textarea name="body" id="editor" class="form-control" rows="10" 
                            placeholder="Ingresa el contenido completo de la publicación">{{ old('body', $post->body) }}</textarea>
                            {!! $errors->first('body','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
                            <label>Contenido embebido (iframe)</label>
                            <textarea name="iframe" class="form-control" rows="2" 
                            placeholder="Ingresa contenido embebido (iframe) de audio o vídeo">{{ old('iframe', $post->iframe) }}</textarea>
                            {!! $errors->first('iframe','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>      
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Fecha de publicación</label>            
                            <div class="input-group date">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input name="published_at" type="text" class="form-control pull-right" 
                                id="datepicker" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null )  }}">
                            </div>                           
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label>Categoría</label>
                            <select name="category_id" id="category_id" class="form-control select2" >
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id',$post->category_id) ? 'selected':''}}>
                                        {{ $category->name }}</option>                                    
                                @endforeach
                            </select>
                            {!! $errors->first('category_id','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label>Multiple</label>
                            <select class="form-control select2" multiple="multiple" 
                                    data-placeholder="Selecciona una o más etiquetas"
                                    style="width: 100%;" name="tags[]">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected':'' }}>
                                            {{ $tag->name }}</option>
                                    @endforeach
                            </select>
                            {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
                          </div>
                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label>Extracto de la publicación</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" 
                            placeholder="Ingresa un extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                            {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
                        </div> 
                    </div>    
                </div>            
            </div>
        </form>
    </div>

    @push('styles')
        <!-- dropzone Handles drag and drop of files for you. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">

    @endpush
    
    @push('scripts')
        <!-- dropzone Handles drag and drop of files for you. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js"></script>
        <!-- bootstrap datepicker -->
        <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- CK Editor -->
        <script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
        <!-- Select2 -->
        <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

        <script type="text/javascript">
            //Initialize Select2 Elements
            $('.select2').select2({
                tags: true
            });

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            CKEDITOR.replace('editor')
            CKEDITOR.config.height = 315;

            var myDropzone = new Dropzone('.dropzone', {
                url: '/admin/posts/{{ $post->url }}/photos',
                acceptedFiles: 'image/*',
                maxFilesize: 2,
                //maxFiles: 1,
                paramName: 'photo',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: 'Arrastras las fotos aquí para subirlas'
            });

            myDropzone.on('error', function(file, res){
                var msg = res.errors.photo[0];
                $('.dz-error-message:last > span').text(msg);
            });

            Dropzone.autoDiscover = false;
        </script>
    @endpush
   
@endsection





