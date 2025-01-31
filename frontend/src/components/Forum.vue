<template>
  <v-template v-if="currentTopic">
    <div class="forum">
      <div class="topic">
        <div  v-if="currentTopic" class="topic--container">
          <div class="topic--header">
            <h1>{{ currentTopic.title }}</h1>
            <p v-if="currentTopic.subtitle">{{ currentTopic.subtitle }}</p>
            <span class="badge" v-if="currentTopic.category?.name">
              {{ currentTopic.category.name }}
            </span>
          </div>
          <hr />
          <div class="topic--content">
            <img v-if="currentTopic.image" alt="Topic Image" :src="getImageUrl(currentTopic.image)"/>
            <div
                class="topic--content-dinamic"
                v-if="currentTopic.content"
                v-html="currentTopic.content"
            ></div>
          </div>
          <div class="topic--footer" v-if="currentTopic.user">
            <small>Por: {{ currentTopic.user.name }}</small>
            <small>Publicado em: {{ currentTopic.getFormattedDate() }}</small>
          </div>
        </div>
        <div class="topics-list" v-if="filteredTopics">
          <h1>
            Outros tópicos
          </h1>
          <card-base
              v-for="(topic, index) in filteredTopics"
              :key="index"
          >
            <template #content-img>
              <img
                  v-if="topic.image"
                  alt="conteudo"
                  :src="getImageUrl(topic.image)"
              >
            </template>
            <template #content-text>
              <h2>{{ topic.title }}</h2>
              <p v-if="topic.subtitle">{{ topic.subtitle }}</p>
            </template>
            <template #content-author>
              <img v-if="topic.image" alt="autor" :src="getImageUrl(topic.image)">
            </template>
            <template #content-author-details>
              <span v-if="topic.user?.name">por {{ topic.user.name }}</span>
            </template>
          </card-base>
        </div>
      </div>
      <div class="posts">
        <div class="topics-list" v-if="filteredTopics">
          <h2>
            Tópicos Recentes
          </h2>
          <card-base
              class="topics-list--card"
              v-for="(topic, index) in filteredTopics"
              :key="index"
          >
            <template #content-text>
              <h3>{{ topic.title }}</h3>
              <p v-if="topic.subtitle">{{ topic.subtitle }}</p>
            </template>
            <template #content-author>
              <img v-if="topic.image" alt="autor" :src="getImageUrl(topic.image)">
            </template>
            <template #content-author-details>
              <span v-if="topic.user?.name">por {{ topic.user.name }}</span>
            </template>
          </card-base>
        </div>
      </div>
    </div>
  </v-template>
</template>

<script setup lang="ts">
import CardBase from "@/components/ui/CardBase.vue";
import VTemplate from "@/components/ui/VTemplate.vue";
import { ref, onMounted, watchEffect, computed } from 'vue';
import { topicStore } from "@/stores/topicStore.ts";
import { useRoute, useRouter } from 'vue-router';
import { storeToRefs } from "pinia";
import Noticies from "@/components/Noticies.vue";

const store = topicStore();
const { topics } = storeToRefs(store);

const currentTopic = computed(() => topics.value[0]);
const filteredTopics = computed(() => topics.value.slice(1));

onMounted(async () => {
  await store.fetchTopics();
  console.log("TOPICOS",topics);
});

const getImageUrl = (name: string) => {
  return new URL(`/src/assets/img/${name}`, import.meta.url).href;
}
</script>

<style lang="scss">
.forum {
  padding: 2rem;
  gap: 30px;
  display: flex;
  align-items: anchor-center;

  @media (max-width: 480px) {
    padding: inherit;
  }

  @media (max-width: 768px) {
    flex-direction: column;
    align-items: flex-start;
  }

  .card.card-base {
    gap: 0;
  }

  .card-base--item-text {
    text-align: left;
  }

  .card-base--item-author {
    justify-content: flex-start;
    text-align: start;
  }

  .topic {
    display: flex;
    flex-direction: column;
    flex: 1 1 70%;
    @media (max-width: 768px) {
      flex: 1 1 100%;
    }
    &--container {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      flex-direction: column;
    }

    &--header {
      display: flex;
      flex-direction: column;
      border-bottom: 1px solid var(--vt-c-white-mute);
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      width: 100%;
      h1 {
        font-size: 35px;

        @media (max-width: 480px) {
          font-size: revert;
        }
      }
    }

    &--content-dinamic {
      gap: 20px !important;
      color: var(--vt-c-text-dark-3) !important;
    }

    &--content {
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--vt-c-white-mute);
      img {
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
        flex: 1 1 100%;
        min-width: 400px;
        width: 100%;
        @media (max-width: 768px) {
          min-width: auto;
        }
      }
    }

    &--footer {
      display: flex;
      flex-direction: column;
      color: var(--vt-c-text-dark-3);
    }

    .topics-list {
      margin-top: 2rem;
    }
  }

  .posts {
    display: flex;
    flex: 1 1 30%;
    @media (max-width: 768px) {
      width: 100%;
      flex: 1 1 100%;
    }
  }

  .topics-list {
    gap: 1rem;
    @media (max-width: 768px) {
      display: flex;
      flex: 1;
      flex-direction: column;
    }
  }

  .badge {
    font-size: 10px;
    color: var(--vt-c-text-brand-1);
  }

  p {
    word-break: break-word;
    color: var(--vt-c-text-dark-3);
  }

  h1,h2,h3 {
    word-break: break-word;
    margin-bottom: 0.5rem;
    color: var(--vt-c-text-dark-4);
  }
}
</style>
