<template>
  <div class="login">
    <div class="login--content-form">
      <div class="login--content-form-text">
        <img src="../assets/img/simbolo.svg" :alt="`image login}`">
      </div>
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
            <base-button type="submit" text="Entrar" variant="default-outline" />
          </div>
          <p v-if="auth.error" class="error">{{ auth.error }}</p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { authStore } from "@/stores/authStore";
import { segmentStore } from "@/stores/segmentStore";
import { userStore } from "@/stores/userStore";
import { useRoute, useRouter } from 'vue-router';
import BaseButton from "@/components/ui/BaseButton.vue";
import { storeToRefs } from "pinia";
import { ActionRoute } from '@/enums/ActionRoute.ts'

const email = ref('');
const password = ref('');
const name = ref('');
const selectedSegments = ref<Array<{id: number}>>([]);

const auth = authStore();
const {token, error} = storeToRefs(auth)

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
  try {
    let credentials: any = { email: email.value, password: password.value }
    if (!hasFormRegister.value) {
      await auth.login(credentials);

      if (auth.isAuthenticated()) {
        router.push({ name: 'home' });
      }
      return;
    }

    credentials = {
      ...credentials,
      name: name.value,
      segment_ids: selectedSegments.value.map(s => s.id)
    }

    await useUserStore.create(credentials)
  } catch (error: any) {
    console.error(error.message);
    alert(`Erro ao fazer login: ${error.message}`);
  } finally {
    await router.push({name: 'home'});
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
  background: url("@/assets/img/background-1.jpg") center center no-repeat;
  background-size: cover;

  h1 {
    color: var(--vt-c-text-dark-4);
  }

  &--content-form {
    background-color: var(--vt-c-white);
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.3);
    max-width: 400px;
    width: 100%;
    margin: 3rem;

    &-text {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 4px;
      margin-bottom: 10px;

      img {
        width: 100%;
        height: auto;
        max-width: 30px;
        object-fit: cover;
      }
    }
  }

  .form {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;

    &-item {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;

      &--button {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 1rem;
        padding-top: 2rem;
        border-top: 1px solid var(--vt-c-text-light-3)
      }
    }

    input, select {
      padding: 0.75rem;
      border: 1px solid var(--vt-c-text-light-3);
      border-radius: 8px;
      font-size: 12px;
      width: 100%;
      box-sizing: border-box;
      font-family: 'Poppins', 'Source Sans Pro', sans-serif;
      color: var(--vt-c-text-dark-3);
      overflow: hidden;

      &:focus {
        outline: none;
        border-color: var(--vt-primary);
      }
    }

    label {
      color: var(--vt-c-text-dark-3);
      font-weight: 500;
    }
  }
}

.error {
  color: red;
  margin-top: 10px;
  text-align: center;
}
</style>