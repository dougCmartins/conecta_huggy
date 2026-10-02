# Plano de diferenças — referência vs. projeto

Comparação entre [reference-tokens.md](reference-tokens.md) (miniatura da landing, 2026-10-01) e os estilos atuais do frontend.

O lado do projeto vem de [frontend/src/assets/base.scss](../frontend/src/assets/base.scss) e dos componentes em `frontend/src/`. Não havia um inventário escrito à parte. Nada disto foi aplicado.

A referência não é uma paleta para colar. O magenta como marca, o nome, o logo e a ordem das secções ficam de fora. A tabela regista o que difere.

## Cores

| Papel | Referência | Projeto hoje | Diferença |
| --- | --- | --- | --- |
| `surface` | `#F4F2FC`, lavanda clara, com véu rosa `#FFEFF7` num lado | `--vt-c-white` `#fafafa`; cards e header em `#ffffff` | Fundo neutro. Não há lavanda nem véu. |
| `surface-dark` | `#120A22`, violeta quase preto, como secção | `--vt-c-black` `#181818`, só em `prefers-color-scheme: dark` | Cinza neutro de tema do sistema. Não há secção escura desenhada. |
| `border` | `#E4E0F0` no claro; no escuro `rgba(255,255,255,0.10)` | `--color-border` `rgba(60,60,60,0.12)`; cards usam `#d7d7d7`; divisores `#ebebeb` | Cinza neutro, mais frio e mais marcado do que o fio lavanda. |
| `text-primary` | `#161222` no claro; `#FFFFFF` no escuro | Nos componentes, `#333333` (`--vt-c-text-dark-4`). O token semântico `--color-text` / `--color-heading` aponta para `#CDCDCD` | O texto útil é cinza médio, não violeta-preto. O token semântico está ligado a um cinza claro e o `body` herda-o. `--color-heading` não é usado nos componentes. |
| `text-muted` | `#6E6878` | `#777777` (`--vt-c-text-dark-3`) | Perto. O do projeto é cinza neutro, um pouco mais claro. |
| `accent` | `#E00060` | `#f8006d` (`--vt-c-text-brand-1`) nos botões `default`. O botão `primary` usa `#4908fd` | O rosa já existe e é próximo. O acento de ação principal é o índigo, não o magenta. |
| `accent-secondary` | `#A99BF2`, lilás-azulado | `#4908fd` (`--vt-primary`) e `#9f04b7` (`--vt-c-text-brand-2`) | Os dois são mais saturados. Não há um lilás claro de apoio. |
| `success` | `#54D271`, confiança baixa | Não existe. Erros usam `color: red` | Sem token de sucesso. O verde da referência não deve ser adoptado como estado de UI. |

## Espaçamento

| Papel | Referência | Projeto hoje | Diferença |
| --- | --- | --- | --- |
| Entre secções | 80 / 96 / 120 | `--section-gap: 160px`, declarado e não usado. O hero usa `margin: 5rem` (80). As páginas de conteúdo usam `padding: 2rem` (32) | O token de secção é maior do que a referência e não chega ao ecrã. O miolo das páginas é mais apertado do que 80–120. |
| Dentro de blocos | 8, 12, 16, 24, 32, 48 | 4px, 5px, 10px, 0.5rem, 0.75rem, 1rem, 1.5rem, 2rem, 20px, 30px, 4rem, sem escala | Valores soltos, em px e rem, repetidos em cada componente. |
| Padding de card | 24–32 | `CardBase` 20px; formulários, artigos e notícias `2rem` (32) | Os cards de conteúdo ficam um passo abaixo do intervalo. Os formulários já cabem. |
| Entre cards da timeline | 48–64 | Na trilha, `gap: 1rem` (16) entre cards; `gap: 4rem` (64) só entre blocos grandes | O intervalo entre cards da trilha é cerca de um terço do da referência. |

## Tipografia

A família já está no regime certo: Poppins é uma sans geométrica. Source Sans Pro entra como segunda família. A referência não nomeia uma fonte. O que difere é escala, peso, tracking e entrelinha.

O reset em `base.scss` põe `font-weight: normal` em todos os elementos. Títulos não recuperam peso 700.

