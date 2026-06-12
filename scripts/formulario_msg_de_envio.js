const params = new URLSearchParams(window.location.search);
if (params.get('sucesso') === '1') {
    const secao = document.querySelector('.contato');

    secao.innerHTML = `
        <div style="text-align:center; padding: 40px 20px;">
            <div style="font-size: 3rem; margin-bottom: 16px;">✅</div>
            <h2 style="margin-bottom: 12px; color: #2d6a4f;">Mensagem enviada!</h2>
            <p style="color: #555; margin-bottom: 32px; max-width: 400px; margin-inline: auto;">
                Recebemos sua mensagem e entraremos em contato em breve.<br>
                Obrigado por falar conosco!
            </p>
            <a href="contato.php" style="
                display: inline-block;
                background: #c0392b;
                color: #fff;
                text-decoration: none;
                padding: 12px 28px;
                border-radius: 8px;
                font-weight: 600;
                font-size: 1rem;
                transition: background 0.2s;
            " onmouseover="this.style.background='#a93226'"
               onmouseout="this.style.background='#c0392b'">
                ← Voltar ao Contato
            </a>
        </div>
    `;

    secao.scrollIntoView({ behavior: 'smooth' });
}
