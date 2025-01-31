<script setup lang="ts">
import VHeader from "@/components/ui/VHeader.vue";
import VNavBar from "@/components/ui/VNavBar.vue";
</script>

<template>
  <v-header>
    <v-nav-bar />
  </v-header>
  <main>
    <slot />
  </main>
  <footer>
    <img src="@/assets/img/simbolo.svg" alt="image footer">
    <p>Conecta Huggy - {{new Date().getFullYear()}}</p>
  </footer>
</template>

<style scoped lang="scss">
  main {
    display: flex;
    flex-direction: column;
    position: relative;
    padding: 4vmin;
  }
  footer {
    box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    background-color: #ffffff;
    min-height: 100px;
    padding: 15px;
    margin-top: 5rem;
    color: var(--vt-c-text-dark-4);

    img {
      width: 30px;
      max-width: 100%;
      height: auto;
      object-fit: cover;
    }
  }
</style>