import { PreferenceModel } from "@/models/preferenceModel.ts";

export class UserModel {
    constructor(
        public preference: PreferenceModel,
        public name: string,
        public email: string,
    ) {
    }

    static fromObject(data: any): UserModel {
        return new UserModel(
            PreferenceModel.fromObject(data.preference || []),
            data.name || "",
            data.email || "",
        )
    }
}