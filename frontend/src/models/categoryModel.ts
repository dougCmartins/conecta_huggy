export class CategoryModel {
    constructor(
        public name: string,
        public active: boolean,
        public description?: string,
    ) {
    }

    static fromObject(data: any): CategoryModel {
        return new CategoryModel(
            data.name || "",
            data.active || false,
            data.description || "",
        )
    }
}