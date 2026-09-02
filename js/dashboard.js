document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".dashboard-nav .menu-item");
    const container = document.getElementById("dashboard-container-conteudo");
    const dashboardConteudo = document.getElementById("dashboard-conteudo");
    const mensagemContainer = document.getElementById("dashboard-mensagem");
    const dashboardMenu = document.querySelector(".dashboard-menu");
    const dashboardOverlay = document.querySelector(".dashboard-overlay");
    const menuToggle = document.querySelector(".dashboard-menu-toggle");
    

    const fecharMenuMobile = function () {
        if (dashboardMenu) {
            dashboardMenu.classList.remove("is-open");
        }

        if (menuToggle) {
            menuToggle.classList.remove("is-active");
            menuToggle.setAttribute("aria-expanded", "false");
        }

        if (dashboardOverlay) {
            dashboardOverlay.classList.remove("is-visible");
        }

        document.body.classList.remove("dashboard-menu-open");
    };

    const abrirMenuMobile = function () {
        if (dashboardMenu) {
            dashboardMenu.classList.add("is-open");
        }

        if (menuToggle) {
            menuToggle.classList.add("is-active");
            menuToggle.setAttribute("aria-expanded", "true");
        }

        if (dashboardOverlay) {
            dashboardOverlay.classList.add("is-visible");
        }

        document.body.classList.add("dashboard-menu-open");
    };

    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            const aberto = dashboardMenu && dashboardMenu.classList.contains("is-open");
            if (aberto) {
                fecharMenuMobile();
            } else {
                abrirMenuMobile();
            }
        });
    }

    if (dashboardOverlay) {
        dashboardOverlay.addEventListener("click", fecharMenuMobile);
    }

    menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
            if (window.innerWidth <= 900) {
                fecharMenuMobile();
            }
        });
    });

    if (!menuItems.length || !container || !dashboardConteudo) {
        return;
    }

    // Toast functionality
    if (mensagemContainer) {
        const toasts = mensagemContainer.querySelectorAll(".dashboard-toast");
        toasts.forEach(function (toast) {
            const fechar = toast.querySelector(".toast-close");
            const esconderToast = function () {
                toast.classList.add("is-hidden");
                window.setTimeout(function () {
                    toast.remove();
                }, 220);
            };
            if (fechar) {
                fechar.addEventListener("click", esconderToast);
            }
            window.setTimeout(esconderToast, 4000);
        });
    }

    // Renderizar tipo de exercício
    const renderTipoExercicio = function (tipo) {
        const areaTipos = document.getElementById("tipos-exercicio-conteudo");
        if (!areaTipos) return;
        
        areaTipos.innerHTML = "";

        if (tipo === "multipla_escolha") {
            areaTipos.innerHTML = `
                <div class="card-tipo">
                    <h3>Opções da Multipla Escolha</h3>
                    <div class="campo-formulario">
                        <label for="opcao_1">Opção 1</label>
                        <input type="text" id="opcao_1" name="opcao_1" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_2">Opção 2</label>
                        <input type="text" id="opcao_2" name="opcao_2" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_3">Opção 3</label>
                        <input type="text" id="opcao_3" name="opcao_3">
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_4">Opção 4</label>
                        <input type="text" id="opcao_4" name="opcao_4">
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_correta">Opção correta</label>
                        <select id="opcao_correta" name="opcao_correta" required>
                            <option value="">Selecione</option>
                            <option value="1">Opção 1</option>
                            <option value="2">Opção 2</option>
                            <option value="3">Opção 3</option>
                            <option value="4">Opção 4</option>
                        </select>
                    </div>
                </div>
            `;
        } else if (tipo === "completar_lacunas") {
            areaTipos.innerHTML = `
                <div class="card-tipo">
                    <h3>Texto com Lacunas</h3>
                    <div class="campo-formulario">
                        <label for="texto_lacunas">Texto base</label>
                        <textarea id="texto_lacunas" name="texto_lacunas" rows="5" placeholder="Use ___ para marcar lacunas"></textarea>
                    </div>
                    <div class="campo-formulario">
                        <label for="respostas_lacunas">Respostas corretas</label>
                        <input type="text" id="respostas_lacunas" name="respostas_lacunas" placeholder="Ex: variavel, constante, funcao">
                    </div>
                </div>
            `;
        } else if (tipo === "ordenar_blocos") {
            areaTipos.innerHTML = `
                <div class="card-tipo">
                    <h3>Ordenação de Blocos</h3>
                    <div class="campo-formulario">
                        <label for="bloco_1">Bloco 1</label>
                        <input type="text" id="bloco_1" name="bloco_1" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="bloco_2">Bloco 2</label>
                        <input type="text" id="bloco_2" name="bloco_2" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="bloco_3">Bloco 3</label>
                        <input type="text" id="bloco_3" name="bloco_3">
                    </div>
                    <div class="campo-formulario">
                        <label for="bloco_4">Bloco 4</label>
                        <input type="text" id="bloco_4" name="bloco_4">
                    </div>
                    <div class="campo-formulario">
                        <label for="ordem_correta">Ordem correta</label>
                        <input type="text" id="ordem_correta" name="ordem_correta" placeholder="Ex: 1,2,3,4" required>
                    </div>
                </div>
            `;
        }
    };

    // Template rendering
    const renderTemplate = function (templateId) {
        const template = document.getElementById("template-" + templateId);
        if (!template || !container) {
            return;
        }

        container.innerHTML = "";
        container.appendChild(template.content.cloneNode(true));
        
        // Reinicializar o seletor de tipo se existir
        const novoSeletor = container.querySelector("#tipo_exercicio");
        if (novoSeletor) {
            novoSeletor.addEventListener("change", function (event) {
                renderTipoExercicio(event.target.value);
            });
            renderTipoExercicio(novoSeletor.value);
        }

        const botoesMenuModulo = container.querySelectorAll('[data-action="toggle-menu-modulo"]');
        botoesMenuModulo.forEach(function (botaoMenu) {
            botaoMenu.addEventListener("click", function (event) {
                event.preventDefault();

                const dropdownAtual = botaoMenu.closest(".dropdown-acoes-modulo");
                const estavaAberto = dropdownAtual.classList.contains("is-aberto");

                container.querySelectorAll(".dropdown-acoes-modulo.is-aberto").forEach(function (dropdown) {
                    dropdown.classList.remove("is-aberto");
                    const menu = dropdown.querySelector(".menu-acoes-modulo");
                    const botao = dropdown.querySelector('[data-action="toggle-menu-modulo"]');

                    if (menu) {
                        menu.style.display = "none";
                    }

                    if (botao) {
                        botao.setAttribute("aria-expanded", "false");
                    }
                });

                if (!estavaAberto) {
                    dropdownAtual.classList.add("is-aberto");
                    const menuAtual = dropdownAtual.querySelector(".menu-acoes-modulo");

                    if (menuAtual) {
                        menuAtual.style.display = "flex";
                    }

                    botaoMenu.setAttribute("aria-expanded", "true");
                }
            });
        });
    };

    const marcarMenuAtivo = function (view) {
        menuItems.forEach(function (btn) {
            btn.classList.toggle("active", btn.dataset.view === view);
        });
    };

    const carregarTela = function (view) {
        renderTemplate(view);
        marcarMenuAtivo(view);
    };

    menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
            carregarTela(item.dataset.view);
        });
    });

    carregarTela(dashboardConteudo.dataset.viewInicial || "gerenciar");
});


