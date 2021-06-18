// function criptografarChaveSimetrica(data) {

//     // vetor de inicialização
//     var iv_random = CryptoJS.enc.Hex.stringify(CryptoJS.lib.WordArray.random(16)).toString();
//     var iv = CryptoJS.enc.Utf8.parse(iv_random);
//     // console.log("vetor de inicialização iv: " + iv);
//     console.log("vetor de inicialização iv_random: " + iv_random);

//     // converte para JSON
//     var valores = JSON.stringify(data);

//     // Converte pra utf8 e após, para base64
//     valores = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(valores)).toString();
//     // console.log("valores base64: " + valores);

//     //funcao para gerar hex aleatorio
//     const genRanHex = size => [...Array(size)].map(() => Math.floor(Math.random() * 16).toString(16)).join('');

//     //limpa o storage
//     window.localStorage.clear();

//     //gera o hex de 32 bits e transforma em utf8
//     var chave = CryptoJS.enc.Utf8.parse(genRanHex(32));

//     console.log('chave :' + chave);

//     //salva a chave aleatoria e o vetor de inicializacao no localstorage
//     window.localStorage.setItem('chave', chave);
//     // window.localStorage.setItem('iv', iv);

//     // window.localStorage.getItem('chave'); //COMANDO PARA PEGAR A CHAVE
//     // window.localStorage.getItem('iv'); //COMANDO PARA PEGAR O VETOR DE INICIALIZACAO

//     // criptografa a mensagem
//     // https://cryptojs.gitbook.io/docs
//     var criptografado = CryptoJS.AES.encrypt(valores, chave, {
//         iv: iv,
//         mode: CryptoJS.mode.CBC,
//         padding: CryptoJS.pad.ZeroPadding
//     });

//     var criptografado_string = criptografado.toString();
//     // console.log("mensagem criptografada: " + criptografado_string);

//     console.log("resto :" + CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(criptografado_string)).toString());

//     return chave + iv_random + CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(criptografado_string)).toString();
// }