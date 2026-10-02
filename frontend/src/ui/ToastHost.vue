<script setup lang="ts">
import { useToastState } from "@/ui/useToast.ts";

const state = useToastState();
</script>

<template>
  <div class="toast-host" aria-live="polite">
    <p v-for="item in state.items" :key="item.id" class="toast" role="alert">
      {{ item.message }}
    </p>
  </div>
</template>

<style scoped lang="scss">
.toast-host {
  position: fixed;
  top: var(--space-24);
  right: var(--space-24);
  z-index: 40;
  display: flex;
  flex-direction: column;
  gap: var(--space-12);
  width: min(360px, calc(100% - 2 * var(--space-24)));
  pointer-events: none;
}

.toast {
  margin: 0;
  padding: var(--space-16) var(--space-24);
  border: 1px solid var(--color-error);
  border-radius: var(--radius-card);
  background: var(--surface-card);
  color: var(--color-error);
  box-shadow: var(--shadow-card);
  font-size: 14px;
  font-weight: 500;
}
</style>
