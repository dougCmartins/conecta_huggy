import { defineStore } from "pinia";
import axios from 'axios';
import { ArticleModel } from "@/Content/articleModel.ts";
import client from "@/router/client.ts";
export const articleStore = defineStore('article', {
    state: () => ({
        articles: [] as Array<ArticleModel>,
        error: '' as string,
        loading: false,
    }),

    actions: {
        async fetchArticles(page = 1): Promise<void> {
            if (this.articles.length === 0) {
                this.loading = true;
            }

            try {
                const response = await axios.get(`${client("articles")}?page=${page}&perPage=7`);
                this.articles = response.data.map((item: any) => ArticleModel.fromObject(item));
                this.error = '';
            } catch (error: any) {
                this.error = error.message || "Não foi possível carregar os artigos";
                console.error('Erro ao buscar artigos:', error);
            } finally {
                this.loading = false;
            }
        },
    },
});