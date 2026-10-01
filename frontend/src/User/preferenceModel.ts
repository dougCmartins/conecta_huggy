export class PreferenceModel {
    constructor(
        public segment_ids: number[],
        public is_subscribed: boolean
    ) {
    }

    static fromObject(data: {
        segment_ids?: number[];
        is_subscribed?: boolean;
    }): PreferenceModel {
        const segmentIds = Array.isArray(data?.segment_ids) ? data.segment_ids : [];

        return new PreferenceModel(
            segmentIds,
            Boolean(data?.is_subscribed),
        )
    }
}
