export class CommentModel {
    constructor(
        protected comment: string,
    ) {
    }

    static fromObject(data: any): CommentModel {
        return new CommentModel(
            data.comment || "",
        )
    }
}