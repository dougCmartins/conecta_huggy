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
  gap: var(--space-24);

  &--current {
    display: flex;
    gap: var(--space-24);
    @media (max-width: 768px) {
      flex-direction: column;
    }

    &-card {
      display: flex;
      justify-content: center;
      flex-direction: column;
      gap: var(--space-16);
      margin-bottom: var(--space-16);
      background-color: var(--surface-card);
      border: 1px solid var(--border-soft);
      border-radius: var(--radius-card);
      box-shadow: var(--shadow-card);
      min-height: 204px;
      width: 100%;
      padding: var(--space-32);
      text-align: center;
    }
  }
}

p {
  color: var(--vt-c-text-dark-3);
}

h1,h2,h3 {
  margin-bottom: var(--space-8);
  color: var(--vt-c-text-dark-4);
}
</style>
