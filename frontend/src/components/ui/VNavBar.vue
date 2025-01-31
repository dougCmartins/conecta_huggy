<template>
  <nav class="nav-content">
    <div class="nav-content--img">
      <a href="/home">
        <picture>
          <source srcset="@/assets/img/simbolo.svg" media="(max-width: 768px)" />
          <img src="@/assets/img/logo.svg" alt="Conecta Huggy logo" />
        </picture>
      </a>
    </div>
    <ul class="nav-content--list">
      <li class="nav-content--list-item" :key="key" v-for="(listItem, key) of listItems">
        <a class="nav-content--list-item-link"
           :href="listItem.type !== 'button' ? listItem.link : undefined"
           @click="handleItemAction(listItem)">
          {{ listItem.title }}
        </a>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { authStore } from "@/stores/authStore.ts";
import { useRouter } from 'vue-router';
import { ActionRoute } from '@/enums/ActionRoute.ts'

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
const router = useRouter();
const handleLogout = () => {
  auth.clearToken();
  router.push({ name: 'login', params: { action: ActionRoute.access }});
};

const handleItemAction = (item: ListItem) => {
  if (item.type === 'button') {
    handleLogout()
    return;
  }

  router.push({ name: item.link });
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

  &--img {
    display: flex;
    justify-content: flex-start;
    @media (max-width: 480px) {
      justify-content: center;
      margin-bottom: 10px;
    }
    img {
      max-width: 100px;
      max-height: 100px;
      width: 100%;
      height: 100%;

      @media (max-width: 768px) {
        max-width: 40px;
      }
    }
  }

  &--list {
    display: inline-flex;
    align-items: center;
    justify-content: flex-end;
    list-style: none;
    padding: 0;
    margin: 0;
    @media (max-width: 480px) {
      flex-wrap: wrap;
      justify-content: center;
    }

    &-item {
      color: var(--vt-c-text-dark-3);
      padding: 0 14px;
      @media (max-width: 480px) {
        padding: 0 4px;
      }
      &:hover {
        cursor: pointer;
        color: var(--vt-c-text-brand-1);
      }

      &-link {
        color: var(--vt-c-text-dark-3);
        &:hover {
          color: var(--vt-c-text-brand-2) !important;
        }

        text-decoration: none;
      }
    }
  }
}
</style>