| Papel | Referência | Projeto hoje | Diferença |
| --- | --- | --- | --- |
| Display | 48–64px, peso 700–800, tracking cerca de `-0.02em`, line-height ~1.1 | Hero: 50px, line-height 50px, `letter-spacing: 1px`. Peso herdado 400 | O tamanho cabe. O peso é regular e o tracking é positivo, no sentido contrário. |
| Título de secção | 28–36px, peso 700, tracking cerca de `-0.01em` | Fórum 35px; hero estreito 30px. Sem peso nem tracking próprios | O tamanho de alguns títulos cabe. Continuam em peso 400. |
| Corpo | 16px, peso 400, line-height ~1.5, tracking 0 | `body`: 15px, line-height 1.6. Cor semântica `#CDCDCD` | Um passo mais pequeno e um pouco mais aberto. A cor semântica é clara demais para texto. |
| Label / botão | 13–15px, peso 500–600 | Botão: 14px, peso 500, line-height 15px. Inputs: 12px. Metadados: 10px | O botão está no intervalo de tamanho e no peso mais baixo. Inputs e metadados ficam abaixo. A line-height do botão é a do próprio tamanho. |

## Raios

| Papel | Referência | Projeto hoje | Diferença |
| --- | --- | --- | --- |
| Cards | ~20px (faixa 16–24) | Conteúdo 15px (`CardBase`, notícias, trilha). Formulários 8px | Cards de conteúdo um pouco mais fechados. Formulários bem mais fechados. |
| Fotos | ~20px (faixa 16–24) | Hero e boas-vindas 12px. Uma imagem em `CardContent` já está em 20px. Media do `CardBase` em 15px | A maioria das fotos é mais quadrada do que a referência. |
| Botões | pill (`999px`) | `border-radius: 50px` | Já é pill. A diferença é cosmética. |
| Círculos de ícone | pill (`999px`) | Avatar do `CardBase`: `border-radius: 100%` | Já é círculo. |
| Chips / campos | pill na referência, para chips | Campos a 8px | Os campos não são pills. A referência não pedia pill em inputs. |

## Ordem proposta

Do que muda a estrutura da página ao que só afina o acabamento. Cada passo usa os papéis da referência. Não copia a marca.

1. **Papéis de superfície e de texto.** Separar fundo claro, fundo escuro de secção e texto principal. Corrigir `--color-text` / `--color-heading`, hoje ligados a `#CDCDCD`. O escuro da referência é uma secção, não o `prefers-color-scheme`.
2. **Escala de espaço.** Uma escala interior (8–48) e um ritmo entre secções (80 / 96 / 120). Retirar o `--section-gap: 160px` que ninguém usa, e o `padding: 2rem` das páginas deixa de ser o substituto desse ritmo. O intervalo entre cards da trilha (hoje 16) entra neste passo.
3. **Escala de tipo.** Manter Poppins. Dar peso 700 aos títulos, corpo a 16px, tracking negativo só no display, e deixar de depender do reset que força peso 400.
4. **Um acento de ação.** O projeto já tem três cores de botão (`#4908fd`, `#f8006d`, `#9f04b7`). Escolher um acento e um apoio lilás. O `#f8006d` já está perto do magenta observado. Não introduzir `#E00060` como marca nova. Não adoptar `#54D271`.
5. **Raios.** Cards e fotos para a faixa 16–24. Botões e avatares já estão em pill e em círculo.
6. **Sombra e fio.** A sombra repetida `2px 9px 49px -17px rgba(0,0,0,0.3)` é mais pesada e mais neutra do que `0 8px 32px rgba(22, 16, 40, 0.06)`. No escuro, o card separa-se pelo fio, quase sem sombra. O véu lavanda-rosa no fundo claro fica por último: é tratamento de superfície, não estrutura.

## Decisões do mockup home-v2

