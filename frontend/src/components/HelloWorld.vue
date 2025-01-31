<template>
  <main class="hero">
    <section class="hero--content">
      <article class="hero--content-text">
        <h1>
          Comunidade Conecta Huggy
        </h1>
        <p>
          Nossa missão é melhorar os relacionamentos entre organizações e
          clientes. A gente faz isso através do atendimento digital, humano,
          escalável e em tempo real. Simples assim, vantajoso para quem
          atende e para quem é atendido.
        </p>
        <div class="hero--content-button">
          <base-button @click="redirectLogin(ActionRoute.access)" text="Entrar" variant="default-outline" />
          <base-button @click="redirectLogin(ActionRoute.register)" text="Começar agora" variant="default" />
        </div>
      </article>
      <figure class="hero--content-figure">
        <img src="@/assets/img/hyggor-1.svg" alt="conecta huggy">
      </figure>
    </section>
    <section class="hero--description">
      <img src="../assets/img/simbolo.svg" alt="image footer">
      <p>Conecta Huggy - {{new Date().getFullYear()}}</p>
    </section>
  </main>
</template>

<script setup lang="ts">
import BaseButton from "@/components/ui/BaseButton.vue";
import { useRouter } from 'vue-router';
import { ref } from "vue";
import { ActionRoute } from '@/enums/ActionRoute.ts'

const router = useRouter();
const actionRoute = ref(ActionRoute)
const redirectLogin = (action: string) => {
  router.push({ name: action });
}
</script>

<style scoped lang="scss">
.hero {
  p {
   color: var(--vt-c-text-dark-3);
    letter-spacing: 0.75px;
  }

  h1,h2,h3 {
    color: var(--vt-c-text-dark-4);
    font-size: 50px;
    letter-spacing: 1px;
    line-height: 50px;
    margin: 0;

    @media (max-width: 768px){
      margin-top: 40px;
      font-size: 30px;
      line-height: 40px;
    }
  }

  &--content {
    margin: 5rem;
    display: flex;
    gap: 30px;
    align-items: center;
    @media (max-width: 768px) {
      margin: 2rem;
      flex-direction: column-reverse;
      text-align: center;
    }

    &-button {
      display: inline-flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      gap: 10px;
      box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
      margin-top: 1rem;
    }

    &-text {
      flex: 1 1 50%;
      min-width: 300px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      h1 {
        margin: 0 0 .4em;
      }
      @media (max-width: 768px) {
        flex: 1 1 100%;
        min-width: auto;
        align-items: center;
      }
    }

    &-figure {
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

  &--description {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: var(--vt-bg-gradient-1);
    min-height: 150px;
    gap: 14px;
    box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    p {
      color: var(--vt-c-white);
    }
    img {
      max-width: 50px;
      width: 100%;
      height: auto;
      object-fit: cover;
    }
  }
}
</style>
