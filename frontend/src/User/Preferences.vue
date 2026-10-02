<template>
  <div class="login">
    <div class="login--content-form">
      <h1 class="visually-hidden">Preferências</h1>
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
                placeholder="Selecione um ou mais seguimentos"
            >
            </multiselect>
          </div>
          <div class="form-item--button" v-if="formValues.name">
            <base-button
                type="submit"
                text="Salvar alterações"
                variant="default"
            />
          </div>
          <p v-if="auth.error" class="error">{{ auth.error }}</p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watchEffect  } from 'vue';
import { authStore } from "@/Auth/authStore";
import { segmentStore } from "@/Segment/segmentStore";
import { userStore } from "@/User/userStore";
import { useRouter } from 'vue-router';
import BaseButton from "@/ui/BaseButton.vue";
import { storeToRefs } from "pinia";
import Multiselect from 'vue-multiselect';

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
      subscribed: user.value.is_subscribed ? 1 : 0,
      selectedSegments: segments.value.filter((segment) =>
        user.value.segment_ids.includes(segment.id)
      ),
    };
  }
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
    background-color: var(--surface-card);
    padding: var(--space-32);
    border: 1px solid var(--border-soft);
    border-radius: var(--radius-card);
    box-shadow: var(--shadow-card);
    max-width: 420px;
    width: min(420px, calc(100% - var(--space-48)));
    margin: var(--space-48) auto;

    &-text {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: var(--space-8);
      margin-bottom: var(--space-16);
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

      &.checkbox-container {
        align-items: flex-start;
        justify-content: flex-start;
      }
    }

    input:not([type="checkbox"]), select {
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

.checkbox-wrapper {
  display: inline-flex;
  align-items: center;
  gap: var(--space-8);
  width: 100%;
  input {
    width: auto !important;
  }
}

.visually-hidden {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

.error {
  color: var(--color-error);
  margin: 0;
  text-align: center;
}
</style>