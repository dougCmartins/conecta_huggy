<template>
  <div class="login">
    <div class="login--content-form">
      <h1 class="wordmark">Conecta Huggy</h1>
      <form @submit.prevent="handleUpdate">
        <div class="form">
          <div class="form-item">
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
          <div class="form-item" v-if="segments">
            <label for="segment">Seguimentos de interesse:</label>
            <multiselect
                v-model="selectedSegments"
                :options="segments"
                :multiple="true"
                :close-on-select="false"
                label="description"
                track-by="id"
                placeholder="Selecione um ou mais seguimentos"
                required
            />
          </div>
          <div class="form-item--button">
            <base-button v-if="segments" type="submit" :text="formModule.button" variant="default" />
          </div>
          <p class="switch-account">
            Já tens conta?
            <router-link :to="{ name: 'login' }">Entra</router-link>
          </p>
          <p v-if="auth.error" class="error">{{ auth.error }}</p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref, computed, onMounted } from 'vue';
import { authStore } from "@/Auth/authStore";
import { segmentStore } from "@/Segment/segmentStore";
import { userStore } from "@/User/userStore";
import { useRouter } from 'vue-router';
import BaseButton from "@/ui/BaseButton.vue";
import { storeToRefs } from "pinia";
import Multiselect from 'vue-multiselect';

const email = ref('');
const password = ref('');
const name = ref('');
const selectedSegments = ref<Array<{id: number}>>([]);

const auth = authStore();

const useSegmentStore = segmentStore();
const { segments } = storeToRefs(useSegmentStore);

const useUserStore = userStore();

const router = useRouter();

const formModule = computed(() => {
  let item = { title: 'Registo', button: 'Registar' };
  return item
});

onMounted(async () => {
  await useSegmentStore.fetchSegments();
});

const handleUpdate = async () => {
  try {
    let credentials: any = { email: email.value, password: password.value }
    credentials = {
      ...credentials,
      name: name.value,
      segment_ids: selectedSegments.value.map(s => s.id)
    }

    await useUserStore.create(credentials)
  } catch (error: any) {
    console.error(error.message);
    alert(`Erro ao criar usuário: ${error.message}`);
  } finally {
    await router.push({name: 'login'});
  }
};
</script>

<style scoped lang="scss">
.login {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
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

      &:focus {
        outline: none;
        border-color: var(--vt-c-text-brand-1);
      }

      &:focus-visible {
        outline: 2px solid var(--vt-c-text-brand-1);
        outline-offset: 3px;
        border-color: var(--vt-c-text-brand-1);
      }
    }

    label {
      color: var(--text-primary);
      font-size: 14px;
      font-weight: 500;
    }

    :deep(.multiselect__tags) {
      min-height: 44px;
      padding: var(--space-8) var(--space-16);
      border: 1px solid var(--border-soft);
      border-radius: var(--radius-field);
      font-size: 16px;
    }

    :deep(.multiselect__input),
    :deep(.multiselect__single) {
      font-size: 16px;
      font-family: 'Poppins', 'Source Sans Pro', sans-serif;
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

.error {
  color: var(--color-error);
  margin: 0;
  text-align: center;
}
</style>