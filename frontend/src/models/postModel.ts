export class PostModel {
    constructor(
        protected comment: string,
    ) {
    }

    static fromObject(data: any): PostModel {
        return new PostModel(
            data.comment || "",
        )
    }
}