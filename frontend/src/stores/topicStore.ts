import { defineStore } from "pinia";
import axios from 'axios';
import { TopicModel } from "@/models/topicModel.ts";
import client from "@/router/client.ts";

export const topicStore = defineStore('topic', {
    state: () => ({
        topics: [] as Array<TopicModel>,
        error: '' as string,
    }),

    actions: {
        async fetchTopics(page = 1): Promise<void> {
            try {
                const response = await axios.get(`${client("topics")}?page=${page}`);
                this.topics = response.data.data.map((item: any) => TopicModel.fromObject(item));
            } catch (error: any) {
                this.error = error.message || "Não foi possível carregar os tópicos";
                console.error('Erro ao buscar tópicos:', error);
            }
        },
    },
});