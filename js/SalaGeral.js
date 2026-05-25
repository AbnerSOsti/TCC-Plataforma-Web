document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const titulo = document.getElementById("sala-titulo");
    const formulario = document.getElementById("sala-formulario");
    const conteudo = document.getElementById("sala-conteudo");
    const dropdownBtn = document.querySelector(".dropdown-btn");
    const dropdownContent = document.querySelector(".dropdown-content");

    if (!menuItems.length || !titulo || !formulario || !conteudo) {
        return;
    }

    // const titulos = {
    //     conteudo: "Conteúdo",
    //     perfil: "Perfil",
    //     config: "Configurações",
    //     editar: "Editar Perfil"
    // };

    const renderTemplate = function (templateId, container) {
        const template = document.getElementById(templateId);
        if (!template || !container) {
            return;
        }

        container.innerHTML = "";
        container.appendChild(template.content.cloneNode(true));
        
        // Adicionar event listener para botão de ranking após renderizar
        adicionarEventListenerRanking();
    };

    const marcarMenuAtivo = function (view) {
        menuItems.forEach(function (btn) {
            btn.classList.toggle("active", btn.dataset.view === view);
        });
    };

    const carregarTela = function (view) {
        renderTemplate("template-" + view, formulario);
        // titulo.textContent = titulos[view] || "Sala Geral";
        marcarMenuAtivo(view);

        // Fechar dropdown se estiver aberto
        if (dropdownContent) {
            dropdownContent.style.display = "none";
        }
    };

    const adicionarEventListenerRanking = function() {
        const btnRankingMobile = document.querySelector(".btn-ranking-mobile");
        const rankingContainer = document.getElementById("ranking-container");
        
        if (btnRankingMobile && rankingContainer) {
            btnRankingMobile.addEventListener("click", function() {
                rankingContainer.classList.toggle("visible");
                btnRankingMobile.textContent = rankingContainer.classList.contains("visible") ? "Esconder Ranking" : "Ranking";
            });
        }
    };

    menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
            carregarTela(item.dataset.view);
        });
    });

    // Lidar com o dropdown do botão "Mais"
    if (dropdownBtn && dropdownContent) {
        dropdownBtn.addEventListener("click", function (event) {
            event.preventDefault();
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        });

        // Fechar dropdown ao clicar fora
        document.addEventListener("click", function (event) {
            if (!dropdownBtn.contains(event.target) && !dropdownContent.contains(event.target)) {
                dropdownContent.style.display = "none";
            }
        });
    }

    carregarTela(conteudo.dataset.viewInicial || "conteudo");
});
