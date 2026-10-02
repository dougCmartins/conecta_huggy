<template>
  <main class="guest">
    <section class="hero shell">
      <div class="hero-copy">
        <h1>Comunidade Conecta Huggy</h1>
        <p>
          Nossa missão é melhorar os relacionamentos entre organizações e
          clientes. A gente faz isso através do atendimento digital, humano,
          escalável e em tempo real. Simples assim, vantajoso para quem
          atende e para quem é atendido.
        </p>
        <div class="actions">
          <base-button @click="redirectLogin(ActionRoute.access)" text="Entrar" variant="default-outline" />
          <base-button @click="redirectLogin(ActionRoute.register)" text="Começar agora" variant="default" />
        </div>
      </div>
      <svg class="diagram" viewBox="0 0 520 520" role="img" aria-label="Diagrama da comunidade: pessoas e mensagens à volta de um centro">
        <circle cx="260" cy="260" r="210" fill="none" stroke="var(--border-soft)" stroke-width="1.5" stroke-dasharray="3 10" />
        <circle cx="260" cy="260" r="148" fill="none" stroke="var(--border-soft)" stroke-width="1.5" stroke-dasharray="3 10" />
        <circle cx="260" cy="260" r="88" fill="none" stroke="var(--border-soft)" stroke-width="1.5" />
        <circle cx="260" cy="260" r="58" fill="var(--vt-c-text-brand-1)" />
        <path fill="var(--text-on-dark)" d="M238 248h36a8 8 0 0 1 8 8v18a8 8 0 0 1-8 8h-16l-10 8v-8h-10a8 8 0 0 1-8-8v-18a8 8 0 0 1 8-8z" />
        <g transform="translate(360 96)">
          <circle r="28" fill="var(--vt-c-text-brand-1)" />
          <circle cy="-6" r="7" fill="var(--text-on-dark)" />
          <path fill="var(--text-on-dark)" d="M-12 14c1.2-8 6-11 12-11s10.8 3 12 11z" />
        </g>
        <g transform="translate(448 300)">
          <circle r="28" fill="var(--surface-dark)" />
          <circle cy="-6" r="7" fill="var(--text-on-dark)" />
          <path fill="var(--text-on-dark)" d="M-12 14c1.2-8 6-11 12-11s10.8 3 12 11z" />
        </g>
        <g transform="translate(96 330)">
          <circle r="28" fill="var(--surface-veil)" />
          <circle cy="-6" r="7" fill="var(--text-primary)" />
          <path fill="var(--text-primary)" d="M-12 14c1.2-8 6-11 12-11s10.8 3 12 11z" />
        </g>
        <g transform="translate(132 118)">
          <circle r="28" fill="var(--surface-card)" />
          <circle cy="-6" r="7" fill="var(--text-primary)" />
          <path fill="var(--text-primary)" d="M-12 14c1.2-8 6-11 12-11s10.8 3 12 11z" />
        </g>
        <rect x="214" y="28" width="84" height="36" rx="14" fill="var(--surface-card)" stroke="var(--border-soft)" />
        <rect x="392" y="168" width="72" height="32" rx="14" fill="var(--vt-c-text-brand-1)" />
        <rect x="40" y="210" width="88" height="36" rx="14" fill="var(--surface-card)" stroke="var(--border-soft)" />
      </svg>
    </section>

    <section class="channels" aria-labelledby="canais">
      <div class="shell">
        <h2 id="canais">Canais</h2>
        <ul class="channel-list">
          <li class="channel">
            <span class="ui-disc ui-disc--sm" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <circle cx="8" cy="9" r="2.2" />
                <circle cx="16" cy="9" r="2.2" />
                <path d="M4.5 18c.6-2.4 2.2-3.6 3.5-3.6S11 15.6 11.6 18" />
                <path d="M12.4 18c.6-2.4 2.2-3.6 3.5-3.6s2.9 1.2 3.6 3.6" />
              </svg>
            </span>
            <p>Canal de Relacionamento</p>
          </li>
          <li class="channel">
            <span class="ui-disc ui-disc--sm ui-disc--veil" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 16.5 5.5 19.5 9 17.2" />
                <path d="M8 16.5h8.2a3 3 0 0 0 3-3v-4a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v4a3 3 0 0 0 3 3z" />
              </svg>
            </span>
            <p>Canal de Atendimento</p>
          </li>
          <li class="channel">
            <span class="ui-disc ui-disc--sm ui-disc--dark" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <circle cx="12" cy="12" r="7" />
                <path d="M12 9v3.2L14.2 14" />
              </svg>
            </span>
            <p>Canal de Vendas</p>
          </li>
        </ul>
      </div>
    </section>

    <section class="rooms" aria-labelledby="salas">
      <div class="shell">
        <h2 id="salas">Fórum, artigos e conteúdos</h2>
        <ol class="room-list">
          <li class="room">
            <strong class="num">3</strong>
            <span>tópicos no Fórum</span>
          </li>
          <li class="room">
            <strong class="num">9</strong>
            <span>artigos</span>
          </li>
          <li class="room">
            <strong class="num">8</strong>
            <span>vídeos na trilha</span>
          </li>
        </ol>
      </div>
    </section>

    <section class="close" aria-labelledby="fecho">
      <div class="shell close-grid">
        <svg class="close-figure" viewBox="0 0 480 400" role="img" aria-label="Troca de mensagens entre pessoas da comunidade">
          <rect width="480" height="400" rx="20" fill="var(--surface-veil)" />
          <rect x="56" y="48" width="250" height="148" rx="20" fill="var(--surface)" />
          <rect x="148" y="118" width="276" height="168" rx="20" fill="var(--surface-card)" stroke="var(--border-soft)" />
          <circle cx="188" cy="168" r="18" fill="var(--vt-c-text-brand-1)" />
          <circle cx="188" cy="162" r="5" fill="var(--text-on-dark)" />
          <path fill="var(--text-on-dark)" d="M178 178c1-6 4.4-8 10-8s9 2 10 8z" />
          <rect x="222" y="156" width="160" height="10" rx="5" fill="var(--border-soft)" />
          <rect x="222" y="178" width="120" height="10" rx="5" fill="var(--surface)" />
          <rect x="222" y="200" width="148" height="10" rx="5" fill="var(--surface)" />
          <rect x="36" y="248" width="210" height="96" rx="20" fill="var(--surface-dark)" />
          <rect x="60" y="276" width="120" height="10" rx="5" fill="var(--text-on-dark)" />
          <rect x="60" y="298" width="84" height="10" rx="5" fill="var(--text-muted-dark)" />
        </svg>
        <div>
          <h2 id="fecho">A conversa continua depois do primeiro contacto.</h2>
          <p>
            No fórum, nos artigos e na trilha, quem atende encontra a prática
            de quem já passou pelo mesmo caminho. A comunidade aproxima
            quem atende e mantém o atendimento humano, no ritmo do dia a dia.
          </p>
        </div>
      </div>
    </section>

    <footer class="site-footer">
      <p>Conecta Huggy — <span class="num">{{ year }}</span></p>
    </footer>
  </main>
