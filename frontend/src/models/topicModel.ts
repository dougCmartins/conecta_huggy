import { UserModel } from "@/models/userModel.ts";
import { PostModel } from "@/models/postModel.ts";
import { CategoryModel } from "@/models/categoryModel.ts";

export class TopicModel {
    constructor(
        public user: UserModel,
        public category: CategoryModel,
        public posts: Array<PostModel>,
        public title: string,
        public content: string,
        public is_closed: boolean,
        public created_at: string,
        public subtitle?: string,
        public image?: string,
    ) {
    }

    static fromObject(data: any): TopicModel {
        let posts = data?.posts?.map((p: PostModel) => {
            return PostModel.fromObject(p)
        }) || []

        console.log("data da model");
        return new TopicModel(
            UserModel.fromObject(data.user || {}),
            CategoryModel.fromObject(data.category || {}),
            posts,
            data.title || "",
            data.content || "",
            data.is_closed || false,
            data.created_at || "",
            data.subtitle || "",
            data.image || ""
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