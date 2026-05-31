function abrirModalEdicao(botao) {
    const modal = document.getElementById("modalEdit");
    modal.style.display = "flex";

    document.getElementById("edit-id").value = botao.dataset.id;
    document.getElementById("edit-titulo").value = botao.dataset.titulo;
    document.getElementById("edit-descricao").value = botao.dataset.descricao;
    document.getElementById("edit-peso").value = botao.dataset.peso;
    document.getElementById("edit-validade").value = formatarData(botao.dataset.validade);
}

function fecharModal() {
    document.getElementById("modalEdit").style.display = "none";
}

function formatarData(data) {
    if (!data) return '';
    const partes = data.split('/');
    if (partes.length !== 3) return data;
    return `${partes[2]}-${partes[1]}-${partes[0]}`;
}

document.querySelectorAll(".btn-edit").forEach(function(botao) {
    if (botao.disabled) return;
    botao.addEventListener("click", function() {
        abrirModalEdicao(botao);
    });
});