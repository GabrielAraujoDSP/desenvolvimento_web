const listaCarrinho = document.getElementById('lista-carrinho');
const totalCarrinho = document.getElementById('total-carrinho');
const botaoLimpar = document.getElementById('limpar-carrinho');

function mostrarCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

    listaCarrinho.innerHTML = '';

    if (carrinho.length === 0) {
        listaCarrinho.innerHTML = '<p>Seu carrinho esta vazio.</p>';
        totalCarrinho.textContent = '0,00';
        return;
    }

    let total = 0;

    carrinho.forEach(produto => {
        const subtotal = produto.preco * produto.quantidade;
        total += subtotal;

        const item = document.createElement('div');
        item.classList.add('carrinho__item');

        item.innerHTML = `
            <p>${produto.nome}</p>
            <p>Quantidade: ${produto.quantidade}</p>
            <p>R$ ${subtotal.toFixed(2).replace('.', ',')}</p>
        `;

        listaCarrinho.appendChild(item);
    });

    totalCarrinho.textContent = total.toFixed(2).replace('.', ',');
}

botaoLimpar.addEventListener('click', () => {
    localStorage.removeItem('carrinho');
    mostrarCarrinho();
});

mostrarCarrinho();
