import { defineStore } from "pinia";
import axios from 'axios';
import { TopicModel } from "@/Content/topicModel.ts";
import client from "@/router/client.ts";

export const topicStore = defineStore('topic', {
    state: () => ({
        topics: [] as Array<TopicModel>,
        error: '' as string,
        loading: false,
    }),

    actions: {
        async fetchTopics(page = 1): Promise<void> {
            if (this.topics.length === 0) {
                this.loading = true;
            }

            try {
                const response = await axios.get(`${client("topics")}?page=${page}`);
                this.topics = response.data.map((item: any) => TopicModel.fromObject(item));
                this.error = '';
            } catch (error: any) {
                this.error = error.message || "Não foi possível carregar os tópicos";
                console.error('Erro ao buscar tópicos:', error);
            } finally {
                this.loading = false;
            }
        },
    },
});