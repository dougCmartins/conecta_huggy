<script setup lang="ts">

</script>

<template>
  <header>
    <slot></slot>
  </header>
</template>

<style scoped lang="scss">
header {
  position: sticky;
  top: 0;
  width: 100%;
  padding: var(--space-24) 0;
  background-color: var(--surface-card);
  border-bottom: 1px solid var(--border-soft);
  z-index: 10;
}
</style>