import { SegmentModel } from "@/models/segmentModel.ts";

export class PreferenceModel {
    constructor(
        public segments: SegmentModel[],
        public is_subscribed: boolean
    ) {
    }

    static fromObject(data: any): PreferenceModel {
        let segments = data?.segments?.map((i: SegmentModel) => {
            return SegmentModel.fromObject(i)
        }) || [];

        return new PreferenceModel(
            segments,
            data.is_subscribed || false,
        )
    }
}