<template>
  <button
      title="Elemento base para botão"
      :type="type"
      :class="classes"
      :disabled="disabled"
      @click="click"
  >
    <span>{{ text }}</span>
  </button>
</template>

<script setup lang="ts">
import { computed } from "vue";

const props = withDefaults(defineProps<{
  text?: string;
  type?: "button" | "submit";
  variant?: "default" | "default-outline" | "primary" | "primary-outline" | "brand" | "brand-outline";
  disabled?: boolean;
}>(), {
  text: "Click",
  type: "button",
  variant: "default",
  disabled: false,
});

const emit = defineEmits<{
  click: [event: MouseEvent];
}>();

const click = (event: MouseEvent) => {
  if (!props.disabled) {
    emit("click", event);
  }
};

const classes = computed(() => [
  "base-button",
  `base-button--${props.variant}`,
  { "base-button--disabled": props.disabled },
]);
</script>

<style scoped lang="scss">
.base-button {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  border-radius: 50px;
  font-family: 'Poppins', 'Source Sans Pro', sans-serif;
  font-style: normal;
  font-weight: 500;
  line-height: 15px;
  padding: 10px 20px;
  border: 1px solid transparent;
  cursor: pointer;
  transition: background-color 0.3s, border-color 0.3s, opacity 0.3s;
  white-space: nowrap;
  font-size: 14px;

  &--primary {
    background-color: var(--vt-primary);
    color: white;

    &:hover:not(:disabled) {
      background-color: var(--vt-primary);
    }
  }

  &--primary-outline {
    background-color: transparent;
    border-color: var(--vt-primary);
    color: var(--vt-primary);

    &:hover:not(:disabled) {
      background-color: var(--vt-primary);
      color: white;
    }
  }

  &--default {
    background-color: var(--vt-c-text-brand-1);
    color: white;

    &:hover:not(:disabled) {
      background-color: var(--vt-c-text-brand-1);
    }
  }

  &--default-outline {
    background-color: transparent;
    border-color: var(--vt-c-text-brand-1);
    color: var(--vt-c-text-brand-1);

    &:hover:not(:disabled) {
      background-color: var(--vt-c-text-brand-1);
      color: white;
    }
  }

  &--brand {
    background-color: var(--vt-c-text-brand-2);
    color: white;

    &:hover:not(:disabled) {
      background-color: var(--vt-c-text-brand-2);
    }
  }

  &--brand-outline {
    background-color: transparent;
    border-color: var(--vt-c-text-brand-2);
    color: var(--vt-c-text-brand-2);

    &:hover:not(:disabled) {
      background-color: var(--vt-c-text-brand-2);
      color: white;
    }
  }

  &--disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
}
</style>