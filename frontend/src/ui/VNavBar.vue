<template>
  <nav class="nav-content">
    <div class="nav-content--img">
      <a href="/" @click.prevent="router.push({ name: 'home' })">
        <picture>
          <source srcset="@/assets/img/simbolo.svg" media="(max-width: 768px)" />
          <img src="@/assets/img/logo.svg" alt="Conecta Huggy" />
        </picture>
      </a>
    </div>
    <ul class="nav-content--list">
      <li class="nav-content--list-item" :key="key" v-for="(listItem, key) of listItems">
        <button
          v-if="listItem.type === 'button'"
          type="button"
          class="nav-content--list-item-link"
          @click="handleItemAction(listItem)"
        >
          {{ listItem.title }}
        </button>
        <router-link
          v-else
          class="nav-content--list-item-link"
          :to="{ name: listItem.link }"
          :aria-current="route.name === listItem.link ? 'page' : undefined"
        >
          {{ listItem.title }}
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { authStore } from "@/Auth/authStore.ts";
import { useRoute, useRouter } from 'vue-router';
import { ActionRoute } from '@/router/ActionRoute.ts'

type ListItem = {
  title: string;
  link: string;
  type: 'link' | 'button';
}

const listItems = ref<ListItem[]>([
  {
    title: "Fórum",
    link: "forum",
    type: "link"
  },
  {
    title: "Artigos",
    link: "articles",
    type: "link"
  },
  {
    title: "Conteúdos",
    link: "content",
    type: "link"
  },
  {
    title: "Preferências",
    link: "preference",
    type: "link"
  },
  {
    title: "Sair",
    link: "",
    type: "button"
  }
]);

const auth = authStore();
const route = useRoute();
const router = useRouter();
const handleLogout = () => {
  auth.clearToken();
  router.push({ name: 'login', params: { action: ActionRoute.access }});
};

const handleItemAction = (item: ListItem) => {
  if (item.type === 'button') {
    handleLogout()
  }
}
</script>

<style scoped lang="scss">
.nav-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;

  @media (max-width: 480px) {
    flex-direction: column;
    justify-content: center;
  }

  span {
    color: var(--vt-c-text-dark-4);
  }

  width: min(var(--content-width), 100%);
  margin-inline: auto;
  padding-inline: var(--space-48);

  @media (max-width: 768px) {
    padding-inline: var(--space-24);
  }

  &--img {
    display: flex;
    justify-content: flex-start;
    a {
      display: inline-flex;
      align-items: center;
      min-height: 44px;
    }
    @media (max-width: 480px) {
      justify-content: center;
      margin-bottom: var(--space-8);
    }
    img {
      display: block;
      height: 23px;
      width: auto;
      max-width: none;
    }
  }

  &--list {
    display: inline-flex;
    align-items: center;
    justify-content: flex-end;
    gap: var(--space-8);
    list-style: none;
    padding: 0;
    margin: 0;
    @media (max-width: 480px) {
      flex-wrap: wrap;
      justify-content: center;
    }

    &-item {
      color: var(--text-muted);
      &:hover {
        cursor: pointer;
        color: var(--vt-c-text-brand-1);
      }

      &-link {
        display: inline-flex;
        align-items: center;
        min-height: 44px;
        padding: var(--space-8) var(--space-12);
        border-radius: var(--radius-pill);
        color: var(--text-muted);
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        &:hover {
          color: var(--vt-c-text-brand-1);
        }

        &[aria-current="page"] {
          color: var(--text-primary);
          font-weight: 600;
        }
      }
    }
  }

  button.nav-content--list-item-link {
    background: none;
    border: 0;
    font: inherit;
    cursor: pointer;
  }
}
</style>