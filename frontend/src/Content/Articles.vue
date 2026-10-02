<template>
  <div class="page-state" :aria-busy="isLoading ? 'true' : 'false'">
    <content-skeleton v-if="isLoading" variant="reading" />
    <p v-else-if="error && !articles.length" class="notice notice--error" role="alert">{{ error }}</p>
    <p v-else-if="!currentArticle" class="notice">Ainda não há artigos.</p>
    <article v-else class="reading">
      <nav aria-label="Percurso">
        <ol class="crumbs">
          <li><router-link :to="{ name: 'forum' }">Fórum</router-link></li>
          <li aria-hidden="true">/</li>
          <li aria-current="page">Artigo</li>
        </ol>
      </nav>

      <h1>{{ currentArticle.title }}</h1>
      <p class="meta">
        <span v-if="currentArticle.authorName">Por: {{ currentArticle.authorName }}</span>
        <span>Publicado em: {{ currentArticle.getFormattedDate() }}</span>
        <span>Leitura: {{ readingLabel }}</span>
      </p>

      <div class="cover" :aria-hidden="coverImage ? undefined : true">
        <img v-if="coverImage" :src="coverImage" :alt="currentArticle.title">
        <span v-else class="ui-disc">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="5" width="16" height="14" rx="2" />
            <path d="M8 15.5 11 11l2 2 1.5-1.5L18 15.5" />
          </svg>
        </span>
      </div>

      <div class="prose">
        <p v-if="currentArticle.subtitle">{{ currentArticle.subtitle }}</p>
        <div v-if="currentArticle.content" v-html="currentArticle.content"></div>
      </div>

      <section class="author" v-if="currentArticle.authorName" aria-label="Autora">
        <span class="ui-disc ui-disc--sm" aria-hidden="true">{{ initial(currentArticle.authorName) }}</span>
        <div>
          <p>{{ currentArticle.authorName }}</p>
          <small>Por: {{ currentArticle.authorName }}</small>
        </div>
      </section>

      <section class="related" v-if="filteredArticles.length" aria-labelledby="relacionados">
        <h2 id="relacionados">Artigos relacionados</h2>
        <card-base v-for="(article, index) in filteredArticles" :key="index">
          <template #content-img>
            <img
              v-if="articleImage(article.title)"
              :src="articleImage(article.title)"
              :alt="article.title"
            >
            <span v-else class="ui-disc ui-disc--sm" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="4" y="5" width="16" height="14" rx="2" />
                <path d="M8 15.5 11 11l2 2 1.5-1.5L18 15.5" />
              </svg>
            </span>
          </template>
          <template #content-text>
            <h3>{{ article.title }}</h3>
            <p v-if="article.subtitle">{{ article.subtitle }}</p>
          </template>
        </card-base>
      </section>
    </article>
  </div>
</template>

<script setup lang="ts">
import CardBase from "@/ui/CardBase.vue";
import ContentSkeleton from "@/ui/ContentSkeleton.vue";
import { computed } from 'vue';
import { articleStore } from "@/Content/articleStore.ts";
import { storeToRefs } from "pinia";
import insidesCover from "@/assets/img/insides.jpg";

const store = articleStore();
const { articles, loading, error } = storeToRefs(store)

const currentArticle = computed(() => articles.value[0]);
const filteredArticles = computed(() => articles.value.slice(1));
const isLoading = computed(() => loading.value && articles.value.length === 0);

store.fetchArticles();

const initial = (name?: string) => name?.trim().charAt(0).toUpperCase() || "";

const articleImage = (title?: string) =>
  title === "Como Encantar Clientes nas Vendas" ? insidesCover : "";

const coverImage = computed(() => articleImage(currentArticle.value?.title));

const readingLabel = computed(() => {
  const html = currentArticle.value?.content || "";
  const text = html.replace(/<[^>]+>/g, " ");
  const words = text.trim().split(/\s+/).filter(Boolean).length;
  if (words < 200) {
    return "menos de 1 min";
  }
  const minutes = Math.ceil(words / 200);
  return `${minutes} min`;
});
</script>

<style scoped lang="scss">
.notice {
  width: min(720px, 100%);
  margin: 0 auto;
  padding: var(--space-32);
  border: 1px solid var(--border-soft);
  border-radius: var(--radius-card);
  background: var(--surface-card);
}

.notice--error {
  border-color: var(--color-error);
  color: var(--color-error);
}

.reading {
  width: min(720px, 100%);
  margin-inline: auto;
}

.crumbs {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-8);
  margin: 0 0 var(--space-24);
  padding: 0;
  list-style: none;
  color: var(--text-muted);
  font-size: 14px;

  a {
    color: var(--vt-c-text-brand-1);
    font-weight: 600;
  }
}

h1 {
  margin: 0 0 var(--space-12);
  font-size: 32px;
}

.meta {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-16);
  margin: 0 0 var(--space-24);
  color: var(--text-muted);
  font-size: 14px;
}

.cover {
  display: grid;
  place-items: center;
  min-height: 220px;
  margin-bottom: var(--space-32);
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

.prose {
  color: var(--text-muted);
  margin-bottom: var(--space-32);

  :deep(h2) {
    margin: var(--space-24) 0 var(--space-12);
    font-size: 24px;
    color: var(--text-primary);
  }
}

.author {
  display: flex;
  align-items: center;
  gap: var(--space-12);
  margin-bottom: var(--space-48);

  p {
    margin: 0;
    font-weight: 600;
    color: var(--text-primary);
  }

  small {
    color: var(--text-muted);
  }
}

.related h2 {
  margin: 0 0 var(--space-24);
  font-size: 28px;
}

:deep(.card-base--item-text) {
  text-align: left;
}
</style>
