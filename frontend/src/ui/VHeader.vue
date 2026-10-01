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
  padding: 8px 4vmin;
  background-color: #ffffff;
  box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
  z-index: 10;
}
</style>