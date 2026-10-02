# Tokens de referência — landing SaaS

Observação visual de uma miniatura JPEG 240×1024 da homepage de marketing, em 2026-10-01. Não houve leitura do site ao vivo nem do CSS de produção.

A tarefa do visitante nessa página é perceber o produto e iniciar conversa ou registo.

Estes números são estimativas. A compressão e a escala da miniatura não permitem medir família tipográfica, raios ou sombras em píxeis reais.

Isto é dados de observação. Não é o sistema visual do produto e não é uma paleta para instalar. Marca, textos, logos, fotos e a ordem das secções ficam de fora.

## Paleta

Cada papel tem um valor de trabalho e a amostra que o sustenta.

- `surface`: `#F4F2FC` — lavanda muito clara (`#F0F0FC`, `#F2F1FF`, `#FCFCFC`). Num lado do topo há um véu rosa (`#FFEFF7`).
- `surface-dark`: `#120A22` — violeta quase preto, não preto puro (`#100820`, `#100818`, `#181030`).
- `border`: `#E4E0F0` no claro. No escuro, fio `rgba(255, 255, 255, 0.10)`. Estimativa: a miniatura não isola o traço.
- `text-primary`: `#161222` no claro; `#FFFFFF` no escuro.
- `text-muted`: `#6E6878`.
- `accent`: `#E00060` — cluster magenta `#F00060` / `#E00060` / `#D01060`.
- `accent-secondary`: `#A99BF2` — o azul claro visível é lilás-azulado (`#B0A0F0`, `#B0A0E0`), não um ciano puro.
- `success`: `#54D271`. Confiança baixa: dois pixels verdes. Pode ser logo ou ícone, não um estado de UI.

## Espaçamento

Escala estimada, alinhada ao respiro largo que se vê.

- Entre secções: 80 / 96 / 120
- Dentro de blocos: 8, 12, 16, 24, 32, 48
- Padding de card: 24–32
- Entre cards da timeline: 48–64

## Tipografia

Sans geométrica. O nome da família não é legível nesta miniatura, por isso não se afirma nenhuma fonte concreta.

- Display: 48–64px, peso 700–800, tracking cerca de `-0.02em`, line-height ~1.1
- Título de secção: 28–36px, peso 700, tracking cerca de `-0.01em`
- Corpo: 16px, peso 400, line-height ~1.5, tracking 0
- Label / botão: 13–15px, peso 500–600

## Raios

- Cards e fotos: ~20px (faixa 16–24)
- Botões, chips e círculos de ícone: pill (`999px`)

## Sombras

- Card claro: sombra baixa, difusa e fria, algo como `0 8px 32px rgba(22, 16, 40, 0.06)`
- Card no fundo escuro: separa-se pelo fio, quase sem sombra
- Botão magenta: não depende de sombra

## Padrões de layout

Princípios observados, sem a composição da página.

- Secções claras e escuras alternadas
- Cards centrados com muito respiro
- Timeline vertical com cards alternados
- Ícones em círculos coloridos. O conjunto lilás, ciano, verde e coral é decoração, não uma segunda paleta de marca
- Gradiente suave no fundo claro, de lavanda para um véu rosa

## O que fica de fora

Nome, logo, copy, fotografia, o magenta como marca e a ordem das secções.

O que pode ser reutilizado sem copiar a marca: ritmo claro/escuro, bastante ar entre secções, e o objeto (card ou timeline) como prova, não o slogan sozinho.
