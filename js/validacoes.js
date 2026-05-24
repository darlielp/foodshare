
document.addEventListener('DOMContentLoaded', function() {
    
    // =========== NOME E EMPRESA ==========
    // seleciona todos os campos de input com name="nome" ou name="organizacao"
    const camposTexto = document.querySelectorAll('input[name="nome"], input[name="organizacao"]');
    
    // para cada campo encontrado, adiciona um evento de digitação
    camposTexto.forEach(input => {
        input.addEventListener('input', (e) => {
            // permite apenas letras (com acentos), espaços.
            e.target.value = e.target.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");
        });
    });

    // ========== TELEFONE ==========
    const inputTel = document.querySelector('input[name="telefone"]'); // busca o campo telefone
    
    if (inputTel) { 
        inputTel.addEventListener('input', (e) => {
            // remove tudo que nao for numero
            let v = e.target.value.replace(/\D/g, "");
            
            // limite de 11 digitos
            if (v.length > 11) v = v.slice(0, 11);
            
            if (v.length > 0) {
                if (v.length <= 2) {
                    // ddd
                    v = `(${v}`;
                } else if (v.length <= 7) {
                    // ddd completo e primeiros digitos
                    v = `(${v.slice(0, 2)}) ${v.slice(2)}`;
                } else if (v.length <= 10) {
                    // telefone de 10 digitos
                    v = `(${v.slice(0, 2)}) ${v.slice(2, 6)}-${v.slice(6)}`;
                } else {
                    // telefone de 11 digitos
                    v = `(${v.slice(0, 2)}) ${v.slice(2, 7)}-${v.slice(7, 11)}`;
                }
            }
            // atualiza o campo com o valor formatado
            e.target.value = v;
        });
    }

    // ========== EMAIL ==========
    const campoEmail = document.getElementById('email');         // busca o campo pelo ID
    const spanErro = document.getElementById('error-email');    // busca o span de mensagem de erro

    if (campoEmail) { // so executa se o campo existir
        campoEmail.addEventListener('blur', function() { // evento blur para validar quando o usuario sair do campo
            // regex para validar formato: usuario@dominio.extensao
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (this.value !== "" && !emailRegex.test(this.value)) {
                // se o email for invalido
                if (spanErro) {
                    spanErro.textContent = "Por favor, insira um e-mail válido."; // mensagem de erro
                    spanErro.classList.add('show-error');   // adiciona classe CSS para exibir
                    spanErro.style.display = "block";       // torna visivel
                }
            } else {
                // se o email for valido (ou vazio)
                if (spanErro) {
                    spanErro.classList.remove('show-error'); // remove classe de erro
                    spanErro.textContent = "";               // limpa a mensagem
                    spanErro.style.display = "none";         // esconde o span
                }
            }
        });
    }

    // ========== CPF/CNPJ ==========
    const campoDocumento = document.querySelector('input[name="documento"]'); 
    const documentoReal = document.getElementById('documento_real');        
    const spanErroDoc = document.getElementById('error-documento');          // span para mensagem de erro

    if (campoDocumento) {
        campoDocumento.addEventListener('blur', function() {
            // formata como CPF ou CNPJ)
            mascaraDocumento(this);

            // pega apenas os numeros 
            const valorLimpo = this.value.replace(/\D/g, "");
            
            // salva os numeros puros
            if (documentoReal) {
                documentoReal.value = valorLimpo;
            }

            // validação basica de tamanho 
            if (valorLimpo.length > 0 && valorLimpo.length !== 11 && valorLimpo.length !== 14) {
                // se o tamanho não for 11 nem 14, exibe erro
                if (spanErroDoc) {
                    spanErroDoc.textContent = "Documento incompleto";
                    spanErroDoc.classList.add('show-error');
                    spanErroDoc.style.display = "block";
                }
            } else {
                // se o tamanho estiver correto, esconde o erro
                if (spanErroDoc) {
                    spanErroDoc.classList.remove('show-error');
                    spanErroDoc.style.display = "none";
                }
            }
        });
    }

});

// ========== CPF/CNPJ ==========
function mascaraDocumento(input) {
    // remove tudo que não for numero
    let valor = input.value.replace(/\D/g, "");
    
    // limita a no maximo 14 caracteres
    if (valor.length > 14) valor = valor.slice(0, 14);
    
    // aplica a mascara conforme o tamanho
    if (valor.length <= 11) {
        // FORMATO CPF 
        if (valor.length > 3) valor = valor.replace(/(\d{3})(\d)/, "$1.$2");      
        if (valor.length > 6) valor = valor.replace(/(\d{3})(\d)/, "$1.$2");      
        if (valor.length > 9) valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); 
    } else {
        // FORMATO CNPJ 
        valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");           
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3"); 
        valor = valor.replace(/\.(\d{3})(\d)/, ".$1/$2");          
        valor = valor.replace(/(\d{4})(\d)/, "$1-$2");             
    }
    
    // atualiza o campo com o valor formatado
    input.value = valor;
}

// ========== FUNÇÃO PARA TRATAR DOCUMENTO ==========
function tratarDocumento(input) {
    // aplica a mascara visual (formata como CPF ou CNPJ)
    mascaraDocumento(input);
    
    // remove a formatação e pega apenas os numeros
    const valorLimpo = input.value.replace(/\D/g, "");
    
    // encontra o campo hidden
    const documentoReal = document.getElementById('documento_real');
    
    // salva apenas os numeros no campo hidden
    if (documentoReal) documentoReal.value = valorLimpo;
    
    // valida o tamanho e exibe erro se necessário
    const spanErro = document.getElementById('error-documento');
    if (valorLimpo.length > 0 && valorLimpo.length !== 11 && valorLimpo.length !== 14) {
        // Documento incompleto ou tamanho inválido
        if (spanErro) {
            spanErro.textContent = "Documento incompleto";
            spanErro.style.display = "block";
        }
    } else {
        // documento valido (ou ainda não digitado)
        if (spanErro) spanErro.style.display = "none";
    }
}

// ========== FUNÇÃO PARA MOSTRAR/ESCONDER SENHA ==========
function toggleSenha() {
    // procura por qualquer campo de senha na página
    const inputSenha = document.getElementById("senha") || document.getElementById("senhaCadastro");
    
    // procura o icone que esta dentro do mesmo input-group do campo de senha
    let icone = null;
    if (inputSenha) {
        const inputGroup = inputSenha.closest('.input-group');
        if (inputGroup) {
            icone = inputGroup.querySelector('.toggle-password i');
        }
    }
    
    if (!icone) {
        icone = document.getElementById("iconeSenha");
    }
    
    if (inputSenha && icone) {
        if (inputSenha.type === "password") {
            inputSenha.type = "text";
            icone.classList.remove("fa-eye");
            icone.classList.add("fa-eye-slash");
        } else {
            inputSenha.type = "password";
            icone.classList.remove("fa-eye-slash");
            icone.classList.add("fa-eye");
        }
    }
}