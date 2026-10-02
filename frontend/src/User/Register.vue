<template>
  <div class="login">
    <div class="login--content-form">
      <h1 class="wordmark">Conecta Huggy</h1>
      <form @submit="onSubmit">
        <div class="form">
          <div class="form-item">
            <label for="name">Nome:</label>
            <input
              type="text"
              v-model="name"
              v-bind="nameAttrs"
              id="name"
              :aria-invalid="errors.name ? true : undefined"
              :aria-describedby="errors.name ? 'name-error' : undefined"
            />
            <p v-if="errors.name" id="name-error" class="error" role="alert">{{ errors.name }}</p>
          </div>
          <div class="form-item">
            <label for="email">E-mail:</label>
            <input
              type="email"
              v-model="email"
              v-bind="emailAttrs"
              id="email"
              :aria-invalid="errors.email ? true : undefined"
              :aria-describedby="errors.email ? 'email-error' : undefined"
            />
            <p v-if="errors.email" id="email-error" class="error" role="alert">{{ errors.email }}</p>
          </div>
          <div class="form-item">
            <label for="password">Senha:</label>
            <input
              type="password"
              v-model="password"
              v-bind="passwordAttrs"
              id="password"
              :aria-invalid="errors.password ? true : undefined"
              :aria-describedby="errors.password ? 'password-error' : undefined"
            />
            <p v-if="errors.password" id="password-error" class="error" role="alert">{{ errors.password }}</p>
          </div>
          <div class="form-item" v-if="segments">
            <label for="segment">Seguimentos de interesse:</label>
            <multiselect
                v-model="segmentIds"
                v-bind="segmentIdsAttrs"
                :options="segments"
                :multiple="true"
                :close-on-select="false"
                label="description"
                track-by="id"
                placeholder="Selecione um ou mais seguimentos"
                :aria-invalid="errors.segment_ids ? true : undefined"
                :aria-describedby="errors.segment_ids ? 'segment-error' : undefined"
            />
            <p v-if="errors.segment_ids" id="segment-error" class="error" role="alert">{{ errors.segment_ids }}</p>
          </div>
          <div class="form-item--button">
            <base-button v-if="segments" type="submit" :text="formModule.button" variant="default" />
          </div>
          <p class="switch-account">
            Já tens conta?
            <router-link :to="{ name: 'login' }">Entra</router-link>
          </p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { useForm } from 'vee-validate';
import { segmentStore } from "@/Segment/segmentStore";
import { userStore } from "@/User/userStore";
import { useRouter } from 'vue-router';
import BaseButton from "@/ui/BaseButton.vue";
import { registerSchema } from "@/ui/formValidation.ts";
import { useToast } from "@/ui/useToast.ts";
import { storeToRefs } from "pinia";
import Multiselect from 'vue-multiselect';

type SegmentOption = { id: number };

const useUserStore = userStore();
const toast = useToast();

const useSegmentStore = segmentStore();
const { segments } = storeToRefs(useSegmentStore);

const router = useRouter();

const { errors, defineField, handleSubmit, setErrors } = useForm({
  validationSchema: registerSchema,
  initialValues: {
    name: '',
    email: '',
    password: '',
    segment_ids: [] as SegmentOption[],
  },
});

const [name, nameAttrs] = defineField('name');
const [email, emailAttrs] = defineField('email');
const [password, passwordAttrs] = defineField('password');
const [segmentIds, segmentIdsAttrs] = defineField('segment_ids');

const formModule = computed(() => {
  return { title: 'Registo', button: 'Registar' };
});

onMounted(async () => {
  await useSegmentStore.fetchSegments();
});

const onSubmit = handleSubmit(async (values) => {
  try {
    await useUserStore.create({
      name: values.name,
      email: values.email,
      password: values.password,
      segment_ids: values.segment_ids.map((segment) => segment.id),
    });
    await router.push({ name: 'login' });
  } catch (error: unknown) {
    console.error(error);
    if (Object.keys(useUserStore.fieldErrors).length > 0) {
      setErrors(useUserStore.fieldErrors);
      return;
    }

    toast.error(useUserStore.error);
  }
});
</script>

<style scoped lang="scss">
.login {
  display: flex;
  flex-direction: column;
  align-items: center;
  box-sizing: border-box;
  min-height: 100vh;
  min-height: 100dvh;
  padding-block: var(--space-48);
  padding-inline: var(--space-24);
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
    width: min(420px, 100%);
    margin-block: auto;
    margin-inline: auto;

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
  text-align: left;
  font-size: 14px;
}
</style>