function trocarAba(aba) {
    document.getElementById('form-entrar').style.display = aba === 'entrar' ? 'flex' : 'none';
    document.getElementById('form-cadastro').style.display = aba === 'cadastro' ? 'flex' : 'none';

    document.getElementById('btn-entrar').classList.remove('ativa');
    document.getElementById('btn-cadastro').classList.remove('ativa');

    if (aba === 'entrar') {
        document.getElementById('btn-entrar').classList.add('ativa');
    } else {
        document.getElementById('btn-cadastro').classList.add('ativa');
    }
}