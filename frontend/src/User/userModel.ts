import { PreferenceModel } from "@/User/preferenceModel.ts";

export class UserModel {
    constructor(
        public name: string,
        public email: string,
        public is_subscribed: boolean,
        public segment_ids: number[],
        public preference: PreferenceModel,
    ) {
    }

    static fromObject(data: {
        name?: string;
        email?: string;
        is_subscribed?: boolean;
        segment_ids?: number[];
    }): UserModel {
        const segmentIds = Array.isArray(data.segment_ids) ? data.segment_ids : [];
        const isSubscribed = Boolean(data.is_subscribed);
        const preference = PreferenceModel.fromObject({
            is_subscribed: isSubscribed,
            segment_ids: segmentIds,
        });

        return new UserModel(
            data.name || "",
            data.email || "",
            isSubscribed,
            segmentIds,
            preference,
        )
    }
}
