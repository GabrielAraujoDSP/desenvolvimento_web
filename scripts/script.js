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

const cards = document.querySelectorAll('.vendidos__produtos__card');

cards.forEach(card => {
    const diminuir = card.querySelectorAll('button')[0];
    const aumentar = card.querySelectorAll('button')[1];
    const quantidade = card.querySelector('.vendidos__produtos__card__quantidade p');
    const botaoAdicionar = card.querySelector('.vendidos__produtos__card__link');

    let contador = 0;

    aumentar.addEventListener('click', () => {
        contador++;
        quantidade.textContent = contador;
    });

    diminuir.addEventListener('click', () => {
        if (contador > 0) {
            contador--;
            quantidade.textContent = contador;
        }
    });

    botaoAdicionar.addEventListener('click', (evento) => {
        evento.preventDefault();

        if (contador === 0) {
            alert('Escolha pelo menos 1 item.');
            return;
        }

        const textos = card.querySelectorAll('p');
        const nome = textos[0].textContent;
        const precoTexto = textos[1].textContent.replace('R$ ', '').replace(',', '.');
        const preco = Number(precoTexto);

        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        const produtoExistente = carrinho.find(produto => produto.nome === nome);

        if (produtoExistente) {
            produtoExistente.quantidade += contador;
        } else {
            carrinho.push({
                nome: nome,
                preco: preco,
                quantidade: contador
            });
        }

        localStorage.setItem('carrinho', JSON.stringify(carrinho));

        contador = 0;
        quantidade.textContent = contador;
        atualizarContadorCarrinho();
        alert('Produto adicionado ao carrinho!');
    });
});
