<script setup lang="ts">
defineProps<{
  variant?: "reading" | "forum";
}>();
</script>

<template>
  <div
    class="skeleton"
    :class="{ 'skeleton--reading': variant === 'reading' }"
    aria-hidden="true"
  >
    <div class="bone-block"></div>
    <div class="bone"></div>
    <div class="bone"></div>
  </div>
</template>

<style scoped lang="scss">
.skeleton {
  display: grid;
  gap: var(--space-16);
}

.skeleton--reading {
  width: min(720px, 100%);
  margin-inline: auto;
}

.bone {
  height: 16px;
  border-radius: var(--radius-pill);
  background: var(--border-soft);
}

.bone-block {
  height: 220px;
  border-radius: var(--radius-card);
  background: rgba(255, 255, 255, 0.72);
  border: 1px solid var(--border-soft);
}

.skeleton--reading .bone-block {
  height: 240px;
}
</style>
