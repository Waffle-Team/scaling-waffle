### Pré-requisitos

# Arquivos para checar

##
<h2 align="center">certificado-guia.txt</h2>
> São os passos que seguimos para instalar o certificado
> O certificado foi instalado no computador dos integrantes, e não está no reposítório, para setup seguir o passo a passo encontrado no guia.

##
<h2 align="center">🚧 \backend\lib\esteganografia 🚧</h2>
> Pasta da biblioteca de esteganografia que usamos para utilizar dessa técnica
> Codigo foi alterado, para que fosse possivel utilizalo como uma função
> Problemas encontrados no mesmo foi que, só é feito a alteração no byte refente a cor azul, impossibilitando a esteganografia de mensagens extensas

### Checklist
- [x] RF1 - cadastro e senha forte
- [x] RF2 - login e confirmação de cadastro
- [x] RF3 - 2FA (sistema e e-mail)
- [x] RF4 - hash para senha de usuário e token para autenticação por e-mail
- [x] RF5 - recuperação de senha por e-mail através de token
- [x] RF6 - sessão com dados do usuário armazenados, reiniciar depois de alterar senha e excluir os cookies
- [x] RF7 - esteganografia para esconder senha de acesso ao banco de dados
- [x] RF8 - a autenticação por senha dura 5 minutos
- [x] RF9 - a sessão dura uma hora
- [x] RF10 - certificado SSL
- [x] RF11 - precisa estar autenticado para acessar URLs
- [ ] RF12 - mensagens assinadas com chave publica 
- [ ] RF13 - esteganografia para esconder chave privada
- [ ] RF14 - vetores de inicialização pseudoaleatorios
- [x] RF15 - geradores de pseudo aleatoriedade

### 🛠 Bibliotecas/Dependencias

- [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- [CryptoJS](https://cryptojs.gitbook.io/docs/)
- [Bootstrap](https://github.com/twbs/bootstrap)
- [Jquery](https://github.com/jquery/jquery)

## Integrantes

<table allign="center">
<tr>
<td align="center"><a href="https://github.com/GustaSchmidt"><img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/53221408?v=4" width="100px;" alt=""/><br /><sub><b>Gustavo Schmidt</b></sub></a><br /><a href="https://github.com/GustaSchmidt" title="Rocketseat">🚀</a></td>
<td align="center"><a href="https://github.com/CriminalShrimp"><img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/72232789?v=4" width="100px;" alt=""/><br /><sub><b>Aleister Edward</b></sub></a><br /><a href="https://github.com/CriminalShrimp" title="Rocketseat">🚀</a></td>
</tr>
<tr>
<td align="center"><a href="https://github.com/Spl3F"><img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/66442461?v=4" width="100px;" alt=""/><br /><sub><b>Felipe Noleto</b></sub></a><br /><a href="https://github.com/Spl3F" title="Rocketseat">🚀</a></td>
<td align="center"><a href="https://github.com/Maideh"><img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/51738019?v=4" width="100px;" alt=""/><br /><sub><b>Gabriel Ramos</b></sub></a><br /><a href="https://github.com/Maideh" title="Rocketseat">🚀</a></td>
</tr>
</table>
