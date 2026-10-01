export class SegmentModel {
    constructor(
        public id: number,
        public name: string,
        public description: string,
    ) {
    }

    static fromObject(data: any): SegmentModel {
        return new SegmentModel(
            data.id || null,
            data.name || "",
            data.description || "",
        )
    }
}