Ficheiro: [mockups/home-v2.html](mockups/home-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- O ecrã é a home autenticada (`/`), com a ordem actual: cabeçalho, apresentação, dois cards, faixa, uma atualização, rodapé.
- O fundo da página é o gradiente de `#F4F2FC` para `#FFEFF7`. As fotos dos cards, o `banner.png` e as ilustrações saem. A faixa que era imagem passa a `#120A22`.
- Neste ficheiro o acento é `#E00060` e o apoio é `#A99BF2`, porque a prova pediu os tokens da referência. Isso não instala o hex no produto. O projecto continua com `#f8006d`.
- `#54D271` não é usado. O erro da prova usa `#7A1F33`, cor que não vem da referência.
- Os círculos usam só cores medidas: accent, accent-secondary, surface-dark e o véu. Não há ciano nem coral novos.
- Os títulos dos cards são do `ArticleSeeder`. A autora é Ana, do `UserSeeder`. A data `27/01/2025, 23h00` é a que `TheWelcome.vue` já repete. A frase sobre clientes iFood mantém-se, porque já está nessa página.
- Ana não tem foto. A inicial no disco, como em "A Evolução do Atendimento Digital", fica centrada. O estilo do nome não muda o `display` do disco.
- Contagem do seed: 3 artigos em Customer Success, 3 em Atendimento Digital, 3 em Marketing de Vendas. Soma: 9. No estado vazio, cada categoria fica a 0 e a soma fica 0.
- Breakpoint `768px`. Display 56px, e 40px abaixo disso. Intervalo entre secções 96px, e 80px abaixo disso. Largura de leitura 1120px.
- Poppins, a família já usada em `base.scss`. O `index.html` não carrega fonte.
- Os estados vazio, a carregar e erro não existem na home actual. A barra que os troca fica de fora de qualquer aplicação futura.

## Decisões do mockup login-v2

Ficheiro: [mockups/login-v2.html](mockups/login-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- O ecrã é o login (`/login`): e-mail, senha e o botão "Entrar", como em `Login.vue`.
- O `background-1.jpg` e o símbolo de 30px saem. O fundo é o gradiente de `#F4F2FC` para `#FFEFF7`. No topo do card fica o wordmark "Conecta Huggy".
- O card passa de 400px e raio 8px para 420px e raio 20px. A sombra é `0 8px 32px rgba(22, 16, 40, 0.06)`. O traço acima do botão não entra.
- O botão é pill, fundo `#E00060`, sem sombra. O hover usa `#D01060`. Isto é só a prova. O projecto continua com o outline `#f8006d`.
- Os campos ficam rectangulares, raio 12px, texto 16px. Não são pills.
- O link "Não tens conta? Regista-te" não existe no login actual. Aponta para `/register`. Os rótulos "E-mail:", "Senha:" e "Entrar" mantêm a cópia da app.
- A mensagem de erro é "Erro ao realizar login", o fallback de `authStore.ts`, por baixo do botão. A cor é `#7A1F33`, que não vem da referência.
- A carregar desactiva o botão e marca o formulário com `aria-busy`. O texto do botão continua "Entrar". O botão ocupa a largura do card.
- O estado Foco desenha o anel no e-mail. O anel de teclado continua em `:focus-visible`.
- O estado normal é o formulário vazio. Não há números nesta tela.
- Breakpoint `768px`. Poppins. A barra de estados fica de fora de qualquer aplicação futura.

## Decisões do mockup registo-v2

Ficheiro: [mockups/registo-v2.html](mockups/registo-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- Usa a mesma família do login: card de 420px, raio 20px, a mesma sombra, Poppins, gradiente de `#F4F2FC` para `#FFEFF7`, botão pill `#E00060`. O `background-2.jpg` sai.
- A ordem é Nome, E-mail, Senha, confirmação, seguimentos, caixa de inscrição, botão e link. O card alinha ao topo porque o formulário é mais alto do que o do login.
- O botão da app diz "Registrar". Esta prova diz "Registar", como pedido. O link "Já tens conta? Entra" não existe no registo e aponta para `/login`.
- A confirmação de senha não existe em `RegisterUserData`. A regra de coincidência é só desta prova.
- "Ativar minha inscrição" vem de `Preferences.vue`. O registo de teste cria o utilizador com `is_subscribed` verdadeiro, por isso a caixa começa marcada e não tem erro.
- Os seguimentos são os 3 do `SegmentSeeder`: Canal de Relacionamento, Canal de Atendimento, Canal de Vendas. O controle é um `select` múltiplo nativo. A app usa `vue-multiselect`.
- No erro, a amostra é senha com 5 caracteres e confirmação com 6. O mínimo real é 6. Seguimentos: 0 de 3. As frases por campo são desta prova. A store só tem "Erro ao cadastrar usuário".
- No sucesso, a mensagem é "Conta criada." com 2 de 3 seguimentos. 2 + 1 = 3. Não usa `#54D271`. A app, depois de criar, manda para `/login`.
- Breakpoint `768px`. A barra de estados fica de fora de qualquer aplicação futura.

## Decisões do mockup preferencias-v2

Ficheiro: [mockups/preferencias-v2.html](mockups/preferencias-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- Junta o cabeçalho da home (wordmark e nav) ao card do login: 420px, raio 20px, a mesma sombra, Poppins, gradiente de `#F4F2FC` para `#FFEFF7`, botão pill `#E00060`.
- Os dados são os do `UserSeeder`: Ana, `ana@conecta.test`, inscrição marcada. O seed não liga seguimentos, por isso o select fica em 0 de 3.
- O rótulo é "Seguimentos:", como em `Preferences.vue`. O placeholder "Selecione um ou mais seguimentos" é o do registo, porque este ecrã não define um no `vue-multiselect`. O controle da prova é um `select` múltiplo nativo.
- O botão mantém "Salvar alterações". A guardar desactiva o botão e marca `aria-busy`.
- "Alterações guardadas." não existe na app. Depois de gravar, ela volta à home. A frase não usa `#54D271`.
- O erro é "Erro ao atualizar preferências", o fallback de `userStore.ts`, por baixo do botão, em `#7A1F33`.
- Preferências fica com `aria-current="page"`. O rodapé da app usa hífen. Aqui o texto pedido é "Conecta Huggy — 2026".
- Breakpoint `768px`. A barra de estados fica de fora de qualquer aplicação futura.

## Decisões do mockup forum-v2

Ficheiro: [mockups/forum-v2.html](mockups/forum-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- O fórum é mais largo que o card de login: coluna de leitura mais sidebar de 320px, dentro de 1200px. Abaixo de 768px a sidebar desce.
- O tópico em destaque é "Estratégias para Retenção de Clientes", o terceiro do `TopicSeeder`, como pedido. A app abre `topics[0]`, "Construindo Relacionamentos Duradouros".
- A categoria fica em `#E00060`. O bloco "Fidelização" usa os dois parágrafos do seed. A capa é um placeholder de raio 20px, sem as fotos da captura actual.
- "Outros tópicos" e "Tópicos Recentes" mostram os mesmos 2 tópicos, como o `slice(1)` da app. 2 + 1 = 3. A autora é Ana em todos.
- `created_at` já é timestamp. O `Topic` grava-o no insert. O seed não o passa. A byline do destaque mostra "Publicado em: 01 de outubro de 2026", o formato de `getFormattedDate()` para um seed feito nesta data. Os cards ficam "por Ana", como em `Forum.vue`.
- O erro é "Não foi possível carregar os tópicos", o fallback de `topicStore.ts`. Sem tópico actual, a app não desenha a página.
- A barra de estados fica de fora de qualquer aplicação futura.

## Decisões do mockup artigo-v2

Ficheiro: [mockups/artigo-v2.html](mockups/artigo-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- A coluna de leitura tem 720px, mais estreita que o fórum. O cabeçalho continua na largura de 1200px. Abaixo de 768px a coluna usa a página menos 48px.
- A captura actual não entra. O banner e as notícias de `Articles.vue` também ficam de fora.
- O breadcrumb é Fórum / Atendimento Digital / Artigo. Fórum aponta para `/forum`. A categoria não tem rota. A nav marca Artigos.
- O artigo é "Ferramentas de Atendimento Digital", o único da categoria com lista. A app abre `articles[0]`, "Construindo Relacionamentos Duradouros".
- O corpo é o do seed: um parágrafo (o subtítulo), o h2 "Top Ferramentas" e a lista de 3. Não há h3 no seed, por isso não se acrescenta.
- O corpo tem 14 palavras. A 200 por minuto, a leitura é menos de 1 minuto. A app não tem tempo de leitura.
- A data é 01 de outubro de 2026, a mesma byline do fórum, no formato de `getFormattedDate()`.
- Os relacionados são os outros 2 de Atendimento Digital. 2 + 1 = 3. A app lista `slice(1)` até `perPage` 7.
- A capa é um placeholder de raio 20px. A autora é Ana. O seed não tem biografia.
- O erro é "Não foi possível carregar os artigos". A barra de estados fica de fora de qualquer aplicação futura.

## Decisões do mockup trilha-v2

Ficheiro: [mockups/trilha-v2.html](mockups/trilha-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- O ecrã é `/content`. A nav marca Conteúdos. Título e subtítulo são os de `Trail.vue`.
- A captura actual não entra. `hyggor-2.svg` e `banner.png` ficam de fora. O hero usa um disco com ícone de play.
- Há 10 cards, na ordem dos iframes: 5 antes da faixa e 5 depois. 5 + 5 = 10. `jU39MmxPfCU` e `GmShhgrk2UQ` repetem-se, por isso 10 − 2 = 8 links únicos.
- Títulos e canal vêm do oEmbed desses links. Não há duração no oEmbed nem na app, por isso a meta é o canal.
- O card abre a página de visionamento. `Trail.vue` embute o player.
- A grelha tem 3 colunas a partir de 1025px, 2 colunas entre 769px e 1024px, e 1 coluna até 768px.
- O item da grelha, o card e o link são flex com `flex: 1`. A linha fica com a mesma altura. O título cresce e o badge com a meta alinham-se em baixo.
- A faixa usa `#FFEFF7`. O accent fica no CTA. O botão não tem URL, como `banner.png`. O texto mais o badge lêem "Teste Grátis por 7 dias".
- Vazio e erro escondem grelhas e faixa. O hero fica. A frase de erro não existe na app: `Trail.vue` é markup estático.
- A barra de estados fica de fora de qualquer aplicação futura.

## Decisões do mockup guest-v2

Ficheiro: [mockups/guest-v2.html](mockups/guest-v2.html). Prova visual. Não está aplicada ao Vue nem ao SCSS.

- O ecrã é `/guest`. Não há nav autenticada, porque `Guest.vue` não usa `VTemplate`.
- O ritmo é claro, escuro e fecho, com 96px entre secções. A ordem das secções da landing não entra. Não há fotos, logos, mascote nem faixa de teste.
- O hero usa o título, a missão e os botões de `Guest.vue`. Entrar é outline e aponta para `/login`. Começar agora é preenchido e aponta para `/register`.
- O diagrama é original: anéis, quatro avatares e três balões. `hyggor-1.svg` fica de fora.
- "Canais" não está na app. Os três nomes vêm do `SegmentSeeder`. O seed não tem mais texto, por isso o card só mostra o nome.
- A faixa escura mostra 3 tópicos, 9 artigos e 8 vídeos. A trilha tem 10 embeds e 2 repetidos, por isso 10 − 2 = 8. Os três números não se somam. Os cards pares recuam à direita. Abaixo de 768px alinham-se.
- O fecho é marketing. Não repete a frase da missão nem os botões. A imagem fica à esquerda e o texto à direita. No hero é o contrário. O painel é desenhado, sem foto.
- O rodapé vai de `#E00060` a `#120A22`. `Guest.vue` usa `#f8006d` a `#9f04b7`, com hífen. Aqui o texto é "Conecta Huggy — 2026".
- Abaixo de 960px o hero empilha e o título fica primeiro. `Guest.vue` só parte aos 768px e mostra a figura primeiro. Abaixo de 768px os canais empilham e os cards da faixa escura deixam o recuo.
- A página não pede dados. A prova cobre conteúdo e foco, não vazio, carregamento ou erro.
- A barra de estados fica de fora de qualquer aplicação futura.

## Menu dos mockups autenticados

- O wordmark em texto passou a `frontend/src/assets/img/logo.svg`, a marca da Conecta Huggy. Na home a imagem tem 23px de altura (28px menos 5px), para acompanhar o texto do menu. O texto do menu não muda. O link mantém 44px de altura.
- `frontend/src/assets/logo.svg` é o triângulo do Vue. Não entra no menu.
- Vale para home, fórum, artigo, trilha e preferências. Login, registo e guest não têm este menu.
