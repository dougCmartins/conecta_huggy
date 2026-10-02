import { configure, defineRule } from "vee-validate";
import { email, max, min, required } from "@vee-validate/rules";

defineRule("required", required);
defineRule("email", email);
defineRule("min", min);
defineRule("max", max);

configure({
    generateMessage: (context) => {
        const label = context.field;
        const limit = Array.isArray(context.rule?.params) ? context.rule.params[0] : context.rule?.params;

        if (context.rule?.name === "required") {
            return `The ${label} field is required.`;
        }

        if (context.rule?.name === "email") {
            return `The ${label} field must be a valid email address.`;
        }

        if (context.rule?.name === "min") {
            return `The ${label} field must be at least ${limit} characters.`;
        }

        if (context.rule?.name === "max") {
            return `The ${label} field must not be greater than ${limit} characters.`;
        }

        return `The ${label} field is invalid.`;
    },
});

export const registerSchema = {
    name: "required|max:255",
    email: "required|email",
    password: "required|min:6",
    segment_ids: "required",
};
