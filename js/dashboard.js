document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const titulo = document.getElementById("dashboard-titulo");
    const formulario = document.getElementById("dashboard-formulario");
    const conteudo = document.getElementById("dashboard-conteudo");

    if (!menuItems.length || !titulo || !formulario || !conteudo) {
        return;
    }

    const titulos = {
        modulo: "Cadastrar Modulo",
        linguagem: "Cadastrar Linguagem",
        aula: "Cadastrar Aula",
        exercicio: "Cadastrar Exercicio"
    };

    const renderTemplate = function (templateId, container) {
        const template = document.getElementById(templateId);
        if (!template || !container) {
            return;
        }

        container.innerHTML = "";
        container.appendChild(template.content.cloneNode(true));
    };

    const renderTipoExercicio = function (tipo) {
        const areaTipos = document.getElementById("tipos-exercicio-conteudo");
        if (!areaTipos) {
            return;
        }

        areaTipos.innerHTML = "";

        const mapTipos = {
            alternativa: "template-tipo-alternativa",
            completar: "template-tipo-completar",
            ordenar: "template-tipo-ordenar"
        };

        const templateId = mapTipos[tipo];
        if (templateId) {
            renderTemplate(templateId, areaTipos);
        }
    };

    const bindTipoExercicio = function () {
        const seletorTipo = document.getElementById("tipo_exercicio");
        if (!seletorTipo) {
            return;
        }

        if (seletorTipo.value) {
            renderTipoExercicio(seletorTipo.value);
        }

        seletorTipo.addEventListener("change", function (event) {
            renderTipoExercicio(event.target.value);
        });
    };

    const marcarMenuAtivo = function (view) {
        menuItems.forEach(function (btn) {
            btn.classList.toggle("active", btn.dataset.view === view);
        });
    };

    const carregarTela = function (view) {
        renderTemplate("template-" + view, formulario);
        titulo.textContent = titulos[view] || "Dashboard";
        marcarMenuAtivo(view);

        if (view === "exercicio") {
            bindTipoExercicio();
        }
    };

    menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
            carregarTela(item.dataset.view);
        });
    });

    carregarTela(conteudo.dataset.viewInicial || "modulo");
});