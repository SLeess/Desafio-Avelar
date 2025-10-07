@extends('layouts.app')

@push('styles')
<style>
.collapse-icon {
    transition: transform 0.3s ease-in-out;
}

[data-bs-toggle="collapse"]:not(.collapsed) .collapse-icon {
    transform: rotate(180deg);
}
.form-floating .input-group-text {
    height: 100%;
}
.form-floating .form-control {
    border-radius: 0 var(--bs-border-radius) var(--bs-border-radius) 0 !important;
}
.form-card-custom {
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}
.loader-overlay {
    display: none;
    /* position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1070;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(2px); */

    /* */
}

.loader-overlay.d-none {
    opacity: 0;
}
</style>
@endpush

@section('content')
<div class="container">


@include('components.cadastrados')

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Você tem certeza que deseja excluir este registro? Esta ação não pode ser desfeita.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="deleteForm" action="" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection


@push('scripts')
<script>

    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const deleteUrl = button.getAttribute('data-delete-url');
        const form = document.getElementById('deleteForm');
        form.setAttribute('action', deleteUrl);
    });
</script>
<script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // Mascada de Telefone
        $("#telefone").mask("(99) 999999999")
            .blur(function(event) {
                var target, telefone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                telefone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (telefone.length > 10) {
                    element.mask("(99) 9 9999-9999");
                } else {
                    element.mask("(99) 9999-99999");
                }
            });

        //Nacionalidade
        $('#nacionalidade').ready(function() {
            var nacionalidade = $('#nacionalidade').val();
            var $div_paisorigem = $('#paisorigem')
            var $div_estados = $('#estados')
            if (nacionalidade == 'brasileira' || nacionalidade == '') {
                $div_estados.css("display", "block")
                $div_paisorigem.css("display", "none")
            } else {
                $div_estados.css("display", "none")
                $div_paisorigem.css("display", "block")
            }
        }).on('change', function() {
            var nacionalidade = $('#nacionalidade').val();
            var $div_paisorigem = $('#paisorigem')
            var $div_estados = $('#estados')
            if (nacionalidade == 'brasileira' || nacionalidade == '') {
                $div_estados.css("display", "block")
                $div_paisorigem.css("display", "none")
            } else {
                $div_estados.css("display", "none")
                $div_paisorigem.css("display", "block")
            }
        })

        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }


        });
    </script>
@endpush
