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
  gap: var(--space-32);
  flex: 1 1 100%;

  &--details {
    margin-left: var(--space-16);
  }
}
</style>