<script setup lang="ts">
import WelcomeItem from './WelcomeItem.vue'
import CardBase from "@/components/ui/CardBase.vue";
import CardContent from "@/components/ui/CardContent.vue";
</script>

<template>
  <div class="welcome">
    <div class="welcome-item--presentation">
      <div class="welcome-item--presentation-text">
        <h1>Bem-vindo a Conecta Huggy</h1>
        <p>
          Melhorar o relacionamento
          entre pessoas e organizações,
          independente do canal, este é o nosso propósito.
        </p>
      </div>
      <div class="welcome-item--presentation-img">
        <img src="@/assets/img/hyggor-1.svg" alt="Welcome">
      </div>
    </div>
    <div class="welcome-item--topic">
      <div class="welcome-item--topic-text">
        <h1 class="text-center">Fique por dentro do que acontece</h1>
        <p class="text-center">Interaja com outros clientes iFood nos assuntos mais quentes do momento.</p>
      </div>
      <card-base>
        <template #content-img>
          <img alt="conteudo" src="@/assets/img/article-1.png">
        </template>
        <template #content-text>
          <h2>Atendimento Digital</h2>
          <p>
            Conteúdos sobre atendimento digital, chatbots, qualidade no atendimento, WhatsApp Business API e outros temas para potencializar o seu negócio.
          </p>
        </template>
        <template #content-author>
          <img alt="conteudo" src="@/assets/img/insides.jpg">
        </template>
        <template #content-author-details>
          <span>por Fulano de tal</span>
          <span>27/01/2025 - 23h00</span>
        </template>
      </card-base>
    </div>
    <div class="welcome-item--topic">
      <card-base>
        <template #content-img>
          <img alt="conteudo" src="@/assets/img/digital.jpg">
        </template>
        <template #content-text>
          <h2>Atendimento Digital</h2>
          <p>
            Conteúdos sobre atendimento digital, chatbots, qualidade no atendimento, WhatsApp Business API e outros temas para potencializar o seu negócio.
          </p>
        </template>
        <template #content-author>
          <img alt="conteudo" src="@/assets/img/insides.jpg">
        </template>
        <template #content-author-details>
          <span>por Fulano de tal</span>
          <span>27/01/2025 - 23h00</span>
        </template>
      </card-base>
    </div>
    <div class="welcome-item--banner">
      <img alt="conteudo" src="@/assets/img/banner.png">
    </div>
        <div class="welcome-item--article">
          <div class="welcome-item--article-text">
            <h1>Últimas atualizações</h1>
          </div>

          <div class="welcome-item--topic-footer">
            <card-base>
              <template #content-img>
                <img alt="conteudo" src="@/assets/img/DM_20250125154530_001.jpg">
              </template>
              <template #content-text>
                <h2>Proteja os dados da sua empresa e clientes</h2>
                <p>
                  Garanta a segurança dos dados da sua empresa e cumpra a LGPD
                </p>
              </template>
              <template #content-author>
                <img alt="conteudo" src="@/assets/img/DM_20250125154530_001.jpg">
              </template>
              <template #content-author-details>
                <span>por Fulano de tal</span>
                <span>27/01/2025 - 23h00</span>
              </template>
            </card-base>
          </div>
        </div>
  </div>
</template>

<style lang="scss">
.welcome {
  display: flex;
  flex-direction: column;
  gap: 4rem;
  margin: 2rem;

  @media (max-width: 768px) {
    gap: 2rem;
  }
  &-item {
    &--presentation {
      display: flex;
      gap: 2rem;
      align-items: center;
      @media (max-width: 768px) {
        flex-direction: column;
        text-align: center;
      }

      &-text {
        flex: 1 1 50%;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;

        @media (max-width: 768px) {
          flex: 1 1 100%;
          min-width: auto;
          align-items: center;
        }
      }

      &-img {
        flex: 1 1 50%;
        position: relative;
        min-width: 300px;

        @media (max-width: 768px) {
          flex: 1 1 100%;
          min-width: auto;
          width: 80%;
          max-width: 400px;
        }
        img {
          width: 100%;
          height: auto;
          border-radius: 12px;
          object-fit: cover;
        }
      }
    }
    &--topic {
      display: flex;
      flex-direction: column;
      gap: 2rem;

      &-footer {
        display: flex;
        text-align: left;
        @media (max-width: 768px) {
          align-items: center;
        }
      }
    }

    &--article {
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
      gap: 1rem;

      &-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;

        &-img {
          flex: 1 1 100%;
          min-width: auto;
          width: 100%;
          margin: 0 auto;
          padding: 0 1rem;
          img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            object-position: center;
            border-radius: 12px;
          }
        }

        &-text {
          display: flex;
          flex-direction: column;
          justify-content: center;
          flex: 1 1 100%;
          min-width: auto;
        }
      }
    }
    &--banner {
      display: flex;
      flex-direction: column;
      img {
        width: 100%;
        height: auto;
        object-fit: cover;
        object-position: center;
        border-radius: 12px;
      }
    }
  }

  .card-base--item-text {
    text-align: left;
  }

  .card-base--item-author {
    justify-content: flex-start;
  }

  p {
    color: var(--vt-c-text-dark-3);
  }

  h1,h2,h3 {
    margin-bottom: 0.5rem;
    color: var(--vt-c-text-dark-4);
  }

  .text-center {
    text-align: center;
  }
}
</style>
