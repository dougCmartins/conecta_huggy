<script setup lang="ts">
import CardBase from "@/ui/CardBase.vue";
</script>

<template>
  <div class="welcome">
    <section class="presentation" aria-labelledby="boas-vindas">
      <div class="presentation-text">
        <h1 id="boas-vindas">Bem-vindo a Conecta Huggy</h1>
        <p>
          Melhorar o relacionamento
          entre pessoas e organizações,
          independente do canal, este é o nosso propósito.
        </p>
      </div>
      <div class="plate" aria-hidden="true">
        <span class="ui-disc">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 16.5v-1.2A3.3 3.3 0 0 1 8.3 12h1.4" />
            <path d="M19 16.5v-1.2A3.3 3.3 0 0 0 15.7 12h-1.4" />
            <circle cx="9" cy="8" r="2.2" />
            <circle cx="15" cy="8" r="2.2" />
            <path d="M8 19.5h8" />
          </svg>
        </span>
      </div>
    </section>

    <section aria-labelledby="dentro">
      <h2 class="section-title" id="dentro">Fique por dentro do que acontece</h2>
      <p class="section-copy">Interaja com outros clientes iFood nos assuntos mais quentes do momento.</p>
      <div class="stack">
        <card-base>
          <template #content-img>
            <span class="ui-disc ui-disc--veil" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 8.5h10M7 12h10M7 15.5h6" />
                <rect x="4" y="4" width="16" height="16" rx="3" />
              </svg>
            </span>
          </template>
          <template #content-text>
            <h3>Construindo Relacionamentos Duradouros</h3>
            <p>O papel do Customer Success no sucesso do cliente.</p>
          </template>
          <template #content-author>
            <span class="ui-disc ui-disc--sm ui-disc--veil" aria-hidden="true">A</span>
          </template>
          <template #content-author-details>
            <span class="author-name">por Ana</span>
            <small>27/01/2025 — 23h00</small>
          </template>
        </card-base>
        <card-base>
          <template #content-img>
            <span class="ui-disc ui-disc--dark" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 16.5c2.2-2 4.2-3 7-3s4.8 1 7 3" />
                <circle cx="12" cy="8.5" r="2.4" />
                <path d="M4 19h16" />
              </svg>
            </span>
          </template>
          <template #content-text>
            <h3>A Evolução do Atendimento Digital</h3>
            <p>Como o digital transformou o atendimento.</p>
          </template>
          <template #content-author>
            <span class="ui-disc ui-disc--sm" aria-hidden="true">A</span>
          </template>
          <template #content-author-details>
            <span class="author-name">por Ana</span>
            <small>27/01/2025 — 23h00</small>
          </template>
        </card-base>
      </div>
    </section>

    <section class="band" aria-labelledby="categorias">
      <div class="band-head">
        <h2 id="categorias">Categorias</h2>
        <p class="band-total"><span class="num">9</span> artigos</p>
      </div>
      <ul class="cats">
        <li>
          <span class="ui-disc ui-disc--sm" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 5v2M12 17v2M5 12h2M17 12h2" stroke-linecap="round"/></svg>
          </span>
          <div>
            <strong>Customer Success</strong>
            <span><span class="num">3</span> artigos</span>
          </div>
        </li>
        <li>
          <span class="ui-disc ui-disc--sm ui-disc--veil" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 16.5V8.5l6-3 6 3v8l-6 3-6-3z"/></svg>
          </span>
          <div>
            <strong>Atendimento Digital</strong>
            <span><span class="num">3</span> artigos</span>
          </div>
        </li>
        <li>
          <span class="ui-disc ui-disc--sm ui-disc--dark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M5 15.5 9 8l3 4 2-2 5 5.5"/></svg>
          </span>
          <div>
            <strong>Marketing de Vendas</strong>
            <span><span class="num">3</span> artigos</span>
          </div>
        </li>
      </ul>
    </section>

    <section aria-labelledby="atualizacoes">
      <h2 class="section-title" id="atualizacoes">Últimas atualizações</h2>
      <card-base>
        <template #content-img>
          <span class="ui-disc ui-disc--veil" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 15.5 9 8l3 4 2-2 5 5.5" />
              <path d="M4 19h16" />
            </svg>
          </span>
        </template>
        <template #content-text>
          <h3>Estratégias de Captura de Leads</h3>
          <p>Como atrair o público certo.</p>
        </template>
        <template #content-author>
          <span class="ui-disc ui-disc--sm ui-disc--veil" aria-hidden="true">A</span>
        </template>
        <template #content-author-details>
          <span class="author-name">por Ana</span>
          <small>27/01/2025 — 23h00</small>
        </template>
      </card-base>
    </section>
  </div>
</template>

<style lang="scss">
.welcome {
  display: flex;
  flex-direction: column;
  gap: var(--space-section);

  .section-title {
    margin: 0 0 var(--space-12);
    font-size: 32px;
  }

  .section-copy {
    margin: 0 0 var(--space-32);
    max-width: 40rem;
    color: var(--text-muted);
  }

  .stack {
    display: flex;
    flex-direction: column;
    gap: var(--space-48);
  }

  .presentation {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: var(--space-48);
    align-items: center;

    @media (max-width: 768px) {
      grid-template-columns: 1fr;
      text-align: center;
    }

    h1 {
      margin: 0 0 var(--space-16);
      font-size: 56px;
      letter-spacing: -0.02em;
      line-height: 1.1;

      @media (max-width: 768px) {
        font-size: 40px;
      }
    }

    p {
      margin: 0;
      max-width: 38rem;
      color: var(--text-muted);
    }
  }

  .plate {
    display: grid;
    place-items: center;
    min-height: 320px;
    border-radius: var(--radius-card);
    background: var(--surface-card);
    border: 1px solid var(--border-soft);
    box-shadow: var(--shadow-card);
  }

  .author-name {
    display: block;
    font-size: 14px;
    font-weight: 500;
  }

  small {
    color: var(--text-muted);
    font-size: 13px;
    font-weight: 500;
  }

  .band {
    background: var(--surface-dark);
    color: var(--text-on-dark);
    border-radius: var(--radius-card);
    padding: var(--space-48);

    h2 {
      margin: 0;
      font-size: 32px;
      color: var(--text-on-dark);
    }
  }

  .band-head {
    display: flex;
    justify-content: space-between;
    gap: var(--space-24);
    align-items: end;
    margin-bottom: var(--space-32);

    @media (max-width: 768px) {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  .band-total {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: var(--text-muted-dark);
  }

  .cats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-32);
    margin: 0;
    padding: 0;
    list-style: none;

    @media (max-width: 768px) {
      grid-template-columns: 1fr;
    }

    li {
      display: flex;
      align-items: center;
      gap: var(--space-16);
    }

    strong {
      display: block;
      font-size: 16px;
      font-weight: 600;
    }

    span {
      color: var(--text-muted-dark);
      font-size: 14px;
      font-weight: 500;
    }
  }

  .card-base--item-text {
    text-align: left;
  }

  .card-base--item-author {
    justify-content: flex-start;
  }

  .num {
    font-variant-numeric: tabular-nums;
  }
}
</style>
