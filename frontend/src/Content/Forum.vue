<template>
  <div class="page-state" :aria-busy="isLoading ? 'true' : 'false'">
    <content-skeleton v-if="isLoading" variant="forum" />
    <p v-else-if="error && !topics.length" class="notice notice--error" role="alert">{{ error }}</p>
    <p v-else-if="!currentTopic" class="notice">Ainda não há tópicos.</p>
    <div v-else class="forum">
      <article class="topic">
        <h1>{{ currentTopic.title }}</h1>
        <div class="kicker">
          <p v-if="currentTopic.subtitle">{{ currentTopic.subtitle }}</p>
          <p v-if="currentTopic.categoryName" class="category">{{ currentTopic.categoryName }}</p>
        </div>
        <div class="cover" :aria-hidden="coverImage ? undefined : true">
          <img v-if="coverImage" :src="coverImage" :alt="currentTopic.title">
          <span v-else class="ui-disc">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="4" y="5" width="16" height="14" rx="2" />
              <path d="M8 15.5 11 11l2 2 1.5-1.5L18 15.5" />
            </svg>
          </span>
        </div>
        <div class="body-copy" v-if="currentTopic.content" v-html="currentTopic.content"></div>
        <p class="byline" v-if="currentTopic.authorName">
          <span class="ui-disc ui-disc--sm" aria-hidden="true">{{ initial(currentTopic.authorName) }}</span>
          <span>
            <span>Por: {{ currentTopic.authorName }}</span>
            <span>Publicado em: {{ currentTopic.getFormattedDate() }}</span>
          </span>
        </p>

        <section v-if="filteredTopics.length" aria-labelledby="outros">
          <h2 class="section-title" id="outros">Outros tópicos</h2>
          <card-base v-for="(topic, index) in filteredTopics" :key="index">
            <template #content-img>
              <img
                v-if="topicImage(topic.title)"
                :src="topicImage(topic.title)"
                :alt="topic.title"
              >
              <span v-else class="ui-disc ui-disc--sm ui-disc--veil" aria-hidden="true">{{ initial(topic.authorName) }}</span>
            </template>
            <template #content-text>
              <h3>{{ topic.title }}</h3>
              <p v-if="topic.subtitle">{{ topic.subtitle }}</p>
            </template>
            <template #content-author>
              <span class="ui-disc ui-disc--sm ui-disc--veil" aria-hidden="true">{{ initial(topic.authorName) }}</span>
            </template>
            <template #content-author-details>
              <span v-if="topic.authorName">por {{ topic.authorName }}</span>
            </template>
          </card-base>
        </section>
      </article>

      <aside class="posts" v-if="filteredTopics.length" aria-labelledby="recentes">
        <h2 class="section-title" id="recentes">Tópicos Recentes</h2>
        <card-base v-for="(topic, index) in filteredTopics" :key="index">
          <template #content-text>
            <h3>{{ topic.title }}</h3>
            <p v-if="topic.subtitle">{{ topic.subtitle }}</p>
          </template>
          <template #content-author>
            <span class="ui-disc ui-disc--sm ui-disc--dark" aria-hidden="true">{{ initial(topic.authorName) }}</span>
          </template>
          <template #content-author-details>
            <span v-if="topic.authorName">por {{ topic.authorName }}</span>
          </template>
        </card-base>
      </aside>
    </div>
  </div>
</template>

<script setup lang="ts">
import CardBase from "@/ui/CardBase.vue";
import ContentSkeleton from "@/ui/ContentSkeleton.vue";
import { computed } from 'vue';
import { topicStore } from "@/Content/topicStore.ts";
import { storeToRefs } from "pinia";
import digitalCover from "@/assets/img/digital.jpg";

const store = topicStore();
const { topics, loading, error } = storeToRefs(store);

const currentTopic = computed(() => topics.value[0]);
const filteredTopics = computed(() => topics.value.slice(1));
const isLoading = computed(() => loading.value && topics.value.length === 0);

store.fetchTopics();

const initial = (name?: string) => name?.trim().charAt(0).toUpperCase() || "";

const topicImage = (title?: string) =>
  title === "Estratégias para Retenção de Clientes" ? digitalCover : "";

const coverImage = computed(() => topicImage(currentTopic.value?.title));
</script>

<style scoped lang="scss">
.notice {
  margin: 0;
  padding: var(--space-32);
  border: 1px solid var(--border-soft);
  border-radius: var(--radius-card);
  background: var(--surface-card);
}

.notice--error {
  border-color: var(--color-error);
  color: var(--color-error);
}

.forum {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 320px;
  gap: var(--space-48);
  align-items: start;

  @media (max-width: 768px) {
    grid-template-columns: 1fr;
  }
}

.topic h1,
.section-title {
  margin: 0 0 var(--space-12);
  font-size: 32px;
}

.kicker {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-12);
  align-items: center;
  margin-bottom: var(--space-24);

  p {
    margin: 0;
    color: var(--text-muted);
  }
}

.category {
  color: var(--vt-c-text-brand-1);
  font-size: 13px;
  font-weight: 600;
}

.cover {
  display: grid;
  place-items: center;
  min-height: 220px;
  margin-bottom: var(--space-24);
  border-radius: var(--radius-card);
  background: var(--surface);
  border: 1px solid var(--border-soft);
  overflow: hidden;

  img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    display: block;
  }
}

.body-copy {
  color: var(--text-muted);
  margin-bottom: var(--space-24);
}

.byline {
  display: flex;
  align-items: center;
  gap: var(--space-12);
  margin: 0 0 var(--space-48);

  span span {
    display: block;
    color: var(--text-muted);
    font-size: 14px;
  }
}

.posts {
  display: flex;
  flex-direction: column;
  gap: var(--space-24);
}

:deep(.card-base--item-text) {
  text-align: left;
}

:deep(.card-base--item-author) {
  justify-content: flex-start;
}
</style>
