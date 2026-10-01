<template>
  <div class="noticies">
    <h1>Noticias</h1>
    <div class="noticies--current">
      <div class="noticies--current-card">
        <h2>Chatbots impulsionam atendimento 24/7</h2>
        <p>
          Empresas estão adotando chatbots com IA para oferecer suporte contínuo e melhorar a experiência do usuário.
        </p>
      </div>
      <div class="noticies--current-card">
        <h2>Personalização no atendimento digital</h2>
        <p>
          Ferramentas de CRM e IA ajudam empresas a oferecer experiências personalizadas e fidelizar consumidores.
        </p>
      </div>
      <div class="noticies--current-card">
        <h2>WhatsApp Business revoluciona vendas</h2>
        <p>
          O uso do WhatsApp Business cresce, tornando a comunicação entre clientes e empresas mais ágil e eficiente.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
</script>

<style scoped lang="scss">
.noticies {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: center;
  gap: 1rem;

  &--current {
    display: flex;
    gap: 1rem;
    @media (max-width: 768px) {
      flex-direction: column;
    }

    &-card {
      display: flex;
      justify-content: center;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 1rem;
      background-color: #fff;
      border: 1px solid #d7d7d7;
      border-radius: 15px;
      box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
      min-height: 204px;
      width: 100%;
      padding: 2rem;
      text-align: center;
    }
  }
}

p {
  color: var(--vt-c-text-dark-3);
}

h1,h2,h3 {
  margin-bottom: 0.5rem;
  color: var(--vt-c-text-dark-4);
}
</style>
