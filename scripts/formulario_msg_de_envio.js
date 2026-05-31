const params = new URLSearchParams(window.location.search);
if(params.get('sucesso') === '1') {
    const aviso = document.createElement('div');
    aviso.textContent = 'Mensagem enviada com sucesso!';
    aviso.style.cssText = 'background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin:10px 0; text-align:center;';
    document.querySelector('.contato').prepend(aviso);
    aviso.scrollIntoView({behavior: "smooth"});
}