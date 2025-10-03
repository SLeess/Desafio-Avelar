import './bootstrap';
import 'bootstrap';

import jQuery from 'jquery';
import toastr from 'toastr';
import Swal from 'sweetalert2';
import Inputmask from "inputmask";

import 'toastr/build/toastr.min.css';
import 'sweetalert2/dist/sweetalert2.min.css';
import '../sass/app.scss';

window.$ = jQuery;
window.toastr = toastr;
window.Swal = Swal;
window.Inputmask = Inputmask;


toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

document.addEventListener('DOMContentLoaded', function () {
    const telefoneElement = document.getElementById('telefone');
    if (telefoneElement) {
        Inputmask("(99) 99999-9999").mask(telefoneElement);
    }

    const cpfElement = document.getElementById('cpf');
    if (cpfElement) {
        Inputmask("999.999.999-99").mask(cpfElement);
    }

    const cepElement = document.getElementById('cep');
    if (cepElement) {
        Inputmask("99999-999").mask(cepElement);
    }

    const dataElement = document.getElementById('data_nascimento');
    if (dataElement) {
        Inputmask("99/99/9999").mask(dataElement);
    }

    const salarioElement = document.getElementById('salario');
    if (salarioElement) {
        Inputmask("currency", {
            prefix: 'R$ ',
            radixPoint: ',',
            groupSeparator: '.',
            autoGroup: true,
            digits: 2,
            digitsOptional: false,
            rightAlign: false,
            unmaskAsNumber: true
        }).mask(salarioElement);
    }

    if (cepElement) {
        cepElement.addEventListener('blur', function () {
            const cep = this.value.replace(/\D/g, '');
            const loadingCep = document.getElementById('loading-cep');

            if (cep.length !== 8) return;

            if(loadingCep) loadingCep.classList.remove('d-none');

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        // Para o select de UF, o ideal é apenas selecionar a opção correta
                        const ufSelect = document.getElementById('uf');
                        if(ufSelect) ufSelect.value = data.uf;
                    } else {
                        toastr.warning("Preencha manualmente os campos do endereço.", "CEP não encontrado.");
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                    toastr.error("Preencha manualmente os campos do endereço.", "Erro ao consultar CEP.");
                })
                .finally(() => {
                    if(loadingCep) loadingCep.classList.add('d-none');
                });
        });
    }

    // =====================================================================
    // LÓGICA DO TOASTR PARA MENSAGENS DE SESSÃO DO LARAVEL
    // =====================================================================
    const body = document.body;
    const sessionError = body.dataset.sessionError;
    const validationErrors = body.dataset.errors;

    if (sessionError) {
        toastr.warning(sessionError);
    }
    if (validationErrors) {
        JSON.parse(validationErrors).forEach(error => toastr.error(error));
    }


    // =====================================================================
    // LÓGICA DO SWEETALERT2 PARA CONFIRMAR EXCLUSÃO
    // =====================================================================
    // Adicione a classe 'form-delete' aos seus formulários de exclusão no Blade
    const deleteForms = document.querySelectorAll('.form-delete');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Esta ação não pode ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

