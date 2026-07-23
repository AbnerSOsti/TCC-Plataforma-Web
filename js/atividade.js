const containerPergunta = document.getElementById('pergunta-texto');
const containerRespostas = document.getElementById('respostas');
const barraFill = document.getElementById('barra-progresso-fill');
const porcentagem = document.getElementById('porcentagem');
const textoProgresso = document.getElementById('texto-progresso');
const feedback = document.getElementById('feedback');
const btnResponder = document.getElementById('btn-responder');
const btnContinuar = document.getElementById('btn-continuar');
const tempoFinal = document.getElementById('tempo-final');
const totalExerciciosInput = document.getElementById('total_exercicios');
const exerciciosCorretosInput = document.getElementById('exercicios_corretos');
const tempoSegundosInput = document.getElementById('tempo_segundos');

let fila = [...atividadeData];
let totalExercicios = fila.length;
let corretos = 0;
let tempoInicio = Date.now();

function atualizarProgresso() {
    const percent = totalExercicios === 0 ? 0 : Math.round((corretos / totalExercicios) * 100);
    barraFill.style.width = percent + '%';
    porcentagem.textContent = percent + '%';
    textoProgresso.textContent = `${corretos} de ${totalExercicios} corretos`;
    exerciciosCorretosInput.value = corretos;
}

function renderExercicio() {
    feedback.textContent = '';
    feedback.className = 'feedback';

    if (fila.length === 0) {
        finalizarAula();
        return;
    }

    const exercicio = fila[0];
    containerPergunta.textContent = exercicio.pergunta;
    containerRespostas.innerHTML = '';

    if (exercicio.tipo_exercicio === 'alternativa') {
        exercicio.opcoes.forEach((opcao, index) => {
            const label = document.createElement('label');
            label.className = 'opcao-item';
            label.innerHTML = `
                <input type="radio" name="resposta" value="${index}">
                <span>${opcao.texto_opcao}</span>
            `;
            containerRespostas.appendChild(label);
        });
    } else if (exercicio.tipo_exercicio === 'completar') {
        containerRespostas.innerHTML = `
            <input type="text" id="resposta-texto" placeholder="Digite sua resposta">
        `;
    } else if (exercicio.tipo_exercicio === 'ordenar' || exercicio.tipo_exercicio === 'ordenacao') {
        containerRespostas.innerHTML = '';
        containerRespostas.appendChild(document.createTextNode('Use os botões para ordenar os blocos na sequência correta.'));

        if (!exercicio.ordenacaoAtual) {
            exercicio.ordenacaoAtual = embaralharBlocos(exercicio.blocos || []);
        }

        const lista = document.createElement('div');
        lista.className = 'lista-ordenar';

        exercicio.ordenacaoAtual.forEach((bloco, index) => {
            const item = document.createElement('div');
            item.className = 'bloco-ordenar';
            item.dataset.index = String(index);

            const texto = document.createElement('span');
            texto.textContent = bloco.texto_bloco;
            texto.className = 'texto-bloco';

            const botoes = document.createElement('div');
            botoes.className = 'ordem-botoes';
            botoes.innerHTML = `
                <button type="button" class="btn-mover" data-delta="-1">↑</button>
                <button type="button" class="btn-mover" data-delta="1">↓</button>
            `;

            botoes.querySelectorAll('.btn-mover').forEach(btn => {
                btn.addEventListener('click', () => {
                    const delta = Number(btn.dataset.delta);
                    moverBloco(exercicio, index, delta);
                });
            });

            item.appendChild(texto);
            item.appendChild(botoes);
            lista.appendChild(item);
        });

        containerRespostas.appendChild(lista);
    } else {
        containerRespostas.textContent = 'Tipo de exercício não reconhecido.';
    }
}

function embaralharBlocos(blocos) {
    const copia = [...blocos];
    for (let i = copia.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [copia[i], copia[j]] = [copia[j], copia[i]];
    }
    return copia;
}

function moverBloco(exercicio, index, delta) {
    const destino = index + delta;
    if (destino < 0 || destino >= exercicio.ordenacaoAtual.length) {
        return;
    }
    const atual = exercicio.ordenacaoAtual;
    [atual[index], atual[destino]] = [atual[destino], atual[index]];
    renderExercicio();
}

function finalizarAula() {
    const segundos = Math.round((Date.now() - tempoInicio) / 1000);
    tempoSegundosInput.value = segundos;
    tempoFinal.style.display = 'block';
    tempoFinal.textContent = `Tempo total: ${segundos} segundos`;
    btnResponder.style.display = 'none';
    btnContinuar.style.display = 'inline-block';
    containerPergunta.textContent = 'Parabéns! Todos os exercícios foram concluídos corretamente.';
    containerRespostas.innerHTML = '';
}

function marcarRespostaCorreta(correta) {
    const exercicioAtual = fila[0];

    if (correta) {
        corretos += 1;
        fila.shift();
        feedback.textContent = 'Resposta correta!';
        feedback.classList.remove('feedback-erro');
        feedback.classList.add('feedback-sucesso');

        atualizarProgresso();
        if (fila.length === 0) {
            finalizarAula();
        } else {
            setTimeout(renderExercicio, 800);
        }
        return;
    }

    const feedbackErro = exercicioAtual?.feedback_erro?.trim() || 'Resposta incorreta. Tente novamente.';
    feedback.textContent = feedbackErro;
    feedback.classList.remove('feedback-sucesso');
    feedback.classList.add('feedback-erro');
}

btnResponder.addEventListener('click', () => {
    if (fila.length === 0) return;

    const exercicio = fila[0];
    let correta = false;

    if (exercicio.tipo_exercicio === 'alternativa') {
        const escolhido = document.querySelector('input[name="resposta"]:checked');
        if (!escolhido) {
            feedback.textContent = 'Selecione uma opção antes de responder.';
            feedback.classList.add('feedback-erro');
            return;
        }
        const index = parseInt(escolhido.value, 10);
        correta = !!exercicio.opcoes[index]?.correta;
    } else if (exercicio.tipo_exercicio === 'completar') {
        const resposta = document.getElementById('resposta-texto').value.trim().toLowerCase();
        correta = resposta === String(exercicio.resposta_correta).trim().toLowerCase();
    } else if (exercicio.tipo_exercicio === 'ordenar' || exercicio.tipo_exercicio === 'ordenacao') {
        const ordemAtual = exercicio.ordenacaoAtual || [];
        correta = ordemAtual.every((bloco, index) => bloco.ordem_correta === index + 1);
    }

    marcarRespostaCorreta(correta);
});

atualizarProgresso();
renderExercicio();