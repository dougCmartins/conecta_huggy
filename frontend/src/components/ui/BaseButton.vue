<template>
  <button
      title="Elemento base para botão"
      :class="classes"
      :disabled="disabled"
      @click="click"
  >
    <span>{{ text }}</span>
  </button>
</template>

<script lang="ts">
import type { PropType } from "vue";

export default {
  name: "BaseButton",
  props: {
    text: {
      type: String,
      default: "Click",
    },
    type: {
      type: String as PropType<"button" | "submit">,
      default: "button",
    },
    variant: {
      type: String as PropType<"default" | "default-outline" | "primary" | "primary-outline" | "brand" | "brand-outline">,
      default: "default",
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  emits: ["click"],
  methods: {
    click(event: any) {
      console.log('clicou');
      if (!this.disabled) {
        this.$emit("click", event);
      }
    },
  },
  computed: {
    classes() {
      return [
        "base-button",
        `base-button--${this.variant}`,
        { "base-button--disabled": this.disabled },
      ];
    },
  },
};
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