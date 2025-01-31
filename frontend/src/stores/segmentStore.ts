import { defineStore } from "pinia";
import axios from 'axios';
import { SegmentModel } from "@/models/segmentModel.ts";

export const segmentStore = defineStore('segment', {
    state: () => ({
        segments: [] as Array<SegmentModel>,
        error: '' as string,
    }),

    actions: {
        async fetchSegments(): Promise<void> {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/segments');
                this.segments = response.data.map((item: any) => SegmentModel.fromObject(item));
            } catch (error: any) {
                this.error = error.message || "Não foi possível carregar os seguimentos";
                console.error('Erro ao buscar seguimentos:', error);
            }
        },
    },
});