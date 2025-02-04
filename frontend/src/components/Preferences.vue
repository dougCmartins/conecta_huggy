<template>
  <v-template>
    <div class="login">
    <div class="login--content-form">
      <form @submit.prevent="updatePreferences">
        <div class="form">
          <div class="form-item">
            <label>Nome:</label>
            <input type="text" v-model="formValues.name" required />
          </div>
          <div class="form-item">
            <label>E-mail:</label>
            <input type="email" v-model="formValues.email" required />
          </div>
          <div class="form-item checkbox-container">
            <div class="checkbox-wrapper">
              <input type="checkbox" id="subscribed" :true-value="1" :false-value="0" v-model="formValues.subscribed" />
              <label>Ativar minha inscrição</label>
            </div>
          </div>
          <div class="form-item">
            <label for="segment">Seguimentos:</label>
            <multiselect
                v-model="formValues.selectedSegments"
                :options="segments"
                label="description"
                track-by="id"
                :multiple="true"
            >
            </multiselect>
          </div>
          <div class="form-item--button" v-if="formValues.name">
            <base-button
                type="submit"
                text="Salvar alterações"
                variant="default-outline"
            />
          </div>
          <p v-if="auth.error" class="error">{{ auth.error }}</p>
        </div>
      </form>
    </div>
  </div>
  </v-template>
</template>

<script setup lang="ts">
import { ref, onMounted, watchEffect  } from 'vue';
import { authStore } from "@/stores/authStore";
import { segmentStore } from "@/stores/segmentStore";
import { userStore } from "@/stores/userStore";
import { useRouter } from 'vue-router';
import BaseButton from "@/components/ui/BaseButton.vue";
import { storeToRefs } from "pinia";
import Multiselect from 'vue-multiselect';
import VTemplate from "@/components/ui/VTemplate.vue";

const useUserStore = userStore();
const { user } = storeToRefs(useUserStore);

const useSegmentStore = segmentStore();
const { segments } = storeToRefs(useSegmentStore);

const auth = authStore();
const {error} = storeToRefs(auth)

const router = useRouter();

const formValues = ref({
  name: '',
  email: '',
  subscribed: false,
  selectedSegments: ref<Array<{id: number}>>([])
});

onMounted(async () => {
  if (!useUserStore.isLoaded) {
    try {
      await useUserStore.fetchUser();
    } catch (e: any) {
      console.error("Erro ao carregar preferêncis:", error);
    }
  } else {
    if (!formValues.value.subscribed) {
      alert('Ative novamente sua inscrição para acompanhar o nosso conteúdo!')
    }
  }

  await useSegmentStore.fetchSegments();
});

watchEffect(() => {
  if (user.value) {
    formValues.value = {
      name: user.value.name || '',
      email: user.value.email || '',
      subscribed: user.value.preference?.is_subscribed ?? 0,
      selectedSegments: user.value.preference?.segments ?? [],
    };
  }

  console.log("SEGNEBS", segments);
});

const updatePreferences = async () => {
  try {
    await useUserStore.syncUserPreference({
      name: formValues.value.name,
      email: formValues.value.email,
      preference: {
        is_subscribed: +formValues.value.subscribed,
        segment_ids: formValues.value.selectedSegments.map(s => s.id)
      }
    });

    await useUserStore.fetchUser();
    router.push({ name: 'home' });
  } catch (error) {
    console.error('Update failed:', error);
  }
};
</script>

<style scoped lang="scss">
.login {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
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

      &.checkbox-container {
        align-items: flex-start;
        justify-content: flex-start;
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

.checkbox-wrapper {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  width: 100%;
  input {
    width: auto !important;
  }
}

.error {
  color: red;
  margin-top: 10px;
  text-align: center;
}
</style>