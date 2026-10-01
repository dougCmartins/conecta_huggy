export class ArticleModel {
    constructor(
        public id: number,
        public title: string,
        public content: string,
        public published: boolean,
        public created_at: string,
        public authorName: string,
        public subtitle?: string,
        public image?: string,
    ) {
    }

    static fromObject(data: {
        id?: number;
        title?: string;
        content?: string;
        published?: boolean;
        created_at?: string;
        author_name?: string;
        subtitle?: string;
        image?: string;
    }): ArticleModel {
        return new ArticleModel(
            data.id || 0,
            data.title || "",
            data.content || "",
            data.published || false,
            data.created_at || "",
            data.author_name || "",
            data.subtitle || "",
            data.image || "",
        )
    }

    isPublished(): boolean {
        return this.published;
    }

    getFormattedDate(): string {
        return new Date(this.created_at).toLocaleDateString("pt-BR", {
            day: "2-digit",
            month: "long",
            year: "numeric"
        });
    }
}
