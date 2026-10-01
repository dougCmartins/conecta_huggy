export class TopicModel {
    constructor(
        public id: number,
        public title: string,
        public content: string,
        public is_closed: boolean,
        public created_at: string,
        public authorName: string,
        public categoryName: string,
        public subtitle?: string,
        public image?: string,
    ) {
    }

    static fromObject(data: {
        id?: number;
        title?: string;
        content?: string;
        is_closed?: boolean;
        created_at?: string;
        author_name?: string;
        category_name?: string;
        subtitle?: string;
        image?: string;
    }): TopicModel {
        return new TopicModel(
            data.id || 0,
            data.title || "",
            data.content || "",
            data.is_closed || false,
            data.created_at || "",
            data.author_name || "",
            data.category_name || "",
            data.subtitle || "",
            data.image || "",
        )
    }

    getFormattedDate(): string {
        return new Date(this.created_at).toLocaleDateString("pt-BR", {
            day: "2-digit",
            month: "long",
            year: "numeric"
        });
    }
}
