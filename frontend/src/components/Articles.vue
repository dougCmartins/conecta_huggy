<template>
  <v-template v-if="currentArticle">
    <div class="articles">
      <div class="forum">
        <div class="forum--topic">
          <div class="forum--article-container">
            <div class="welcome-item--presentation">
              <div class="welcome-item--presentation-img">
                <img v-if="currentArticle.image" alt="article image" :src="getImageUrl(currentArticle.image)"/>
              </div>
              <div class="welcome-item--presentation-text">
                <h1>{{ currentArticle.title }}</h1>
                <p v-if="currentArticle.subtitle">{{ currentArticle.subtitle }}</p>
              </div>
            </div>
            <div>
              <div
                  class="forum--article-content-dinamic"
                  v-if="currentArticle.content"
                  v-html="currentArticle.content"
              ></div>
              <div class="forum--article-footer" v-if="currentArticle.author">
                <small>Por: {{ currentArticle.author.name }}</small>
              </div>
            </div>
          </div>
          <div class="forum--article-related">
            <h1>
              Artigos relacionados
            </h1>
            <div class="forum--article-related-list" v-if="filteredArticles">
              <card-base
                  v-for="(article, index) in filteredArticles"
                  :key="index"
              >
                <template #content-img>
                  <img
                      v-if="article.image"
                      alt="conteudo"
                      :src="getImageUrl(article.image)"
                  >
                </template>
                <template #content-text>
                  <h2>{{ article.title }}</h2>
                  <p v-if="article.subtitle">{{ article.subtitle }}</p>
                </template>
              </card-base>
            </div>
          </div>
        </div>
      </div>
      <div class="forum--article-content-noticies">
        <img alt="conteudo" src="@/assets/img/banner.png">
        <noticies></noticies>
      </div>
    </div>
  </v-template>
</template>

<script setup lang="ts">
import CardBase from "@/components/ui/CardBase.vue";
import VTemplate from "@/components/ui/VTemplate.vue";
import { ref, onMounted, watchEffect, computed } from 'vue';
import { articleStore } from "@/stores/articleStore.ts";
import { storeToRefs } from "pinia";
import Noticies from "@/components/Noticies.vue";

const store = articleStore();
const { articles } = storeToRefs(store)

const currentArticle = computed(() => articles.value[0]);
const filteredArticles = computed(() => articles.value.slice(1));

onMounted(async () => {
  await store.fetchArticles();
});

const getImageUrl = (name: string) => {
  return new URL(`/src/assets/img/${name}`, import.meta.url).href;
}
</script>

<style scoped lang="scss">
.welcome-item--presentation-img {
  @media (max-width: 768px) {
    width: 100%;
    max-width: 100%;
  }
}

.welcome-item--presentation-text {
  @media (max-width: 768px) {
    align-items: center;
    text-align: center;
  }
}
.articles {
  padding: 2rem;
  gap: 2rem;
  display: flex;
  flex-direction: column;
}

.forum {
  display: flex;
  align-items: anchor-center;

  &--topic {
    display: flex;
    flex-direction: column;
    gap: 2rem;
  }

  @media (max-width: 480px) {
    padding: inherit;
  }

  @media (max-width: 768px) {
    padding: 0;
    flex-direction: column;
    align-items: center;
  }

  &--article {
    display: flex;
    flex-direction: column;
    flex: 1 1 70%;
    @media (max-width: 768px) {
      flex: 1 1 100%;
    }
    &-container {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-direction: column;
    }

    &-header {
      display: flex;
      flex-direction: column;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    &-content-dinamic {
      color: var(--vt-c-text-dark-3) !important;
      @media (max-width: 768px) {
        text-align: center;
      }
    }

    &-content {
      display: flex;
      gap: 1rem;
      align-items: center;
      @media (max-width: 768px) {
        flex-direction: column;
        text-align: center;
      }
      &-img {
        flex: 1 1 60%;
        position: relative;
        min-width: 300px;
        display: flex;
        width: 100%;

        @media (max-width: 768px) {
          flex: 1 1 100%;
          min-width: auto;
          width: 80%;
          max-width: 400px;
          justify-content: center;
        }
      }

      &-text {
        flex: 1 1 40%;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;

        @media (max-width: 768px) {
          flex: 1 1 100%;
          min-width: auto;
          align-items: center;
        }
      }

      img {
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
        flex: 1 1 100%;
        min-width: 400px;
        width: 100%;
        max-width: 80%;
        @media (max-width: 768px) {
          min-width: auto;
        }
      }
      &-noticies {
        display: flex;
        flex-direction: column;
        gap: 2rem;

        img {
          margin-top: 2rem;
          margin-bottom: 2rem;
        }
      }
    }

    &-footer {
      display: flex;
      flex-direction: column;
      color: var(--vt-c-text-dark-3);

      @media (max-width: 768px) {
        text-align: center;
      }
    }

    &-related {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      @media (max-width: 768px) {
        text-align: center;
      }
      &-list {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: flex-start;

        .card {
          flex: 1 1 300px;
          max-width: calc(33.33% - 2rem);
          min-width: 300px;
          text-align: center;

          @media (max-width: 768px) {
            flex: 1 1 100%;
            max-width: 100%;
            min-width: auto;
            margin: 0 10px;
          };
        }

        @media (max-width: 768px) {
          flex-direction: column;
          gap: 1rem;
          img {
            height: auto;
          }
        }
      }
    }
  }
}

.posts {
  display: flex;
  flex: 1 1 30%;
  @media (max-width: 768px) {
    flex: 1 1 100%;
  }
}

.badge {
  font-size: 10px;
  color: var(--vt-c-text-brand-1);
}

.noticies {
  display: flex;
  justify-content: flex-end;
  @media (max-width: 768px) {
    justify-content: center;
    align-items: center;
  }
}

p {
  color: var(--vt-c-text-dark-3);
}

h1,h2,h3 {
  margin-bottom: 0.5rem;
  color: var(--vt-c-text-dark-4);
}
</style>
