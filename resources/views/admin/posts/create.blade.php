<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form method="POST" action="{{ route('admin.posts.store', '#create') }}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Título de la publicación</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {{-- <label>Título de la publicación</label> --}}
                        <input name="title" id="post-title" placeholder="Ingresa aqui el título de la publicación" 
                        type="text" class="form-control" value="{{ old('title') }}" autofocus required>
                        {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Crear publicación</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        if( window.location.hash === '#create'){
            $('#myModal').modal('show');
        }
        $('#myModal').on('hide.bs.modal', function(){
            window.location.hash = '#';
        });
        $('#myModal').on('shown.bs.modal', function(){
            $('#post-title').focus();
            window.location.hash = '#create';
        });
  </script>
@endpush