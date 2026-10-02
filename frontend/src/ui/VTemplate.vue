<script setup lang="ts">
import VHeader from "@/ui/VHeader.vue";
import VNavBar from "@/ui/VNavBar.vue";
</script>

<template>
  <v-header>
    <v-nav-bar />
  </v-header>
  <main>
    <router-view />
  </main>
  <footer>
    <span class="ui-disc ui-disc--sm" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
        <circle cx="12" cy="12" r="4" />
      </svg>
    </span>
    <p>Conecta Huggy — {{ new Date().getFullYear() }}</p>
  </footer>
</template>

<style scoped lang="scss">
  main {
    display: flex;
    flex-direction: column;
    position: relative;
    width: min(var(--content-width), 100%);
    margin-inline: auto;
    padding: 0 var(--space-48) var(--space-section);

    @media (max-width: 768px) {
      padding-inline: var(--space-24);
    }
  }
  footer {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: var(--space-12);
    background-color: var(--surface-card);
    border-top: 1px solid var(--border-soft);
    padding: var(--space-48) var(--space-24);
    color: var(--text-primary);
    font-size: 14px;
    font-weight: 500;

    .ui-disc {
      width: 30px;
      height: 30px;

      svg {
        width: 16px;
        height: 16px;
      }
    }
  }
</style>