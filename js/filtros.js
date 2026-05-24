const buscaInput = document.getElementById("busca");
const statusSelect = document.getElementById("filtroStatus");
const categoriaSelect = document.getElementById("filtroCategoria");

const cards = document.querySelectorAll(".card-doacao");

// =========================
// FILTRAR CARDS
// =========================
function filtrar() {

    const busca = buscaInput.value.toLowerCase();

    const status = statusSelect.value;

    const categoria = categoriaSelect.value;

    cards.forEach(card => {

        const titulo = card.dataset.titulo.toLowerCase();

        const origem = card.dataset.origem.toLowerCase();

        const cardStatus = card.dataset.status;

        const cardCategoria = card.dataset.categoria;

        const matchBusca =
            titulo.includes(busca) ||
            origem.includes(busca);

        const matchStatus =
            !status ||
            cardStatus === status;

        const matchCategoria =
            !categoria ||
            cardCategoria === categoria;

        if (matchBusca && matchStatus && matchCategoria) {

            card.style.display = "flex";

        } else {

            card.style.display = "none";
        }

    });

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

    if (statusSelect.value) {
        params.set("status", statusSelect.value);
    }

    if (categoriaSelect.value) {
        params.set("categoria", categoriaSelect.value);
    }

    const novaURL =
        window.location.pathname +
        "?" +
        params.toString();

    window.history.replaceState({}, "", novaURL);
}

// =========================
// CARREGA FILTROS DA URL
// =========================
function carregarFiltrosDaURL() {

    const params =
        new URLSearchParams(window.location.search);

    if (params.get("busca")) {
        buscaInput.value = params.get("busca");
    }

    if (params.get("status")) {
        statusSelect.value = params.get("status");
    }

    if (params.get("categoria")) {
        categoriaSelect.value = params.get("categoria");
    }

    filtrar();
}

// =========================
// EVENTOS
// =========================
buscaInput.addEventListener("input", filtrar);

statusSelect.addEventListener("change", filtrar);

categoriaSelect.addEventListener("change", filtrar);

// =========================
// INIT
// =========================
carregarFiltrosDaURL();