<template>
  <div class="trail">
      <section class="hero">
        <div>
          <h1>Trilha de Conteúdos da Conecta Huggy</h1>
          <p>Conteúdos para acelerar o sucesso do seu negócio.</p>
        </div>
        <div class="hero-mark" aria-hidden="true">
          <span class="ui-disc">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M8 5.5v13l11-6.5-11-6.5z" />
            </svg>
          </span>
        </div>
      </section>

      <ul class="grid">
        <li v-for="video in videosBefore" :key="video.id + video.title">
          <article class="card">
            <a :href="watchUrl(video.id)" target="_blank" rel="noopener noreferrer">
              <div class="thumb">
                <img :src="thumbUrl(video.id)" alt="">
                <span class="play" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5-11-6.5z" /></svg>
                </span>
              </div>
              <h2>{{ video.title }}</h2>
              <span class="watch">Assista no YouTube</span>
              <p class="meta">Huggy - Plataforma de Atendimento Digital</p>
            </a>
          </article>
        </li>
      </ul>

      <section class="band" aria-labelledby="faixa">
        <h2 id="faixa">Tenha chatbots <span class="num">24/7</span> e esteja sempre pronto para atender</h2>
        <button type="button" class="cta">
          Teste Grátis
          <span class="cta-badge">por <span class="num">7</span> dias</span>
        </button>
      </section>

      <ul class="grid">
        <li v-for="video in videosAfter" :key="video.id + video.title">
          <article class="card">
            <a :href="watchUrl(video.id)" target="_blank" rel="noopener noreferrer">
              <div class="thumb">
                <img :src="thumbUrl(video.id)" alt="">
                <span class="play" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5-11-6.5z" /></svg>
                </span>
              </div>
              <h2>{{ video.title }}</h2>
              <span class="watch">Assista no YouTube</span>
              <p class="meta">Huggy - Plataforma de Atendimento Digital</p>
            </a>
          </article>
        </li>
      </ul>
  </div>
</template>

<script setup lang="ts">
type TrailVideo = {
  id: string;
  title: string;
}

const videosBefore: TrailVideo[] = [
  { id: "KaKFJu6-J6c", title: "Como Criar Campanhas no WhatsApp e Impulsionar suas Vendas com Huggy + Rotik!" },
  { id: "jU39MmxPfCU", title: "Conheça o novo relatório de conversas do WhatsApp Business" },
  { id: "itw6rDh6zv0", title: "Como Planejar seu Fluxo de Atendimento para Automatizar seu Negócio" },
  { id: "KlKYWpw1m9E", title: "Como utilizar o ChatGPT em seus atendimentos com a Huggy" },
  { id: "GmShhgrk2UQ", title: "Como é feita a precificação do WhatsApp Business API" },
];

const videosAfter: TrailVideo[] = [
  { id: "_bNOBHfgVOM", title: "Como medir conversas iniciadas por anúncios?" },
  { id: "GmShhgrk2UQ", title: "Como é feita a precificação do WhatsApp Business API" },
  { id: "AqCupIGevsw", title: "Como organizar o atendimento e acelerar o crescimento dos negócios" },
  { id: "jU39MmxPfCU", title: "Conheça o novo relatório de conversas do WhatsApp Business" },
  { id: "ir_ybmTFeio", title: "Diferenças entre os tipos de mensagens do WhatsApp" },
];

const watchUrl = (id: string) => `https://www.youtube.com/watch?v=${id}`;
const thumbUrl = (id: string) => `https://i.ytimg.com/vi/${id}/mqdefault.jpg`;
</script>

<style scoped lang="scss">
.trail {
  display: flex;
  flex-direction: column;
  gap: var(--space-section);
}

.hero {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-48);

  h1 {
    margin: 0 0 var(--space-12);
    font-size: 40px;
    letter-spacing: -0.02em;
    line-height: 1.1;
  }

  p {
    margin: 0;
    color: var(--text-muted);
  }

  @media (max-width: 768px) {
    flex-direction: column;
    align-items: flex-start;
  }
}

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-24);
  margin: 0;
  padding: 0;
  list-style: none;

  @media (min-width: 769px) and (max-width: 1024px) {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  @media (min-width: 1025px) {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

.card,
.card a {
  display: flex;
  flex-direction: column;
  flex: 1;
  height: 100%;
  color: inherit;
  text-decoration: none;
}

.card {
  background: var(--surface-card);
  border: 1px solid var(--border-soft);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
}

.thumb {
  position: relative;
  aspect-ratio: 16 / 9;
  background: var(--surface);

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}

.play {
  position: absolute;
  inset: auto var(--space-16) var(--space-16) auto;
  display: grid;
  place-items: center;
  width: 44px;
  height: 44px;
  border-radius: var(--radius-pill);
  background: var(--vt-c-text-brand-1);
  color: var(--text-on-dark);

  svg {
    width: 18px;
    height: 18px;
  }
}

.card h2 {
  flex: 1;
  margin: var(--space-16) var(--space-16) var(--space-8);
  font-size: 18px;
}

.watch,
.meta {
  margin: 0 var(--space-16) var(--space-16);
  color: var(--text-muted);
  font-size: 14px;
}

.watch {
  font-weight: 600;
  color: var(--vt-c-text-brand-1);
}

.band {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-24);
  padding: var(--space-48);
  border-radius: var(--radius-card);
  background: var(--surface-veil);

  h2 {
    margin: 0;
    font-size: 32px;
  }

  @media (max-width: 768px) {
    flex-direction: column;
    align-items: flex-start;
  }
}

.cta {
  display: inline-flex;
  align-items: center;
  gap: var(--space-12);
  min-height: 44px;
  padding: var(--space-12) var(--space-24);
  border: 0;
  border-radius: var(--radius-pill);
  background: var(--vt-c-text-brand-1);
  color: var(--text-on-dark);
  font: inherit;
  font-weight: 600;
  cursor: pointer;
}

.cta-badge {
  padding: var(--space-8) var(--space-12);
  border-radius: var(--radius-pill);
  background: var(--surface-card);
  color: var(--text-primary);
  font-size: 13px;
}

.num {
  font-variant-numeric: tabular-nums;
}
</style>
