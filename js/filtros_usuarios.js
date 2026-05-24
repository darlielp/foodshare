const buscaInput = document.getElementById("buscaUsuarios");
const funcaoSelect = document.getElementById("filtroFuncao");
const linhasUsuarios = document.querySelectorAll(".linha-usuario");
const contadorTotal = document.getElementById("total-usuarios");

// =========================
// FILTRAR LINHAS DA TABELA
// =========================
function filtrarUsuarios() {
        const busca = buscaInput.value.toLowerCase().trim();
        const funcao = funcaoSelect.value;
        let usuariosVisiveis = 0;
        
        // elementos capturados para controlo de exibição
        const tabela = document.getElementById("tabela-usuarios-lista");
        const divAviso = document.getElementById("aviso-sem-resultados");

        linhasUsuarios.forEach(linha => {
            const nome = linha.dataset.nome || "";
            const email = linha.dataset.email || "";
            const cardFuncao = linha.dataset.funcao || "";

            const matchBusca = !busca || nome.includes(busca) || email.includes(busca);
            const matchFuncao = !funcao || cardFuncao === funcao;

            if (matchBusca && matchFuncao) {
                linha.style.display = ""; // exibe a linha
                usuariosVisiveis++;
            } else {
                linha.style.display = "none"; // oculta a linha
            }
        });

        // CONTROLAR EXIBIÇÃO DA TABELA INTEIRA VS AVISO
        if (usuariosVisiveis === 0) {
            if (tabela) tabela.style.display = "none";      
            if (divAviso) divAviso.style.display = "block"; 
        } else {
            if (tabela) tabela.style.display = "table";    
            if (divAviso) divAviso.style.display = "none";  
        }

        // atualiza o contador de usuarios ativos
        if (contadorTotal) {
            contadorTotal.textContent = usuariosVisiveis;
        }

        atualizarURL();
    }

// =========================
// ATUALIZA URL
// =========================
function atualizarURL() {
    const params = new URLSearchParams();

    if (buscaInput.value) {
        params.set("busca", buscaInput.value);
    }

    if (funcaoSelect.value) {
        params.set("funcao", funcaoSelect.value);
    }

    const novaURL = window.location.pathname + "?" + params.toString();
    window.history.replaceState({}, "", novaURL);
}

// =========================
// CARREGA FILTROS DA URL
// =========================
function carregarFiltrosDaURL() {
    const params = new URLSearchParams(window.location.search);

    if (params.get("busca")) {
        buscaInput.value = params.get("busca");
    }

    if (params.get("funcao")) {
        funcaoSelect.value = params.get("funcao");
    }

    filtrarUsuarios();
}

// =========================
// EVENTOS
// =========================
buscaInput.addEventListener("input", filtrarUsuarios);
funcaoSelect.addEventListener("change", filtrarUsuarios);

// =========================
// INIT
// =========================
carregarFiltrosDaURL();