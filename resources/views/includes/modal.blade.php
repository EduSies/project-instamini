<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    {{ __('¿Estás seguro?') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Si eliminas es foto no podrás recuperarla, ¿Estás seguro de que quieres borrarla?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Cancelar') }}
                </button>
                <a href="{{ route('image.delete',['id' => $image->id]) }}" class="btn btn-danger">
                    {{ __('Borrar') }}
                </a>
            </div>
        </div>
    </div>
</div>
