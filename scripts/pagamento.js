var carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
var total = 0;
for (var i = 0; i < carrinho.length; i++) {
    total += carrinho[i].preco * carrinho[i].quantidade;
}
document.getElementById('total-pedido').textContent = total.toFixed(2).replace('.', ',');

function atualizarContadorCarrinho() {
    var c = JSON.parse(localStorage.getItem('carrinho')) || [];
    var totalItens = 0;
    for (var i = 0; i < c.length; i++) {
        totalItens += c[i].quantidade;
    }
    var el = document.getElementById('carrinho-contador');
    if (el) {
        if (totalItens > 0) {
            el.textContent = totalItens;
            el.style.display = 'flex';
        } else {
            el.style.display = 'none';
        }
    }
}
atualizarContadorCarrinho();

function mostrarOpcao(id, botao) {
    var secoes = document.querySelectorAll('.pagamento__secao');
    for (var i = 0; i < secoes.length; i++) {
        secoes[i].style.display = 'none';
    }
    document.getElementById(id).style.display = 'block';

    var botoes = document.querySelectorAll('.pagamento__btn');
    for (var i = 0; i < botoes.length; i++) {
        botoes[i].classList.remove('ativo');
    }
    botao.classList.add('ativo');
}

function buscarCEP() {
    var cep = document.getElementById('cep').value.replace(/\D/g, '');
    var erroEl = document.getElementById('cep-erro');
    erroEl.textContent = '';

    if (cep.length !== 8) {
        erroEl.textContent = 'CEP inválido. Digite os 8 dígitos.';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/');
    xhr.onload = function () {
        if (xhr.status === 200) {
            var dados = JSON.parse(xhr.responseText);
            if (dados.erro) {
                erroEl.textContent = 'CEP não encontrado.';
                document.getElementById('endereco-resultado').style.display = 'none';
                return;
            }
            document.getElementById('endereco-logradouro').textContent = dados.logradouro + ' — ' + dados.bairro;
            document.getElementById('endereco-cidade').textContent = dados.localidade + ' / ' + dados.uf;
            document.getElementById('endereco-resultado').style.display = 'flex';
        }
    };
    xhr.onerror = function () {
        erroEl.textContent = 'Erro ao buscar o CEP. Tente novamente.';
    };
    xhr.send();
}

function confirmarPagamento() {
    var enderecoResultado = document.getElementById('endereco-resultado');
    if (enderecoResultado.style.display === 'none' || enderecoResultado.style.display === '') {
        alert('Preencha o endereço de entrega antes de continuar.');
        return;
    }
    if (!document.getElementById('endereco-numero').value.trim()) {
        alert('Informe o número do endereço.');
        return;
    }

    var secaoAtiva = null;
    var secoes = document.querySelectorAll('.pagamento__secao');
    for (var i = 0; i < secoes.length; i++) {
        if (secoes[i].style.display !== 'none' && secoes[i].style.display !== '') {
            secaoAtiva = secoes[i];
            break;
        }
    }

    if (secaoAtiva && secaoAtiva.id !== 'pix') {
        var prefixo = secaoAtiva.id;
        var numero = document.getElementById(prefixo + '-numero').value.trim();
        var validade = document.getElementById(prefixo + '-validade').value.trim();
        var cvv = document.getElementById(prefixo + '-cvv').value.trim();
        var cpf = document.getElementById(prefixo + '-cpf').value.trim();
        var nome = document.getElementById(prefixo + '-nome').value.trim();

        if (!numero || !validade || !cvv || !cpf || !nome) {
            alert('Preencha todos os dados do cartão antes de continuar.');
            return;
        }
    }

    var logradouro = document.getElementById('endereco-logradouro').textContent;
    var cidade = document.getElementById('endereco-cidade').textContent;
    var numero = document.getElementById('endereco-numero').value.trim();
    var complemento = document.getElementById('endereco-complemento').value.trim();

    var pedido = {
        itens: carrinho,
        endereco: {
            logradouro: logradouro,
            numero: numero,
            complemento: complemento,
            cidade: cidade
        },
        total: total
    };

    localStorage.setItem('pedido_confirmado', JSON.stringify(pedido));
    localStorage.removeItem('carrinho');
    window.location.href = 'confirmacao_pedido.html';
}
