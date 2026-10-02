<template>
  <div class="login">
    <div class="login--content-form">
      <h1 class="wordmark">Conecta Huggy</h1>
      <form @submit.prevent="handleLogin">
        <div class="form">
          <div class="form-item" v-if="hasFormRegister">
            <label for="name">Nome:</label>
            <input type="text" v-model="name" id="name" required />
          </div>
          <div class="form-item">
            <label for="email">E-mail:</label>
            <input type="email" v-model="email" id="email" required />
          </div>
          <div class="form-item">
            <label for="password">Senha:</label>
            <input type="password" v-model="password" id="password" required />
          </div>
          <div class="form-item--button">
            <base-button type="submit" text="Entrar" variant="default" />
          </div>
          <p class="switch-account">
            Não tens conta?
            <router-link :to="{ name: 'register' }">Regista-te</router-link>
          </p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { authStore } from "@/Auth/authStore";
import { segmentStore } from "@/Segment/segmentStore";
import { userStore } from "@/User/userStore";
import { useRoute, useRouter } from 'vue-router';
import BaseButton from "@/ui/BaseButton.vue";
import { useToast } from "@/ui/useToast.ts";
import { ActionRoute } from '@/router/ActionRoute.ts'

const email = ref('');
const password = ref('');
const name = ref('');
const selectedSegments = ref<Array<{id: number}>>([]);

const auth = authStore();
const toast = useToast();

const useSegmentStore = segmentStore();
const useUserStore = userStore();

const route = useRoute();
const router = useRouter();

const action = route.params?.action;

const hasFormRegister = computed(() => { return action === ActionRoute.register });

onMounted(async () => {
  if (!hasFormRegister.value) return;
  await useSegmentStore.fetchSegments();
});

const handleLogin = async () => {
  if (!hasFormRegister.value) {
    try {
      await auth.login({ email: email.value, password: password.value });

      if (auth.isAuthenticated()) {
        await router.push({ name: 'home' });
      }
    } catch (error: unknown) {
      console.error(error);
      toast.error(auth.error || "Dados incorretos.");
    }
    return;
  }

  try {
    await useUserStore.create({
      email: email.value,
      password: password.value,
      name: name.value,
      segment_ids: selectedSegments.value.map(s => s.id),
    });
  } catch (error: unknown) {
    console.error(error);
    toast.error(useUserStore.error || "Dados incorretos.");
  }
};
</script>

<style scoped lang="scss">
.login {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: var(--page-gradient);

  h1 {
    color: var(--vt-c-text-dark-4);
  }

  &--content-form {
    background-color: var(--surface-card);
    padding: var(--space-32);
    border: 1px solid var(--border-soft);
    border-radius: var(--radius-card);
    box-shadow: var(--shadow-card);
    max-width: 420px;
    width: min(420px, calc(100% - var(--space-48)));
    margin: var(--space-48) var(--space-24);

  }

  .wordmark {
    margin: 0 0 var(--space-24);
    font-size: 28px;
    text-align: center;
    color: var(--text-primary);
  }

  .form {
    display: flex;
    flex-direction: column;
    gap: var(--space-24);

    &-item {
      display: flex;
      flex-direction: column;
      gap: var(--space-8);

      &--button {
        display: block;
        width: 100%;

        .base-button {
          width: 100%;
        }
      }
    }

    input, select {
      min-height: 44px;
      padding: var(--space-12) var(--space-16);
      border: 1px solid var(--border-soft);
      border-radius: var(--radius-field);
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
      font-family: 'Poppins', 'Source Sans Pro', sans-serif;
      color: var(--text-primary);
      overflow: hidden;

      &:focus,
      &:focus-visible {
        outline: none;
        border-color: var(--vt-c-text-brand-1);
      }
    }

    label {
      color: var(--text-primary);
      font-size: 14px;
      font-weight: 500;
    }
  }
}

.switch-account {
  margin: 0;
  text-align: center;
  color: var(--text-muted);
  font-size: 14px;

  a {
    color: var(--vt-c-text-brand-1);
    font-weight: 600;
  }
}
</style>