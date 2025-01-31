<template>
  <div class="welcome-item">
    <div class="welcome-item--details">
      <div>
        <slot name="heading"></slot>
      </div>
      <slot></slot>
    </div>
    <div class="welcome-item--icon">
      <slot name="icon"></slot>
    </div>
  </div>
</template>

<style lang="scss">
.welcome-item {
  display: flex;
  gap: 30px;
  flex: 1 1 100%;

  &--details {
    margin-left: 1rem;
  }
}
</style>