var dados = JSON.parse(localStorage.getItem('pedido_confirmado'));

if (!dados) {
    window.location.href = 'index.php';
}

var end = dados.endereco;
var enderecoTexto = end.logradouro + ', ' + end.numero;
if (end.complemento) enderecoTexto += ' — ' + end.complemento;
enderecoTexto += ' | ' + end.cidade;
document.getElementById('conf-endereco').textContent = enderecoTexto;

var lista = document.getElementById('conf-itens');
for (var i = 0; i < dados.itens.length; i++) {
    var item = dados.itens[i];
    var li = document.createElement('li');
    li.textContent = item.quantidade + 'x ' + item.nome + '  —  R$ ' + (item.preco * item.quantidade).toFixed(2).replace('.', ',');
    lista.appendChild(li);
}

document.getElementById('conf-total').textContent = dados.total.toFixed(2).replace('.', ',');

localStorage.removeItem('pedido_confirmado');
