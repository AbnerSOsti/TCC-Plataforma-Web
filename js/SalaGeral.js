document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const titulo = document.getElementById("sala-titulo");
    const Aprender = document.getElementById("sala-aprender");
    const perfil = document.getElementById("sala-perfil");
    const Config = document.getElementById("sala-config");

    if (!menuItems.length || !titulo || !Aprender || !perfil || !Config) {
        return;
    }
    const titulos = {
        aprender: "Listar-Exercicios",
        perfil: "Perfil",
        config: "Configurações"
    };

    const renderTemplate = function (templateId, container) {
        const template = document.getElementById(templateId);
        if (!template || !container) {
            return;
        }
        container.innerHTML = "";
        container.appendChild(template.content.cloneNode(true));
    };
    
   
});
