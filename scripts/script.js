const cards = document.querySelectorAll('.vendidos__produtos__card');

cards.forEach(card => {
    const diminuir = card.querySelectorAll('button')[0];
    const aumentar = card.querySelectorAll('button')[1];
    const quantidade = card.querySelector('.vendidos__produtos__card__quantidade p');

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
});