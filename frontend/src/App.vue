<!-- src/App.vue -->
<template>
  <div id="app">
    <router-view />
    <toast-host />
  </div>
</template>

<script setup lang="ts">
import ToastHost from "@/ui/ToastHost.vue";
</script>

<style>
header + main {
  margin-top: var(--space-section);
}
</style>