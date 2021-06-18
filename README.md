
##
<h2 align="center">🚧 \backend\lib\esteganografia 🚧</h2>
Pasta da biblioteca de esteganografia que usamos para utilizar dessa técnica, codigo foi alterado, para que fosse possivel utilizalo como uma função, problemas encontrados no mesmo foi que, só é feito a alteração no byte refente a cor azul, impossibilitando a esteganografia de mensagens extensas

### Checklist
<details>
<summary>:white_check_mark: RF1 - Cadastro e senha forte</summary>
  <ul>
     <li>Utilizamos um espaço de chave de 362.033.331.456.891.249 combinações</li>
     <li>Para a verificação da senha foi utilizado expressões regulares</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF2 - Login e confirmação de cadastro</summary>
  <ul>
     <li>Login-front utiliza hash-sha256, para proteger o transporte</li>
     <li>Login-backend utiliza hash-sha256 como redundancia e salt, para fortalecer a senha do usuario</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF3 - 2FA (sistema e e-mail)</summary>
  <ul>
    <li>O sistema reseta o token de o token inserido for o incorreto, e pede novamente a senha</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF4 - Hash para senha de usuário e token para autenticação por e-mail</summary>
  <ul>
     <li>Sistema - autenticação por senha</li>
     <li>E-mail - segundo fator usando um token aleatorio de espaço de chave 34.296.447.249</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF5 - Recuperação de senha por e-mail através de token</summary>
  <ul>
    <li>Token gerado apartir de substrings dos dados do usuario na tabela do user</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF6 - Sessão com dados do usuário armazenados, reiniciar depois de alterar senha e excluir os cookies</summary>
  <ul>
      <li>É feita a cada requisição no backend</li>
      <li>Sessão é zerada após uma hora independende da atividade do usuario</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF7 - Esteganografia para esconder senha de acesso ao banco de dados</summary>
  <ul>
     <li>Feita em imagem utilizando o phpGD, alterando o bit menos significativo relativo ao RGB (trabalhamos só com o blue)</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF8 - A autenticação por senha dura 5 minutos</summary>
  <ul>
    <li>Feita somente com requisições ao end-poin /Logged/*</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF9 - A sessão dura uma hora</summary>
  <ul>
    <li>Independente da atividade do usuario ele precisa de reautenticação apos uma hora de uso do sistema</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF10 - Certificado SSL</summary>
  <ul>
     <li>São os passos que seguimos para instalar o certificado</li>
     <li>O certificado foi instalado no computador dos integrantes, e não está no reposítório, para setup seguir o passo a passo encontrado no guia.</li>
  </ul>
</details>

<details>
<summary>:white_check_mark: RF11 - Precisa estar autenticado para acessar URLs</summary>
    <ul>
        <li>todas urls do end-point /Logged</li>
    </ul>
</details>

<details>
<summary>:black_square_button: RF12 - mensagens assinadas com chave publica</summary>
    <ul>
        <li>...</li>
    </ul>
</details>
<summary>:white_check_mark: RF13 - esteganografia para esconder chave privada</summary>
    <ul>
        <li>...</li>
    </ul>
</details>
<summary>:black_square_button: RF14 - vetores de inicialização pseudoaleatoriosa</summary>
    <ul>
        <li>...</li>
    </ul>
</details>
<details>
<summary>:white_check_mark: RF15 - Geradores de pseudo aleatoriedade</summary>
  <ul>
     <li>Utilizados na autenticação 2FA para gerar o token enviado ao e-mail</li>
  </ul>
</details>

## Configurações apache (.htaccess)
:new: Configurações apache para não listar diretorios
```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^(.*)$ $1.php
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}\.html -f
RewriteRule ^(.*)$ $1.html
```
:new: retirando indexação de pastas
```
Options All -Indexes
```
:new:Redirecionar em caso de erros 
```
ErrorDocument 400 /http_errors/400.html
ErrorDocument 403 /http_errors/403.html
ErrorDocument 404 /http_errors/404.html
ErrorDocument 405 /http_errors/405.html
ErrorDocument 408 /http_errors/408.html
ErrorDocument 410 /http_errors/410.html
ErrorDocument 500 /http_errors/500.html
ErrorDocument 502 /http_errors/502.html
ErrorDocument 503 /http_errors/503.html
ErrorDocument 504 /http_errors/504.html
```
:new: Fazer o php interpretar arquivos .css (serve para futuramente gerar classes e id's aleatoriamente)
```
<FilesMatch "\.css$">
SetHandler application/x-httpd-php
Header set Content-type "text/css"
</FilesMatch>
```

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
