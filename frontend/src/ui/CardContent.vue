<template>
  <div class="card card-content">
    <div class="card-content--img">
      <slot name="content-img" />
    </div>
    <div class="card-content--items">
      <slot name="content-items" />
    </div>
  </div>
</template>

<style lang="scss">
.card {
  &-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 1rem;
    @media (max-width: 768px) {
      flex-direction: column;
    }

    &--img {
      display: flex;
      justify-content: center;
      img {
        width: 100%;
        height: 100%;
        border-radius: 20px;
      }
    }
    &--items {
      display: flex;
      flex-direction: column;
      justify-content: center;
      flex-wrap: wrap;
    }
  }
}
</style>
<script setup lang="ts">
</script>