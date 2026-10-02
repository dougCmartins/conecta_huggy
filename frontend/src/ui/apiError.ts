type ErrorBody = {
    message?: string;
    errors?: Record<string, string[]>;
};

export type ApiFieldErrors = Record<string, string>;

export const readApiError = (error: unknown, fallback: string): { message: string; fields: ApiFieldErrors } => {
    const data = (error as { response?: { data?: ErrorBody } })?.response?.data;
    const fields: ApiFieldErrors = {};

    if (data?.errors) {
        for (const [key, messages] of Object.entries(data.errors)) {
            if (Array.isArray(messages) && messages[0]) {
                fields[key] = messages[0];
            }
        }
    }

    return {
        message: data?.message || fallback,
        fields,
    };
};
