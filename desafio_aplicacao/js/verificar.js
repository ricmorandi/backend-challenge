function permiteApenasNumeros(tel){
    const texto = tel.value;

    texto_formatado = "+" + texto.replace(/[^\d]+/g,'');

    tel.value = texto_formatado;
}