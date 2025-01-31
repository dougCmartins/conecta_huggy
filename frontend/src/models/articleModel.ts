import { UserModel } from "@/models/userModel.ts";
import { CommentModel } from "@/models/commentModel.ts";
import { CategoryModel } from "@/models/categoryModel.ts";
export class ArticleModel {
    constructor(
        public author: UserModel,
        public categories: Array<CategoryModel>,
        public comments: Array<CommentModel>,
        public title: string,
        public content: string,
        public published: boolean,
        public created_at: string,
        public subtitle?: string,
        public image?: string,
    ) {
    }

    static fromObject(data: any): ArticleModel {
        let categories = data?.categories?.map((i: CategoryModel) => {
            return CategoryModel.fromObject(i)
        }) || [];

        let comments = data?.comments?.map((i: CommentModel) => {
            return CommentModel.fromObject(i)
        }) || [];

        return new ArticleModel(
            UserModel.fromObject(data.author || []),
            categories,
            comments,
            data.title || "",
            data.content || "",
            data.published || false,
            data.created_at || "",
            data.subtitle || "",
            data.image || ""
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