</template>

<script setup lang="ts">
import BaseButton from "@/ui/BaseButton.vue";
import { useRouter } from 'vue-router';
import { ActionRoute } from '@/router/ActionRoute.ts'

const router = useRouter();
const year = new Date().getFullYear();
const redirectLogin = (action: string) => {
  const { href } = router.resolve({ name: action });
  window.open(href, "_blank", "noopener");
}
</script>

<style scoped lang="scss">
.guest {
  min-height: 100vh;
}

.shell {
  width: min(var(--content-width), calc(100% - 2 * var(--space-48)));
  margin-inline: auto;

  @media (max-width: 768px) {
    width: min(var(--content-width), calc(100% - 2 * var(--space-24)));
  }
}

.hero {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: var(--space-48);
  align-items: center;
  padding-block: var(--space-section);

  h1 {
    margin: 0 0 var(--space-16);
    font-size: 56px;
    letter-spacing: -0.02em;
    line-height: 1.1;
  }

  p {
    margin: 0;
    max-width: 38rem;
    color: var(--text-muted);
  }

  @media (max-width: 960px) {
    grid-template-columns: 1fr;

    h1 {
      font-size: 40px;
    }
  }
}

.actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-12);
  margin-top: var(--space-24);
}

.diagram,
.close-figure {
  width: 100%;
  height: auto;

  @media (max-width: 960px) {
    max-width: 420px;
    margin-inline: auto;
  }
}

.channels,
.close {
  padding-bottom: var(--space-section);
}

.channels h2,
.rooms h2,
.close h2 {
  margin: 0 0 var(--space-32);
  font-size: 32px;
}

.channel-list {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: var(--space-24);
  margin: 0;
  padding: 0;
  list-style: none;

  @media (max-width: 768px) {
    grid-template-columns: 1fr;
  }
}

.channel {
  display: flex;
  align-items: center;
  gap: var(--space-16);
  min-height: 112px;
  padding: var(--space-24);
  border: 1px solid var(--border-soft);
  border-radius: var(--radius-card);
  background: var(--surface-card);
  box-shadow: var(--shadow-card);

  p {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: var(--text-primary);
  }
}

.rooms {
  padding-block: var(--space-section);
  background: var(--surface-dark);
  color: var(--text-on-dark);

  h2 {
    max-width: 16rem;
    color: var(--text-on-dark);
  }
}

.room-list {
  display: grid;
  gap: var(--space-48);
  margin: 0;
  padding: 0;
  list-style: none;
}

.room {
  display: flex;
  align-items: baseline;
  gap: var(--space-24);
  width: min(100%, 640px);
  padding: var(--space-32);
  border: 1px solid var(--border-on-dark);
  border-radius: var(--radius-card);
  background: rgba(255, 255, 255, 0.04);

  &:nth-child(even) {
    margin-left: auto;
  }

  strong {
    font-size: 48px;
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1;
    color: var(--text-on-dark);
  }

  span {
    color: var(--text-muted-dark);
    font-size: 16px;
  }

  @media (max-width: 768px) {
    width: 100%;
    margin-left: 0;

    &:nth-child(even) {
      margin-left: 0;
    }
  }
}

.close-grid {
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  gap: var(--space-48);
  align-items: center;

  @media (max-width: 960px) {
    grid-template-columns: 1fr;
  }

  p {
    margin: 0;
    color: var(--text-muted);
  }
}

.site-footer {
  background: linear-gradient(90deg, var(--vt-c-text-brand-1) 0%, var(--surface-dark) 100%);
  color: var(--text-on-dark);
  text-align: center;
  padding: var(--space-48) var(--space-24);
  font-size: 14px;
  font-weight: 500;
}

.num {
  font-variant-numeric: tabular-nums;
}
</style>
