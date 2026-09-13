document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const formulario = document.getElementById("sala-formulario");
    const conteudo = document.getElementById("sala-conteudo");
    const salaMenu = document.querySelector(".sala-menu");
    const salaOverlay = document.querySelector(".sala-overlay");
    const menuToggle = document.querySelector(".sala-menu-toggle");
    if (!menuItems.length || !formulario || !conteudo) {
        return;
    }

    const fecharMenuMobile = function () {
        if (salaMenu) {
            salaMenu.classList.remove("is-open");
        }

        if (menuToggle) {
            menuToggle.classList.remove("is-active");
            menuToggle.setAttribute("aria-expanded", "false");
        }

        if (salaOverlay) {
            salaOverlay.classList.remove("is-visible");
        }

        document.body.classList.remove("sala-menu-open");
    };

    const abrirMenuMobile = function () {
        if (salaMenu) {
            salaMenu.classList.add("is-open");
        }

        if (menuToggle) {
            menuToggle.classList.add("is-active");
            menuToggle.setAttribute("aria-expanded", "true");
        }

        if (salaOverlay) {
            salaOverlay.classList.add("is-visible");
        }

        document.body.classList.add("sala-menu-open");
    };

    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            const aberto = salaMenu && salaMenu.classList.contains("is-open");
            if (aberto) {
                fecharMenuMobile();
            } else {
                abrirMenuMobile();
            }
        });
    }

    if (salaOverlay) {
        salaOverlay.addEventListener("click", fecharMenuMobile);
    }

    const renderTemplate = function (templateId, container) {
        const template = document.getElementById(templateId);
        if (!template || !container) {
            return;
        }

        container.innerHTML = "";
        container.appendChild(template.content.cloneNode(true));
    };

    const marcarMenuAtivo = function (view) {
        menuItems.forEach(function (btn) {
            btn.classList.toggle("active", btn.dataset.view === view);
        });
    };

    const carregarTela = function (view) {
        renderTemplate("template-" + view, formulario);
        marcarMenuAtivo(view);

        if (view === "cursos") {
            setTimeout(function () {
                registrarFiltrosCursos();
                aplicarFiltroCursos();
            }, 0);
        }

        if (view === "conteudo") {
            setTimeout(function () {
                registrarToggleModulos();
            }, 0);
        }
    };

    menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
            carregarTela(item.dataset.view);

            if (window.innerWidth <= 1024) {
                fecharMenuMobile();
            }
        });
    });

    const userDropdown = document.querySelector(".user-dropdown");
    const userDropdownButton = document.querySelector(".user-dropdown-button");

    if (userDropdown && userDropdownButton) {
        userDropdownButton.addEventListener("click", function (event) {
            event.stopPropagation();
            userDropdown.classList.toggle("open");
        });

        document.addEventListener("click", function (event) {
            if (!userDropdown.contains(event.target)) {
                userDropdown.classList.remove("open");
            }
        });
    }

    function registrarToggleModulos() {
        document.querySelectorAll(".modulo-toggle").forEach(function (toggleButton) {
            toggleButton.onclick = function () {
                const card = toggleButton.closest(".modulo-card");
                const body = card ? card.querySelector(".modulo-body") : null;

                if (!card || !body) {
                    return;
                }

                const isExpanded = toggleButton.getAttribute("aria-expanded") === "true";
                const nextExpanded = !isExpanded;

                toggleButton.setAttribute("aria-expanded", String(nextExpanded));
                card.classList.toggle("is-collapsed", !nextExpanded);
                body.style.display = nextExpanded ? "block" : "none";
                body.hidden = !nextExpanded;
            };
        });
    }

    registrarToggleModulos();

    let cursoFiltroAtual = "todos";

    function aplicarFiltroCursos() {
        const cursoSearchInput = document.querySelector(".curso-search-input");
        const cursoFilterButtons = document.querySelectorAll(".curso-filtro-btn");
        const cursoCards = document.querySelectorAll(".curso-card");
        const cursoEmptyState = document.querySelector(".curso-sem-resultados");
        const cursoList = document.querySelector(".cursos-lista");
        const valorBusca = (cursoSearchInput ? cursoSearchInput.value : "").trim().toLowerCase();
        let cardsVisiveis = 0;

        cursoCards.forEach(function (card) {
            const nomeCurso = (card.dataset.nome || "").toLowerCase();
            const nivelCurso = (card.dataset.nivel || "").toLowerCase();
            const atendeTexto = !valorBusca || nomeCurso.includes(valorBusca);
            const atendeFiltro = cursoFiltroAtual === "todos" || nivelCurso === cursoFiltroAtual;
            const deveMostrar = atendeTexto && atendeFiltro;

            card.style.display = deveMostrar ? "flex" : "none";
            if (deveMostrar) {
                cardsVisiveis++;
            }
        });

        if (cursoEmptyState) {
            cursoEmptyState.hidden = cardsVisiveis !== 0;
        }

        if (cursoList) {
            cursoList.style.display = cardsVisiveis === 0 ? "none" : "flex";
        }

        cursoFilterButtons.forEach(function (button) {
            button.classList.toggle("active", (button.dataset.filtro || "todos") === cursoFiltroAtual);
        });
    }

    function registrarFiltrosCursos() {
        const cursoSearchInput = document.querySelector(".curso-search-input");
        const cursoFilterButtons = document.querySelectorAll(".curso-filtro-btn");

        if (cursoSearchInput) {
            cursoSearchInput.addEventListener("input", aplicarFiltroCursos);
        }

        cursoFilterButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                cursoFiltroAtual = button.dataset.filtro || "todos";
                aplicarFiltroCursos();
            });
        });
    }

    registrarFiltrosCursos();
    aplicarFiltroCursos();

    document.addEventListener("click", function (event) {
        const disabledButton = event.target.closest(".aula-revisar-btn.disabled");
        if (disabledButton) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });

    carregarTela(conteudo.dataset.viewInicial || "conteudo");
});
