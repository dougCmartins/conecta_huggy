<template>
  <div class="login">
    <div class="login--content-form">
      <div class="login--content-form-text">
        <img src="../assets/img/simbolo.svg" :alt="`image ${formModule.title}`">
      </div>
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
            <base-button v-if="segments" type="submit" :text="formModule.button" variant="default-outline" />
          </div>
          <p v-if="auth.error" class="error">{{ auth.error }}</p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import {ref, computed, onMounted } from 'vue';
import { authStore } from "@/stores/authStore";
import { segmentStore } from "@/stores/segmentStore";
import { userStore } from "@/stores/userStore";
import { useRouter } from 'vue-router';
import BaseButton from "@/components/ui/BaseButton.vue";
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
  let item = { title: 'Registro', button: 'Registrar' };
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
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: url("@/assets/img/background-2.jpg") center center no-repeat;
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